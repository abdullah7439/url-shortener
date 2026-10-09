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

## Logging in and creating Admin / Member users

Only the SuperAdmin exists after seeding. Admin and Member accounts are created
through invitations, there are no ready-made credentials for them.

SuperAdmin login (created by the seeder):

- Email: superadmin@gmail.com
- Password: Pass@123

Invitation emails are not really sent (the mail driver is `log`). After you send an invite,
the invitation link is shown on the screen. It is also saved in `storage/logs/laravel.log`.

1. Log in as SuperAdmin and go to **Invite New Client**. Enter a company name and the
   Admin's email, then click **Send Invitation**.
2. Copy the invitation link shown on the screen and open it in a private/incognito window
   (so the SuperAdmin session stays logged in).
3. On the "Accept your invitation" page enter a name and password, then click
   **Create account**. This creates the company's Admin, so you now know that Admin's
   login (the invited email and the password you just set).
4. Log in as that Admin and go to **Invite New Team Member**. Enter a name, email and
   choose the role (Admin or Member), then click **Send Invitation**.
5. Open the new invitation link in a private window, set a name and password, and log in
   as that Admin or Member.

Admin and Member can create short URLs. The SuperAdmin cannot, but can see all of them.

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


