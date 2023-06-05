module.exports = {
  apps: [{
    name: 'nq-rarbg',
    script: 'src/index.js',

    // Options reference: https://pm2.io/doc/en/runtime/reference/ecosystem-file/
    instances: 'max',
    autorestart: true,
    watch: false,
    max_memory_restart: '1G',
    exec_mode: 'cluster',
    env: {
      NODE_ENV: 'development'
    },
    env_production: {
      NODE_ENV: 'production'
    }
  }]
}
