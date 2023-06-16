const { typesense, pageLimit, validCategories } = require('./common')
const logger = require('../../utils/logger')
const { URLSearchParams } = require('url')

const searchItemsByTitleAndPage = async (req, res, next) => {
  try {
    const page = Number(req.params.page)
    const query = encodeURIComponent(req.params.search_title)
    const queryParams = new URLSearchParams(req.query).toString()
    const filters = req.query.filters
    let filterBy = ''

    if (filters) {
      const filterArray = filters.split(',')
      // Validate each filter
      filterArray.forEach(filter => {
        if (validCategories.includes(filter)) {
          filterBy += `cat:${filter}||`
        }
      })
      // Remove trailing "||"
      filterBy = filterBy.slice(0, -2)
    }

    let sortParams = ''
    const validOrders = ['timestamp', 'size', 'seeders', 'leechers']

    if (req.query.order && req.query.by && validOrders.includes(req.query.order)) {
      sortParams = `,${req.query.order}:${req.query.by}`
    }

    const searchOptions = {
      q: req.params.search_title.replace(/ /g, '.'), // hehehe :)
      query_by: 'title, cat, imdb, uploader',
      filter_by: filterBy,
      sort_by: `_eval(cat:!=xxx):desc ${sortParams}`,
      page: String(page),
      per_page: pageLimit,
      exhaustive_search: true,
      cache: true
    }

    typesense.collections('items')
      .documents()
      .search(searchOptions)
      .then((response) => {
        const documents = response.hits.map(hit => ({ ...hit.document }))
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
          next: hasNext ? `/api/search/${query}/page=${response.page + 1}?${queryParams}` : null,
          hasPrevious,
          previous: hasPrevious ? `/api/search/${query}/page=${response.page - 1}?${queryParams}` : null
        }

        res.json(responseObj)
      })
      .catch((error) => {
        logger.log(error)
        res.status(500).end('An error occurred while searching.')
      })
  } catch (err) {
    next(err)
  }
}

module.exports = {
  searchItemsByTitleAndPage
}

// future update, federated search
/*
      const searchRequests = {
        searches: [
          {
            collection: 'items',
            q: req.params.search_title.replace(/ /g, '.')
          },
          {
            collection: 'items',
            q: req.params.search_title
          }
        ]
      }

      typesense
        .multiSearch
        .perform(searchRequests, {
          query_by: 'title, cat, imdb, uploader',
          filter_by: filterBy,
          sort_by: '_eval(cat:!=xxx):desc',
          page: String(page),
          per_page: pageLimit
        })
       */
