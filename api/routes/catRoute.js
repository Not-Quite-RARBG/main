const { express, morgan, accessLogStream, typesense, pageLimit } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const logger = require('../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/cat/:cat/page=:page', cache('5 minutes'), async (req, res, next) => {
  try {
    let page = Number(req.params.page)
    const cat = req.params.cat

    if (!page || page < 1) {
      page = 1
    }

    typesense.collections('items')
      .documents()
      .search({
        q: '*',
        filter_by: `cat:=${cat}`,
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
          next: hasNext ? `/cat/${cat}/page=${page += 1}` : null,
          hasPrevious,
          previous: hasPrevious ? `/cat/${cat}/page=${page -= 1}` : null
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
