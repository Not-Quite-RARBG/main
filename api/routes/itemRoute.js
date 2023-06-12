const { express, morgan, accessLogStream } = require('./common')
const Item = require('../models/Item')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

// Get torrent
router.get('/t/:_id', cache('5 minutes'), async (req, res, next) => {
  try {
    const torrent = await Item.find({ _id: req.params._id })
    res.json(torrent)
  } catch (err) {
    next(err)
  }
})

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
