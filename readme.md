# EasySurvey

EasySurvey is a platform that allows users to easily and quickly create surveys in a very straightforward way.

The user will need to register first before they can create surveys. After registration, the user can now start creating as many surveys as wanted, each survey represented as a category. 

After creation, the user can share any of the previously created surveys. To do that, a list of emails will be requested and each will receive a unique link to the survey (Unique link to avoid multiple submissions). 

Finally, there is a results section where the user can see answers of all participants.


## Installation

1. Git clone the project into a local folder

2. Run this command to install all dependencies. You must run this from the local folder created before.

```bash
composer install
```
3. Open the project in your code editor and configure the *.env* file with your database settings.

4. Include the domain of your application in the .env file
```bash
APP_URL=http://domain_of_your_application/
```
5. Configure your Database settings in this section of the .env file
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

6. Configure your Mail Server settings in this section of the .env file
```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
```

7. Migrate the database:
```bash
php artisan migrate 
```

8. Optionally you can create demo users by running the following command:

```bash
php artisan db:seed 
```
9. To be able to send survey's links via email, you must run the following command to allow the worker the execute queued jobs:

```bash
php artisan queue:work
```
