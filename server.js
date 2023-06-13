const express = require('express')
const cors = require('cors')
const compression = require('compression')
const mongoose = require('mongoose')
const bodyParser = require('body-parser')
const dotenv = require('dotenv')
const homeRoutes = require('./api/routes/homeRoute')
const searchRoutes = require('./api/routes/searchRoute')
const catRoutes = require('./api/routes/catRoute')
const itemRoute = require('./api/routes/itemRoute')
const logger = require('./utils/logger')

// Load env vars from .env file in development
if (process.env.NODE_ENV !== 'production') {
  dotenv.config({ path: '.env' })
} else {
  dotenv.config({ path: '.env.prod' })
}
const PORT = process.env.PORT || 5000

// Connect to MongoDB
mongoose
  .connect(process.env.MONGO_URL, { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => {
    logger.log('MongoDB connected')

    const server = express()
    server.use(cors())
    server.use(bodyParser.json())
    server.use(compression())
    server.set('json spaces', 1)
    // Routes
    server.use('/api', homeRoutes)
    server.use('/api', searchRoutes)
    server.use('/api', catRoutes)
    server.use('/api', itemRoute)
    server.get('*', function (_req, res) {
      res.status(404).end()
    })

    server.use((err, req, res, next) => {
      logger.error(err.stack)
      res.status(500).send('Something broke!')
    })

    server.listen(PORT, () => {
      logger.log(`Server is running on port ${PORT}`)
    })
  })
  .catch((err) => {
    // Handle unhandled promise rejections
    logger.log(`Error: ${err.message}`)
  })

process.on('uncaughtException', (err) => {
  logger.log(`Error: ${err.message}`)

  // Exit process with failure
  process.exit(0)
})

process.on('SIGINT', function (err) {
  process.exit(err ? 1 : 0)
})
