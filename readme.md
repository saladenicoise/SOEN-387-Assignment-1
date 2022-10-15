# SOEN 387 A1

This is the code to our website to fulfill the requirements for SOEN 387 Assignment #1

# Sitemap

The code is structured into 6 folders

## Business

The business folder is where the business logic is stored, here we have server-side php scripts that check course
requirements, perform password generations, and JS client-side scripts to check for password matching and to print
status messages.

## Config

The config folder contains the main configuration file which contains the login information for the database (running
locally of course, so credentials are useless even if leaked) as well as variables storing the different file paths so
that they can be reused. Additionally, it contains other information like semester start/end dates.

## Data

The data folder contains all the php server side scripts that handle SQL statements. These scripts serve to insert,
remove, and edit data inside the database. These scripts are kept here in order to separate them from the other `.php`
files which simply handle the presentation.

## DB

The DB folder contains two scripts, `school.sql` and `school_empty.sql`. These scripts are used in phpmyadmin in order
to create the necessary database schema to run the website locally. The former `school.sql` contains the schema as well
as data already inserted into the database in order to test. The latter `school_empty.sql` only contains the database
schema.

### Importing DB into phpmyadmin

Importing the schema is very simple. Simply boot up the apache and mysql instances in xampp:

![xampp control pannel](https://img001.prntscr.com/file/img001/YPDWvNRmQjuhmno8bqj5Zw.png)

Once this is done, open up ``localhost/phpmyadmin``:

![phpmyadmin main page](https://img001.prntscr.com/file/img001/688Cw1AdRiyaAxxZgvRQsg.png)

Click the import button at the top navigation bar:

![myadmin navbar](https://img001.prntscr.com/file/img001/vD7UgTaYSKi61h8a7RPp-A.png)

Once the import tab is open click the browse button in order to select the `.sql` file of your choice:

![import](https://img001.prntscr.com/file/img001/GqrZemKGQ3C65kSadK2FWg.png)

### Information for `school.sql`

The `school.sql` contains already created user accountst for both student and admin. This is their username and password
to login:
| Username | Password |
|-------------|-----------|
| testAdmin | 123456789 |
| testStudent | 123456789 |

### Creating new admins

Creating a new admin can be done at http://<serverhosted>/presentation/login/registerAdmin.php

ie. for a local web server, it'd be hosted at http://localhost/presentation/login/registerAdmin.php)

## Presentation

The presentation folder contains all the `.php` files that have HTML code within them. The reason they are treated
as `.php` files is in order for us to handle sessions, user authentication, and dynamic pages.

## Styles

The styles folder contains all the `.css` files for the website. The file names represent what data they hold and which
files it is relevant to.

