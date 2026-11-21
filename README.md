# Learning Management System

This Laravel 12 application runs an education centre's administrator and student portals. Administrators maintain the course catalogue and rosters, record attendance, publish learning materials, and review feedback. Students self-register and sign in after an administrator approves their registration.

## What you can do

| Area | Implemented workflows |
| --- | --- |
| People and enrolment | Approve registrations, manage student and employee rosters, assign sessions and batches, and import or export CSV templates. |
| Academic setup | Organise centres, programmes, technologies, batches, courses, branches, subjects, and topics. |
| Teaching materials | Upload topic content, attach assignments and recordings, and manage mock tests and online test questions. |
| Attendance | Record attendance manually or by CSV, review daily records, and mark a student present through the QR attendance form. QR marks allow one student and one device IP per day. |
| Communication | Manage notification headings, targeted announcements, and scheduled popup notices. |
| Feedback | Build forms with six question types, select an audience, open or close a form, and inspect responses and aggregate results. |

The student dashboard, courses, assignments, quizzes, results, and certificates include example content. Registration, approval, sign-in, and feedback use the application database. A student's registration and roster entry are separate records. The portal matches their email addresses to apply roster-based feedback assignments.

## Run locally

Use PHP 8.2 or a compatible newer release, Composer 2, and MySQL with the PDO MySQL extension. The test suite also needs PDO SQLite. The Blade screens load the checked-in assets under `public/assets` and several browser libraries from CDNs.

1. Clone the repository and install the versions in `composer.lock`.

   ```sh
   git clone https://github.com/AdityaGit8009/lms.git
   cd lms
   composer install
   composer check-platform-reqs
   ```

2. Create a local configuration and generate this installation's application key.

   ```sh
   php -r "copy('.env.example', '.env');"
   php artisan key:generate
   ```

3. Create an empty MySQL database. Set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env` to the values for your local database. The supplied template uses file sessions, a synchronous queue, and local mail logging.

4. Install the schema and role records, link the public storage directory, and create your administrator. The account command prompts for your name, email, and password and requires an unused email address.

   ```sh
   php artisan migrate --seed
   php artisan storage:link
   php artisan lms:create-admin
   php artisan serve
   ```

5. Open [the local login page](http://127.0.0.1:8000/login). To try the student workflow, visit `/register` using a different email address, approve the registration in the administrator's **Self Registration** screen, and sign in as that student. Open feedback forms with an unrestricted audience are available immediately. Targeted forms require matching assignments.

## Validation

```sh
php artisan route:list
php artisan view:cache
php artisan test
```

PHPUnit starts with an in-memory SQLite database. Feature tests exercise administrator setup, student approval and revocation, role checks, QR attendance, and feedback from form authoring through submission and reporting. Running `php artisan view:clear` removes the compiled local views.

## Where to make changes

- `routes/web.php` defines browser pages and the student and administrator feedback workflows.
- `routes/api.php` defines the session-authenticated JSON and form endpoints used by the administrator interface.
- `app/Http/Controllers`, `app/Models`, and `database/migrations` contain the application logic and database schema.
- `resources/views/Admin` and `resources/views/Student` contain the Blade screens. Their directory names are case-sensitive on Linux.
- `tests/Feature` contains the request-level regression suite.

Maintained by Aditya Pratap Vishwakarma. [GitHub profile](https://github.com/AdityaGit8009)
