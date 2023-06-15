const { express, morgan, accessLogStream } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../../utils/logger')
const itemController = require('../controllers/categoryController')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/cat', itemController.getCategories)

router.get('/cat/:cat/page=:page', cache('5 minutes'), itemController.getItemsByCategoryAndPage)

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).json({ message: 'Something broke!' })
})

module.exports = router
