const { express, morgan, accessLogStream, pageLimit } = require('./common')
const Item = require('../models/Item')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

// List torrents from specific categories
router.get('/cat/:cat', cache('5 minutes'), async (req, res, next) => {
  try {
    const torrents = await Item
      .paginate({
        query: { cat: String(req.params.cat) },
        limit: pageLimit,
        paginatedField: 'dt',
        next: req.query.next,
        previous: req.query.previous
      })

    res.json({
      results: torrents.results,
      hasNext: torrents.hasNext,
      next: torrents.next ? `/cat/${req.params.cat}?next=${torrents.next}` : null,
      hasPrevious: torrents.hasPrevious,
      previous: torrents.previous ? `/cat/${req.params.cat}?previous=${torrents.previous}` : null
    })
  } catch (err) {
    next(err)
  }
})

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
