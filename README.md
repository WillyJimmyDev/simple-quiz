# [Simple-Quiz](http://quiz.elanman.com)
[![Software License](http://img.shields.io/badge/license-apache2-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/ElanMan/simple-quiz.png?branch=master)](https://travis-ci.org/ElanMan/simple-quiz)

Simple-Quiz is a simple framework for creating quizzes for the web, created and maintained by [Ben Hall](http://twitter.com/elanman).

PHP version > 5.3.7 is required


## Quick start

Three quick start options are available:

* [Download the latest release (github)](https://github.com/elanman/simple-quiz/releases/latest).
* [Download the latest release (sourceforge)](https://sourceforge.net/projects/simple-quiz/).
* Clone the repo: `git clone https://github.com/elanman/simple-quiz.git`.


### What's included

Within the download you'll find the following directories and files:


    /
    ├── SimpleQuiz/
    │   ├── Utils/
    │   │   ├── Base/
    │   │   │   ├── Config.php
    │   │   │   ├── Installer.php
    │   │   │   ├── IQuestion.php    
    │   │   │   ├── IQuiz.php
    │   │   │   ├── ISession.php
    │   │   │   ├── ISimple.php
    │   │   │   ├── User.php
    │   │   │   └── setup.php
    │   │   ├── Exceptions/
    │   │   │   ├── LoginException.php        
    │   │   │   ├── RegisterException.php 
    │   │   ├── User/ 
    │   │   │   ├── AdminUser.php
    │   │   │   ├── EndUser.php
    │   │   │   ├── GuestUser.php                   
    │   │   ├── LeaderBoard.php
    │   │   ├── Quiz.php
    │   │   ├── QuestionStorage.php    
    │   │   ├── Session.php
    │   │   └── Simple.php
    │   │   └── RadioQuestion.php
    │   ├── Tests/
    │       ├── Base/      
    │       │   ├── InstallerTest.php
    │       └── QuizTest.php
    ├── public/ (**this is your document root**)
    │   ├── images/
    │   │    ├── ajax-loader.gif
    │   │    ├── sq.png   
    │   ├── res/
    │   │    ├── bootstrap/
    │   │    │      ├── assets/ 
    │   │    │      ├── dist/  
    │   │    ├── css/
    │   │    │      ├── quiz.css  
    │   │    ├── js/
    │   │    │      ├── admin.js
    │   │    │      ├── form.js 
    │   │    │      ├── general.js 
    │   │    │      ├── login.js
    │   │    │      ├── start.js                  
    │   ├── .htaccess
    │   └── index.php
    ├── routes/
    │   ├── admin.php
    │   ├── public.php        
    ├── templates/
    │   ├── admin/
    │   │    ├── editanswers.php
    │   │    ├── footer.php
    │   │    ├── header.php
    │   │    ├── index.php
    │   │    ├── login.php    
    │   │    └── quiz.php     
    │   ├── quiz/
    │   │    ├── error.php    
    │   │    ├── footer.php  
    │   │    ├── header.php  
    │   │    ├── quiz.php  
    │   │    ├── results.php  
    │   │    ├── test.php                      
    │   ├── category.php 
    │   ├── index.php
    │   ├── login.php
    │   └── requirements.php                     
    └── vendor/



## Installation

* Get The Code
 If you are downloading from SourceForge, you don't need to have composer installed to add the project dependencies as they are bundled with the project.
 If, however, you are cloning from GitHub, you must run composer install to get the latest changes as new dependencies are being added all the time and the vendor directory is no longer in version control.
* Unpack the zip archive.
* Place the contents of the /public directory inside your document root.
* All other directories should be placed outside of the document root and not accessible via a web browser (look at the above diagram to see the structure).
* The mod_rewrite module (if using apache server) will need to be enabled in your server configuration.
* Create a MySQL database called 'simple-quiz'
* Import simple-quiz.sql into MySQL using a tool like phpmyadmin.
* Change credentials in /SimpleQuiz/Utils/Base/Config.php.
* If users aren't required to login to take a quiz, change $requireauth to false in /SimpleQuiz/Utils/Base/Config.php.
* Default web admin user is example@gmail.com with password of 123456
* Navigate to the web accessible folder in your browser.

## Twitter Stuff
+ <http://twitter.com/QuizSimple>

## Authors

**Ben Hall**

+ <http://twitter.com/elanman>
+ <http://github.com/elanman>




## Copyright and license

Copyright 2013 Ben Hall under [the Apache 2.0 license](LICENSE).

