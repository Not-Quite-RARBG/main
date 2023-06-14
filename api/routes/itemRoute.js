const { express, morgan, accessLogStream, typesense } = require('./common')
const router = express.Router()
const axios = require('axios')
const apicache = require('apicache')
const logger = require('../../utils/logger')
const dotenv = require('dotenv')
dotenv.config()
router.use(morgan('combined', { stream: accessLogStream }))

// create cache middleware
const cache = apicache.middleware

// Get torrent
router.get('/t/:_id', cache('5 minutes'), async (req, res, next) => {
  try {
    const item = await typesense.collections('items')
      .documents(req.params._id)
      .retrieve()

    let others = 'N/A'
    let imdbInfo = 'N/A'

    if (String(item.cat).includes('movies') && item.imdb != null) {
      others = await typesense.collections('items')
        .documents()
        .search({
          q: item.imdb,
          query_by: 'imdb',
          sort_by: '_eval(cat:!=xxx):desc',
          exhaustive_search: true,
          per_page: 11,
          cache: true
        })
      others = others.hits.map(hit => hit.document).slice(1)

      const imdb = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}`)
      imdbInfo = {
        poster: imdb.data.image,
        imdb_link: imdb.data.imdb,
        title: imdb.data.title,
        content_rating: imdb.data.contentRating,
        user_rating: `${imdb.data.rating.star}/10 from ${imdb.data.rating.count} users`,
        genres: imdb.data.genre,
        actors: imdb.data.actors,
        directors: imdb.data.directors,
        runtime: imdb.data.runtime,
        release_year: imdb.data.releaseDetailed.year,
        plot: imdb.data.plot
      }
    } else if (String(item.cat).includes('tv') && item.imdb != null) {
      others = await typesense.collections('items')
        .documents()
        .search({
          q: item.imdb,
          query_by: 'imdb',
          sort_by: '_eval(cat:!=xxx):desc',
          exhaustive_search: true,
          per_page: 11,
          cache: true
        })
      others = others.hits.map(hit => hit.document).slice(1)

      if (String(item.title).match(/S\d{2}E\d{2}/) == null) {
        const imdb = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}`)
        imdbInfo = {
          poster: imdb.data.image,
          imdb_link: imdb.data.imdb,
          title: imdb.data.title,
          content_rating: imdb.data.contentRating,
          user_rating: `${imdb.data.rating.star}/10 from ${imdb.data.rating.count} users`,
          genres: imdb.data.genre,
          top_credits: imdb.data.top_credits,
          runtime: imdb.data.runtime,
          release_year: imdb.data.releaseDetailed.year,
          plot: imdb.data.plot
        }
      } else if (String(item.title).match(/S\d{2}E\d{2}/) != null) {
        const entry = item.title.split('.').join(' ').trim()
        const season = entry.match(/(?<!\w)S(?:0)?(\d+)/)[1]
        const episode = entry.match(/E(?:0)?(\d+)/)[1]
        const imdbAll = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}`)
        const imdbSeason = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}/season/${season}`)

        imdbInfo = {
          poster: imdbAll.data.image,
          imdb_link: imdbSeason.data.imdb,
          title: imdbSeason.data.episodes[episode - 1].title,
          no: imdbSeason.data.episodes[episode - 1].no,
          content_rating: imdbAll.data.contentRating,
          user_rating: `${imdbSeason.data.episodes[episode - 1].rating.star}/10 from ${imdbSeason.data.episodes[episode - 1].rating.count} users`,
          genres: imdbAll.data.genre,
          top_credits: imdbAll.data.top_credits,
          runtime: imdbAll.data.runtime,
          published_date: imdbSeason.data.episodes[episode - 1].publishedDate,
          plot_episode: imdbSeason.data.episodes[episode - 1].plot,
          plot_series: imdbAll.data.plot
        }
      }
    } else {
      others = await typesense.collections('items')
        .documents()
        .search({
          q: item.cat,
          query_by: 'cat',
          per_page: 11,
          cache: true
        })
      others = others.hits.map(hit => hit.document).slice(1)
    }
    res.json({
      item,
      others,
      imdbInfo
    })
  } catch (err) {
    next(err)
  }
})

router.use((err, req, res, next) => {
  logger.error(err.stack)
  res.status(500).send('Something broke!')
})

module.exports = router
