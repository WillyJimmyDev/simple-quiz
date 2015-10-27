# [Simple-Quiz](https://simplequiz.co.uk)
[![Software License](http://img.shields.io/badge/license-apache2-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/ElanMan/simple-quiz.png?branch=master)](https://travis-ci.org/ElanMan/simple-quiz)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/77dcca19-1dd0-4a47-86b7-1ac6142e1bbd/mini.png)](https://insight.sensiolabs.com/projects/77dcca19-1dd0-4a47-86b7-1ac6142e1bbd)

Simple-Quiz is a simple framework for creating quizzes for the web, created and maintained by [Ben Hall](http://twitter.com/elanman).

PHP version > 5.4 is required


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
    │   │   │   ├── SampleConfig.php
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
    │   ├── email/
    │   │    ├── registerconfirm.html
    │   │    └── registerconfirm.txt     
    │   ├── quiz/
    │   │    ├── error.php    
    │   │    ├── footer.php  
    │   │    ├── header.php  
    │   │    ├── quiz.php  
    │   │    ├── results.php  
    │   │    ├── test.php                      
    │   ├── category.php 
    │   ├── emailconfirmed.php
    │   ├── emailsent.php    
    │   ├── index.php
    │   ├── login.php
    │   └── requirements.php                     
    ├── vendor/
    ├── .gitignore  
    ├── .travis.yml
    ├── composer.json
    ├── composer.lock
    ├── LICENSE
    ├── phpunit.xml
    ├── .gitignore
    ├── README.md
    └── simple-quiz.sql


## Installation

### Get The Code.
* If you are downloading from SourceForge, all project dependencies are bundled with the project.
If, however, you are cloning from GitHub or downloading the release zip file, you must run 'composer install' to 
 download all of the dependencies.
* If you don't know what composer is, take a look here: [Composer](https://getcomposer.org/)
* Unpack the downloaded code zip archive.
* Place the contents of the /public directory inside your document root.
* All other directories should be placed outside of the document root and not accessible via a web browser (look at the above diagram to see the structure).
* The mod_rewrite module (if using apache server) or [URL Rewrite](http://www.iis.net/downloads/microsoft/url-rewrite) module (if using IIS) will need to be enabled in 
your server configuration.
* Create a MySQL database called 'simple-quiz'
* Import simple-quiz.sql into MySQL using a tool like phpmyadmin or using the MySQL 'source' command.
* Change credentials in /SimpleQuiz/Utils/Base/SampleConfig.php.
* Rename SampleConfig.php to Config.php
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
