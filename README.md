### Juntos Database

This project is a reconstruction of the original converted web application with continual departmental feedback. 

The original Juntos application code can be referenced
[here](https://github.ncsu.edu/jjwill10/juntos), as this was a converted application from Adobe Cold Fusion and Microsoft SQL Server application to PHP/MySQL appplication. 

#### Branches
+ `main` is the production version of the application.
+ `updates_mpa` is the demonstration version of the application.
+ `tests` is an offshoot branch of updates_mpa of Feature testing that will be merged into the development branch shortly.
+ `fe` is the initial single page application using [VueJS](https://vuejs.org) version that was initially in development.
 

#### Basic Installation
In order to complete an installation of this application, you may want to start with the following:

1. `git clone https://github.ncsu.edu/dasa-tech/juntos [your directory here]`
2. Install the Laravel Framework and all necessary dependencies through [composer](https://getcomposer.org/).
   `composer install`
3. Wait....
4. Run database migrations by `artisan migrate` in your terminal window.
5. Run other database seeds in the following order:

+ **RoleSeeder** -- this will create standard Roles in the system <span style='color:red'>Required</span>
+ **ParentsSeeder** -- this will rules for when to open/close the application and what to put on the front page.. <span style='color:orange'>Optional</span>
+ **StudentSeeder** -- this will create administrative users <span style='color:orange'>Optional</span>
+ **EventSeeder** -- this will fill the lookup table for those on campus that work within a particular college on campus. <span style='color:orange'>Required</span>
+ **DemoUsers**  -- this will create a dummy user account with the email address `dasa123@test.com` as the email address.


#### Frontend Dependencies
+ A very limited amount of compiled depencies exist within the `juntos_mpa` (default) branch of this application.
+ To install run the following command: `npm run prod` and adjust the mix url as needed.
+ Note: The `fe` (front-end) branch is significantly different and must have the front-end depencies compiled for the application to be properly presented, as it is using VueJS for the entire frontend of this application. 

#### Testing
+ Feature tests for the application are found within the `tests` branch of this application. Specifically within the `tests\Feature\JuntosTest` file.
+ Run these tests by creating a testing database and running `./vendor/bin/phpunit` and specifying your testing file.

#### Troubleshooting
+ Delete `composer.lock`
+ Run `composer dump auto-load`

#### Requirements
The following versions of PHP are supported by this application.
+ PHP 7.3 - tested to 7.3.28
+ PHP 7.4 - likely will work.

#### License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)
