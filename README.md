# The Right Way

Do the right things in the right way.

## Local Development

### Prepare

```
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

### Run

```
php artisan serve
```

## Deploying to Heroku

### Prepare

```
app_name=therightway
heroku apps:create $app_name
heroku addons:create heroku-postgresql:hobby-dev --app $app_name
heroku addons:create heroku-redis:hobby-dev --app $app_name
heroku buildpacks:add heroku/php --app $app_name
heroku buildpacks:add heroku/nodejs --app $app_name
heroku git:remote --app $app_name
heroku config:set --app $app_name APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set --app $app_name QUEUE_DRIVER=redis SESSION_DRIVER=redis CACHE_DRIVER=redis
# heroku config:set --app $app_name APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
heroku config:set --app $app_name APP_ENV=production APP_DEBUG=false APP_LOG_LEVEL=info
heroku config:set --app $app_name APP_URL=http://therightway.herokuapp.com
```

### Deploy

```
git push heroku master
heroku run -a $app_name php artisan postdeploy:heroku
heroku run -a $app_name php artisan admin:install
```

## Heroku Configuration

- Procfile defining a web process using nginx and a worker process for running queues
- Database configuration defaults set to use Postgres and to parse heroku-postgres DATABASE_URL environment variable
- Redis configuration setup to use heroku-redis REDIS_URL environment variable
- Failed job database configuration defaulting to postgres
- A heroku app.json and post-deployment script (php artisan postdeploy:heroku)for use with Heroku Review Apps
- TrustedProxies middleware configured to trust Heroku load balancers correctly
- npm task named "postinstall" that is run during heroku deployments
- Heroku specific logging configuration set as the default.

## License

MIT
