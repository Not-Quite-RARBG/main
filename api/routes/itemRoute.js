const { express, morgan, accessLogStream } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../../utils/logger')
const itemController = require('../controllers/itemController')
const dotenv = require('dotenv')
dotenv.config()
router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

// Get torrent
router.get('/t/:_id', cache('5 minutes'), itemController.getItemById)

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
