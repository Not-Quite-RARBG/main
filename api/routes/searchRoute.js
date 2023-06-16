const { express, morgan, accessLogStream } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../../utils/logger')
const itemController = require('../controllers/searchController')
router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/search/:search_title/page=:page', cache('5 minutes'), itemController.searchItemsByTitleAndPage)

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
