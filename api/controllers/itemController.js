const axios = require('axios')
const { typesense } = require('./common')

const getItemById = async (req, res, next) => {
  try {
    const item = await typesense.collections('items')
      .documents(req.params._id)
      .retrieve()

    let others = 'N/A'
    let imdbInfo = 'N/A'

    if (item.imdb != null) {
      const searchOptions = {
        q: item.imdb,
        query_by: 'imdb',
        sort_by: '_eval(cat:!=xxx):desc',
        exhaustive_search: true,
        per_page: 11,
        cache: true
      }

      others = await typesense.collections('items').documents().search(searchOptions)
      others = others.hits.map(hit => hit.document).slice(1)

      const imdb = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}`)
      const imdbData = imdb.data

      if ((String(item.cat).includes('movies') || String(item.cat).includes('tv'))) {
        imdbInfo = {
          poster: imdbData.image,
          imdb_link: imdbData.imdb,
          title: imdbData.title,
          content_rating: imdbData.contentRating,
          user_rating: `${imdbData.rating.star}/10 from ${imdbData.rating.count} users`,
          genres: imdbData.genre,
          top_credits: imdbData.top_credits,
          runtime: imdbData.runtime,
          release_year: imdbData.releaseDetailed.year,
          plot: imdbData.plot
        }

        if (String(item.cat).includes('tv') && String(item.title).match(/S\d{2}E\d{2}/) != null) {
          const entry = item.title.split('.').join(' ').trim()
          const season = entry.match(/(?<!\w)S(?:0)?(\d+)/)[1]
          const episode = entry.match(/E(?:0)?(\d+)/)[1]

          const imdbSeason = await axios.get(`${process.env.IMDB_API_URL}/title/${item.imdb}/season/${season}`)

          imdbInfo.title = imdbSeason.data.episodes[episode - 1].title
          imdbInfo.no = imdbSeason.data.episodes[episode - 1].no
          imdbInfo.published_date = imdbSeason.data.episodes[episode - 1].publishedDate
          imdbInfo.plot_episode = imdbSeason.data.episodes[episode - 1].plot
          imdbInfo.plot_series = imdbData.plot
        }
      }
    } else {
      const searchOptions = {
        q: item.cat,
        query_by: 'cat',
        per_page: 11,
        cache: true
      }

      others = await typesense.collections('items').documents().search(searchOptions)
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
}

module.exports = {
  getItemById
}
