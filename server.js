const express = require('express')
const cors = require('cors')
const compression = require('compression')
const mongoose = require('mongoose')
const bodyParser = require('body-parser')
const dotenv = require('dotenv')
const logger = require('./utils/logger')

// Load env vars from .env file in development
const envPath = process.env.NODE_ENV !== 'production' ? '.env' : '.env.prod'
dotenv.config({ path: envPath })

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
    const routes = [
      '/home',
      '/search',
      '/cat',
      '/item'
    ]
    server.use('/api', [...routes.map(route => require(`./api/routes${route}Route`))])
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
