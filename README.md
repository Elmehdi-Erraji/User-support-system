# Guidely - Ticket Support System

Guidely is a ticket support web application that simplifies the management of support tickets and provides a platform to handle frequently asked questions (FAQs) to enhance visitor and client experience.

If you found this repo helpful, please give it a (⭐). Thank you!

## Table of Contents

- [Features](#features)
- [Languages and Tools](#languages-and-tools)
  - [Backend](#backend)
  - [Database](#database)
  - [Tools](#tools)
- [Installation](#installation)
  - [Requirements](#requirements)
  - [Installation Steps](#installation-steps)
- [Usage](#usage)
  - [Default Credentials](#default-credentials)
  - [Notifications](#notifications)
- [Author](#author)
- [Contributing](#contributing)
- [License](#license)


## Features

- Implements a responsive design to ensure a good user experience on all devices.
- Utilizes the Repository Pattern for maintainability.
- Follows clean code and Separation of Concerns principles.
- Uses reusable methodes and layouts to avoid duplication of code.
- Implements input validation and data encryption to protect user data.
- Sanitizes user input to prevent XSS attacks.
- Optimizes database performance by avoiding the N+1 problem.
- And more...

<a href="#table-of-contents" title="Go back to the table of contents">
⬆️
</a>

## Languages and Tools

### Frontend

- HTML, CSS, Bootstrap
- Vanilla JavaScript

### Backend

- PHP 8
- Laravel 10 
- Laravel Sanctum (Authentication)
- Laravel broadcasting 

### Database

- MySQL

### Tools

- Git
- GitHub
- Composer
- Figma for design 
- draw.io for UML creation

<a href="#table-of-contents" title="Go back to the table of contents">
⬆️
</a>

## Installation

### Requirements

- PHP 8
- Composer
- NPM

### Installation Steps

1. Clone the repository

   ```bash
   git clone https://github.com/Elmehdi-Erraji/User-support-system.git
   ```

2. Install the dependencies

   ```bash
   cd path/to/project && composer install
   ```

3. Create a copy of your .env file

   ```bash
   cd path/to/project && cp .env.example .env
   ```

4. In the .env file in the backend, add database information to allow Laravel to connect to the database

   ```env
   DB_CONNECTION=mysql
   DB_HOST=
   DB_PORT=
   DB_DATABASE=
   DB_USERNAME=
   DB_PASSWORD=
   ```

5. Generate an app encryption key

   ```bash
   cd path/to/project && php artisan key:generate
   ```

6. Migrate and seed the database

   ```bash
   cd path/to/project && php artisan migrate --seed
   ```

7. Launch the project

   ```bash
   cd path/to/project && php artisan serve
   ```


8. Link the storage folder in the project

    ```bash
    cd path/to/project && php artisan storage:link
    ```

<a href="#table-of-contents" title="Go back to the table of contents">
⬆️
</a>

## Usage

### Default Credentials

If you ran the database seeder, you can login with the following credentials:

| Role   | Email              | Password    |
| ------ | ------------------ | ----------- |
| Admin  | admin@mail.com | admin@mail.com  |
| Agent  | support@mail.com   | support@mail.com |
| Client | client@mail.com  | client@mail.com |


### Notifications

To listen for  notifications, run the following command:

```bash
cd path/to/project && php artisan websocket:serve
```


## Author

| Website  | [mehdi.com](www.linkedin.com/in/mehdi-erraji)|
| -------- | -------------------------------------------- |
| LinkedIn | [/in/mehdi](https://linkedin.com/in/mehdi-erraji) |
| GitHub   | [/mehdi](https://github.com/Elmehdi-Erraji)         |

<a href="#table-of-contents" title="Go back to the table of contents">
⬆️
</a>

## Contributing

Contributions, issues and feature suggestions are welcome!


