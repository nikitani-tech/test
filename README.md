## How to install

- Clone repo.
- Run "composer install".
- Run "cp .env.example .env".
- Put mysql connection setting to .env, change CACHE_STORE and SESSION_DRIVER to "file".
- Run "php artisan key:generate".
- Run "php artisan migrate".
- Run "npm install".
- Run "npm run build".
- If need it - run "php artisan migrate:fresh --seed --seeder=UserSeeder" - it will create admin user with email "test@mail.com" and password "password".
- Admin avaible in /admin.
- In admin home page you can run product seeder with images.


