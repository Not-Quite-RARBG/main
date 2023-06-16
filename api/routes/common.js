const express = require('express')
const morgan = require('morgan')
const fs = require('fs')
const path = require('path')
const dotenv = require('dotenv')

dotenv.config()

let accessLogStream

if (process.env.NODE_ENV === 'production') {
  accessLogStream = fs.createWriteStream(path.join(__dirname, 'access.log'), { flags: 'a' })
}

module.exports = {
  express,
  morgan,
  accessLogStream
}
