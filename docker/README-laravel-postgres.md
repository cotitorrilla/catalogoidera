# Laravel + PostgreSQL + pgAdmin (Docker Compose)

This Compose file spins up **PostgreSQL 16** and **pgAdmin 4** ready to be used from a Laravel app.

## 1) Start the stack

```bash
docker compose up -d
```

- PostgreSQL is available on **localhost:5432**
- pgAdmin is available on **http://localhost:5050**
  - Email: `admin@local`
  - Password: `admin1234`

## 2) Configure Laravel

Add this to your Laravel `.env` (or adjust existing values):

```
DB_CONNECTION=pgsql
# If Laravel runs on your host:
DB_HOST=127.0.0.1
# If Laravel runs inside another container in the same compose:
# DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

> Make sure your PHP has the `pdo_pgsql` extension enabled (`php -m | grep pdo_pgsql`).

## 3) Run migrations

```bash
php artisan migrate
```

## 4) Connect from pgAdmin

- Open http://localhost:5050
- Login with the credentials above
- Add a new **Server**:
  - **Name**: postgres (any name)
  - **Host**: `postgres` (if pgAdmin is in the same compose network) or `host.docker.internal` / `127.0.0.1` if connecting to the mapped port
  - **Port**: `5432`
  - **Username**: `laravel`
  - **Password**: `secret`

## Notes

- To change defaults, you can set environment variables before `docker compose up`, e.g.:
  ```bash
  export POSTGRES_USER=myuser POSTGRES_PASSWORD=mypass POSTGRES_DB=mydb
  docker compose up -d
  ```
- Data is persisted in Docker named volumes `db-data` and `pgadmin-data`.
- To reset the database: `docker compose down -v` (this will delete volumes).
