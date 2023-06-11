const { express, morgan, accessLogStream, typesense, pageLimit, validCategories } = require('./common')
const router = express.Router()
const apicache = require('apicache')
const Item = require('../models/Item')
const logger = require('../utils/logger')

router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

router.get('/cat', async (req, res, next) => {
  try {
    const categories = await Item.find().distinct('cat')
    const formattedCategories = {}
    categories.forEach((category, index) => {
      formattedCategories[index + 1] = category
    })
    res.json(formattedCategories)
  } catch (error) {
    logger.log(error)
    res.status(500).end('An error occurred while searching.')
  }
})

router.get('/cat/:cat/page=:page', cache('5 minutes'), async (req, res, next) => {
  try {
    let page = Number(req.params.page)
    const queryParams = new URLSearchParams(req.query).toString()

    let cat = ''
    if (req.params.cat && validCategories.includes(req.params.cat)) { cat = `cat:=${req.params.cat}` }

    if (!page || page < 1) {
      page = 1
    }

    let sortParams = ''
    const validOrders = ['size', 'seeders', 'leechers']

    if (req.query.order && req.query.by) {
      if (validOrders.includes(req.query.order)) {
        sortParams = `${req.query.order}:${req.query.by}`
      }
    }

    typesense.collections('items')
      .documents()
      .search({
        q: '*',
        filter_by: cat,
        sort_by: sortParams,
        page: String(page),
        per_page: pageLimit,
        exhaustive_search: true,
        cache: true
      })
      .then((response) => {
        const documents = response.hits.map(hit => hit.document)
        const currentPage = response.page
        const totalPages = Math.ceil(response.found / pageLimit)
        const hasNext = (page * pageLimit) < response.found
        const hasPrevious = page > 1
        res.json({
          results: documents,
          current_page: currentPage,
          total_hits: response.found,
          pages_found: totalPages,
          hasNext,
          next: hasNext ? `/api/cat/${req.params.cat}/page=${page += 1}?${queryParams}` : null,
          hasPrevious,
          previous: hasPrevious ? `/api/cat/${req.params.cat}/page=${page -= 2}?${queryParams}` : null
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
