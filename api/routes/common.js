const express = require('express')
const morgan = require('morgan')
const fs = require('fs')
const path = require('path')
const Typesense = require('typesense')
const dotenv = require('dotenv')

dotenv.config()

const pageLimit = 25

const validCategories = [
  'ebooks', 'games_pc_iso', 'games_pc_rip', 'games_ps3', 'games_ps4',
  'games_xbox360', 'movies', 'movies_bd_full', 'movies_bd_remux',
  'movies_x264', 'movies_x264_3d', 'movies_x264_4k', 'movies_x264_720',
  'movies_x265', 'movies_x265_4k', 'movies_x265_4k_hdr', 'movies_xvid',
  'movies_xvid_720', 'music_flac', 'music_mp3', 'software_pc_iso',
  'tv', 'tv_sd', 'tv_uhd', 'xxx', 'non-xxx'
]

const typesense = new Typesense.Client({
  nodes: [{
    host: 'localhost',
    port: '8108',
    protocol: 'http'
  }],
  apiKey: process.env.TYPESENSE_API_KEY,
  connectionTimeoutSeconds: 2
})

let accessLogStream

if (process.env.NODE_ENV === 'production') {
  accessLogStream = fs.createWriteStream(path.join(__dirname, 'access.log'), { flags: 'a' })
}

module.exports = {
  express,
  morgan,
  accessLogStream,
  typesense,
  pageLimit,
  validCategories,
  movieCategories
}
