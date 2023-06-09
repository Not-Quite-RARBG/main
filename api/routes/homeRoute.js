const { express, morgan, accessLogStream, typesense, pageLimit } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/page=:page', cache('5 minutes'), async (req, res, next) => {
  try {
    let page = Number(req.params.page)

    typesense.collections('items')
      .documents()
      .search({
        q: '*',
        sort_by: '_eval(cat:!=xxx):desc',
        page: String(page),
        per_page: pageLimit,
        exhaustive_search: true,
        cache: true
      })
      .then((response) => {
        const hasNext = (page * pageLimit) < response.found
        const hasPrevious = page > 1
        res.json({
          results: response.hits,
          current_page: response.page,
          total_hits: response.found,
          pages_found: Math.ceil(response.found / pageLimit),
          hasNext,
          next: hasNext ? `/page=${page += 1}` : null,
          hasPrevious,
          previous: hasPrevious ? `/page=${page -= 1}` : null
        })
      })
      .catch((error) => {
        logger.log(error)
        res.status(500).end('An error occurred while searching.')
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
