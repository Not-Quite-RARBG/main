const fs = require('fs')
const path = require('path')

const stopwordsPath = path.join(__dirname, 'stopwords.txt')
const stopwords = fs.readFileSync(stopwordsPath, 'utf-8').split('\n')

module.exports = function (str) {
  const q = str.replace(/\r\n/g, '').replace(/^\s+|\s+$/, '').replace(/[^a-z\s]+/gi, '').replace(/\s+$/, '')

  const parts = q.split(/\s/)
  const terms = []
  parts.forEach(part => {
    if (stopwords.indexOf(part) === -1) {
      terms.push(part)
    }
  })
  const query = { $and: [] }
  terms.forEach(term => {
    const queryFrag = { title: { $regex: term, $options: 'i' } }
    query.$and.push(queryFrag)
  })
  return query
}
