const { express, morgan, accessLogStream, typesense } = require('./common')
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
    await Item.find({ _id: req.params._id })
      .then((item) => {
        typesense.collections('items')
          .documents()
          .search({
            q: item[0].imdb,
            query_by: 'title, imdb',
            sort_by: '_eval(cat:!=xxx):desc',
            exhaustive_search: true,
            cache: true
          })
          .then((others) => {
            const documents = others.hits.map(hit => hit.document)
            res.json({
              item,
              others: documents
            })
          })
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
