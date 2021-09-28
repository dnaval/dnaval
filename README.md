# Daniel Naval Portfolio

My Personal Portfolio built with Bootstrap 5, PHP and MySQL. I created a backend interface for my website.

## Description

* Portfolio Frontend with the section below: About, Skills, Resume, Portfolio and Contact form
* Backend with option to update the necessary details in all the section above.
* Option to add and update the skills and projects.
* Possibility to add users and manage the users.

![dnaval](https://github.com/dnaval/dnaval/blob/dnaval/myportfolio.gif)

## Getting Started

### Dependencies

* Wampserver or LAMP server With the specification below.
* MySQL version: 5.7.31  (DATABASE)
* PHP Version: 7.4.9     (POGRAMMING LANGUAGE)
* Bootsrap version: 5    (HTML / CSS)
* Activate PDO_MySQL extension for PHP 7.4

### Installing

* Create your MySQL database and then import the dnaval.sql file.
* Update the file zen-config-sample.php with your database credentials and place it outside of the root directory.
* Rename the zen-config-sample.php to zen-cionfig.php
* Update the location of the zen-config.php file ("require_once 'C:\wamp64\config\zen-config.php';") in admin/models/DBController.php file and config/dbconfigPDO.php

### Executing program

* Upload the project in a folder in your root directory
* The frontend "assets" folder is avaialble from this template https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
* To access the backend via the browser get in the admin folder "http://localhost/yourprojectfolder/admin" and login with username: admin@dnaval.com / password: admin

## Authors

Contributors names and contact info

Daniel Naval 
[@navald27](https://twitter.com/navald27)
