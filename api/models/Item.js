const mongoose = require('mongoose')
const MongoPaging = require('mongo-cursor-pagination')

const ItemSchema = new mongoose.Schema({
  hash: {
    type: String,
    required: true,
    unique: true
  },
  title: {
    type: String,
    required: true
  },
  dt: {
    type: String,
    required: true
  },
  cat: {
    type: String,
    required: true
  },
  size: {
    type: Number,
    required: true
  },
  uploader: {
    type: String,
    required: true
  },
  imdb: {
    type: String,
    required: false
  }
})

// Required for pagination
ItemSchema.plugin(MongoPaging.mongoosePlugin)

// Index for listing all torrents
ItemSchema.index({ dt: 1, _id: 1 })

// Index for full-text search (required for search to work)
ItemSchema.index({ title: 'text', _id: 1 })

// Index for listing all categories
ItemSchema.index({ cat: 1, _id: 1 })

// Index for getting torrents from specific categories
ItemSchema.index({ cat: 1, dt: 1, _id: 1 })

module.exports = mongoose.model('Item', ItemSchema)
