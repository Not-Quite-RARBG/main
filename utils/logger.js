function log (...params) {
  if (process.env.NODE_ENV !== 'production') {
    console.log(...params)
  }
}

function error (...params) {
  if (process.env.NODE_ENV !== 'production') {
    console.error(...params)
  }
}

function warn (...params) {
  if (process.env.NODE_ENV !== 'production') {
    console.warn(...params)
  }
}

module.exports = { log, error, warn }
