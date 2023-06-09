module.exports = {
  apps: [{
    name: 'nq-rarbg',
    script: 'src/server.js',

    autorestart: true,
    watch: false,
    max_memory_restart: '1G',
    exec_mode: 'cluster',
    env: {
      NODE_ENV: 'development',
      instances: '1'
    },
    env_production: {
      NODE_ENV: 'production',
      instances: 'max'
    }
  }]
}
