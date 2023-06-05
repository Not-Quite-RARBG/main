const mongoose = require('mongoose')
const paginationPlugin = require('@mother/mongoose-cursor-pagination')

const Schema = mongoose.Schema

const ItemSchema = new Schema({
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
  ext_id: {
    type: String,
    required: true,
    unique: true
  }
})

// Required for pagination
ItemSchema.plugin(paginationPlugin)
ItemSchema.index({ date: -1, _id: -1 })

// Required for full-text search
ItemSchema.index({ title: 'text', cat: 'text' })

module.exports = mongoose.model('Item', ItemSchema)
