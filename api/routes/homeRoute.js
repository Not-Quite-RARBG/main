const { express, morgan, accessLogStream } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const { searchItems } = require('../controllers/homeController')
const logger = require('../../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/page=:page', cache('5 minutes'), searchItems)

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
