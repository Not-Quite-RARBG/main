module.exports = {
  apps: [{
    name: 'nq-rarbg',
    script: 'src/server.js',

    autorestart: true,
    watch: false,
    max_memory_restart: '1G',
    instances: 'max',
    exec_mode: 'cluster',
    env: {
      NODE_ENV: 'development'
    },
    env_production: {
      NODE_ENV: 'production'
    }
  }]
}
