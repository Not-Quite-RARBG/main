const { express, morgan, accessLogStream, pageLimit } = require('./common')
const Item = require('../models/Item')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/', cache('5 minutes'), async (req, res, next) => {
  try {
    const torrents = await Item
      .paginate({
        limit: pageLimit,
        paginatedField: 'dt',
        next: req.query.next,
        previous: req.query.previous
      })

    res.json({
      results: torrents.results,
      hasNext: torrents.hasNext,
      next: torrents.next ? `/?next=${torrents.next}` : null,
      hasPrevious: torrents.hasPrevious,
      previous: torrents.previous ? `/?previous=${torrents.previous}` : null
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
