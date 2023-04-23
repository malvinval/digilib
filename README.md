# VLibrary

VLibrary is a simple digital library web application built with Laravel. This application allows users to browse and borrow books from a virtual library.

## Installation

Follow these steps to install VLibrary on your local machine:

1. Clone the repository using HTTPS:

**```git clone https://github.com/malvinval/vlibrary.git```**

or using SSH:

**```git clone git@github.com:malvinval/vlibrary.git```**

2. Navigate into the project directory:

**```cd vlibrary```**

3. Install the dependencies:

**```composer update```**
**```composer install```**

4. Create a copy of the `.env.example` file and rename it to `.env`:

**```cp .env.example .env```**

5. Generate an application key:

**```php artisan key:generate```**

6. Set up your database by updating the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values in the `.env` file.

7. Set up SMTP configuration in the `.env` file by updating the `MAIL_DRIVER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, and `MAIL_ENCRYPTION` values. 

8. Run the database migrations:

**```php artisan migrate```**

9. Start the local development server:

**```php artisan serve```**

10. Open your web browser and go to ```http://127.0.0.1:8000``` to see the application running.

## Usage

Once the application is up and running, you can register a new user account, log in, and start exploring the app.

To give permission to a user as an admin, follow these steps:

1. Register a user.
2. Open the database using a database management tool.
3. Find the ```users``` table and the user you want to give admin permission to.
4. Change the value of the ```isAdmin``` column for that user to 1.
5. Save the changes to the database.
