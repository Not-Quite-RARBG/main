const express = require('express')
const bodyParser = require('body-parser')
const cors = require('cors')
const mongoose = require('mongoose')
const dotenv = require('dotenv')
const routes = require('./routes')
const apicache = require('apicache')

// create cache middleware
const cache = apicache.middleware

// Load env vars from .env file in development
if (process.env.NODE_ENV !== 'production') {
  dotenv.config({ path: '.env' })
} else {
  dotenv.config({ path: '.env.prod' })
}

// Connect to MongoDB
mongoose
  .connect(process.env.MONGO_URL, { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => {
    console.log('MongoDB connected')

    const app = express()
    app.use(cors())
    app.use(bodyParser.json())
    app.use('/api', routes)
    app.use(cache('5 minutes'), routes)

    app.use((err, req, res, next) => {
      console.error(err.stack)
      res.status(500).send('Something broke!')
    })

    const PORT = process.env.PORT || 5000

    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}`)
    })
  })
  .catch((err) => {
    // Handle unhandled promise rejections
    console.log(`Error: ${err.message}`)
  })

process.on('uncaughtException', (err) => {
  console.log(`Error: ${err.message}`)
  // Exit process with failure
  process.exit(1)
})
