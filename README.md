# Larachan

Simple blog with CRUD operations, administrative account, email account confirmation, and action restriction if confirmation is not received.

## Installation

- Run `composer install`
- Add yout database to `.env`
- `php artisan key:generate`
- `php artisan storage:link`
- `php artisan migrate --seed`
- `php artisan db:seed --class Database\Seeders\DatabaseSeeder`
- `npm install`
- `npm run dev`

By default, the first test user is administrator (`'admin_id' => 1` in /config/app.php). He can edit other people's accounts and posts, and can also post without verification.

## Screenshots
![Posts](/screenshots/Снимок%20экрана%202023-11-08%20225913.png)
![Users](/screenshots/Снимок%20экрана%202023-11-08%20225921.png)
![User](/screenshots/Снимок%20экрана%202023-11-08%20225930.png)
![Edit user](/screenshots/Снимок%20экрана%202023-11-08%20225956.png)
