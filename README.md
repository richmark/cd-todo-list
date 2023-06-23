# Collabera Digital

## For local setup:
1. Clone this repository: [https://github.com/richmark/cd-todo-list.git](https://github.com/richmark/cd-todo-list.git)
2. Go to the directory of the application.
3. If you don't have Laravel and PHP 8.1 yet, please install the latest version of Laravel and PHP 8.1.
4. For this application I am using Laravel ^10.10.
5. Please create an .env file and paste the content of .env.example.
6. Open a terminal and run `npm install`.
7. Open a terminal and run `composer install`.
8. Run `php artisan key:generate`.
9. Run `php artisan serve`.
10. Go to the provided url. e.g.: http://127.0.0.1:8000/index
11. To generate database migration execute `php artisan migrate:fresh --seeder=TodoSeeder`.
12. To run unit test execute `php artisan test`.
