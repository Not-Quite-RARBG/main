const express = require('express')
const Item = require('./models/Item')
const router = express.Router()
const morgan = require('morgan')
const fs = require('fs')
const path = require('path')
const queryVar = require('./search/search_query')
const pageLimit = 25

// create a write stream (in append mode) for production logging
let accessLogStream
if (process.env.NODE_ENV === 'production') {
  accessLogStream = fs.createWriteStream(path.join(__dirname, 'access.log'), { flags: 'a' })
}

// setup the logger
router.use(morgan('combined', { stream: accessLogStream }))

// List all torrents
router.get('/', async (req, res, next) => {
  try {
    const torrents = await Item
      .find()
      .limit(pageLimit)
      .sort('-dt')
      .paginate()
      .exec()
    res.status(200).send(torrents)
  } catch (err) {
    next(err)
  }
})

// Get torrent
router.get('torrent/:ext_id', async (req, res, next) => {
  try {
    const torrent = await Item
      .find({ ext_id: req.params.ext_id })
      .exec()
    res.status(200).send(torrent)
  } catch (err) {
    next(err)
  }
})

// Search by title
router.get('/search/:search_title', async (req, res, next) => {
  try {
    const searchQuery = queryVar(req.params.search_title)
    const result = await Item
      .find(searchQuery)
      .limit(pageLimit)
      .paginate()
      .exec()
    res.status(200).send(result)
  } catch (err) {
    next(err)
  }
})

// List all categories
router.get('/categories', async (req, res, next) => {
  try {
    const categories = await Item
      .find()
      .distinct('cat')
      .exec()
    res.status(200).send(categories)
  } catch (err) {
    next(err)
  }
})

// List torrents from specific categories
router.get('/categories/:cat', async (req, res, next) => {
  try {
    const torrents = await Item
      .find({ cat: req.params.cat })
      .limit(pageLimit)
      .sort('-dt')
      .paginate()
      .exec()
    res.status(200).send(torrents)
  } catch (err) {
    next(err)
  }
})

router.use((err, req, res, next) => {
  console.error(err.stack)
  res.status(500).send('Something broke!')
})
module.exports = router
