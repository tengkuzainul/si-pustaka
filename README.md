# SISTEM INFORMASI PERPUSTAKAAN &mdash; SMK BAITURRAHMAN KANDIS

![Logo](https://smkbaiturrahman.sch.id/assets/logo.png)

## Tutorial use this project with clone

Clone this repo

```bash
  git clone https://github.com/tengkuzainul/si-pustaka.git
```

Go to clone directory

```bash
  cd si-perpus
```

Copy paste .env.example file

```bash
  cp .env.example .env
```

Install Composer

```bash
  composer install
```

Generate App Key

```bash
  php artisan key:generate
```

Migrate all table to database

```bash
  php artisan migrate --seed
```

Run server (Make sure you have activated Apache on the local server Xampp/Laragon/Mampp dtc)

```bash
  php artisan serve
```
