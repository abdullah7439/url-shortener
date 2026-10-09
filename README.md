# URL Shortener

A multi-company URL shortener built with Laravel 12 and MySQL. Login and logout use Jetstream.

## How to run it locally

You need PHP 8.2 or higher, Composer, MySQL and Git.

1. Clone the repo and install the packages

```
git clone <repo-url>
cd <project-folder>
composer install
```

2. Create the .env file and generate the app key

```
copy .env.example .env
php artisan key:generate
```

(on Mac/Linux use `cp` instead of `copy`)

3. Create a MySQL database called `shortner_db`, then open `.env` and change these lines
(the example file uses sqlite, so they must be changed):

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shortner_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

4. Create the tables and the SuperAdmin user

```
php artisan migrate --seed
```

5. Start the server and open http://127.0.0.1:8000

```
php artisan serve
```

SuperAdmin login:

- Email: superadmin@gmail.com
- Password: Pass@123

Invitation emails are not really sent. They are saved in `storage/logs/laravel.log`,
and the invitation link is also shown on the screen after you send an invite.

## Running the tests

The tests need a separate empty database called `shortner_test`, because the tests
reset the tables and you don't want that to happen on your real data. Create it once
and run:

```
php artisan test
```

The database name is set in `phpunit.xml`. The host, username and password are taken from `.env`.

The tests are in `tests/Feature/ShortUrlTest.php`:

1. Admin and Member can create short urls
2. SuperAdmin cannot create short urls
3. Admin can only see short urls created in their own company
4. Member can only see short urls created by themselves
5. Short urls are publicly resolvable and redirect to the original url

## AI tools used

I used ChatGPT as a helper while building this project:

- Checking Laravel syntax
- Debugging errors
- Improving the Blade views and error messages
- Debugged test cases to make them pass


