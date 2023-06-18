const Item = require('../models/Item')
const logger = require('../../utils/logger')
const { typesense, pageLimit, validCategories } = require('./common')

const getCategories = async (req, res, next) => {
  try {
    const categories = await Item.find().distinct('cat')
    const formattedCategories = categories.reduce((obj, category, index) => {
      obj[index + 1] = category
      return obj
    }, {})
    res.status(200).json(formattedCategories)
  } catch (error) {
    logger.log(error)
    res.status(500).json({ message: 'An error occurred while searching.' })
  }
}

const getItemsByCategoryAndPage = async (req, res, next) => {
  try {
    let page = Number(req.params.page)
    const queryParams = new URLSearchParams(req.query).toString()

    let cat = ''
    if (req.params.cat && validCategories.includes(req.params.cat)) {
      if (req.params.cat === 'non-xxx') {
        cat = 'cat:!=xxx'
      } else {
        cat = `cat:=${req.params.cat}`
      }
    }

    page = page && page >= 1 ? page : 1

    let sortParams = ''
    const validOrders = ['timestamp', 'size', 'seeders', 'leechers', 'completed']

    if (req.query.order && req.query.by && validOrders.includes(req.query.order)) {
      sortParams = `${req.query.order}:${req.query.by}`
    }

    const searchOptions = {
      q: '*',
      filter_by: cat,
      sort_by: sortParams,
      page: String(page),
      per_page: pageLimit,
      exhaustive_search: true,
      cache: true
    }

    typesense.collections('items')
      .documents()
      .search(searchOptions)
      .then((response) => {
        const documents = response.hits.map(hit => hit.document)
        const currentPage = response.page
        const totalPages = Math.ceil(response.found / pageLimit)
        const hasNext = (page * pageLimit) < response.found
        const hasPrevious = page > 1

        const responseObj = {
          results: documents,
          current_page: currentPage,
          total_hits: response.found,
          pages_found: totalPages,
          hasNext,
          next: hasNext ? `/api/cat/${req.params.cat}/page=${page + 1}?${queryParams}` : null,
          hasPrevious,
          previous: hasPrevious ? `/api/cat/${req.params.cat}/page=${page - 1}?${queryParams}` : null
        }

        res.status(200).json(responseObj)
      })
      .catch((error) => {
        logger.log(error)
        res.status(500).json({ message: 'An error occurred while searching.' })
      })
  } catch (err) {
    next(err)
  }
}

module.exports = {
  getCategories,
  getItemsByCategoryAndPage
}
