# [Simple-Quiz](http://quiz.elanman.com)

Simple-Quiz is a simple framework for creating quizzes for the web, created and maintained by [Ben Hall](http://twitter.com/elanman).


## Quick start

Three quick start options are available:

* [Download the latest release (github)](https://github.com/elanman/simple-quiz/releases/tag/v1.6.0).
* [Download the latest release (sourceforge)](https://sourceforge.net/projects/simple-quiz/).
* Clone the repo: `git clone https://github.com/elanman/simple-quiz.git`.


### What's included

Within the download you'll find the following directories and files:


    /
    ├── SimpleQuiz/
    │   ├── Utils/
    │       ├── Base/
    │       │   ├── Config.php
    │       │   ├── DB.php
    │       │   ├── LeaderBoardInterface.php
    │       │   ├── QuizInterface.php
    │       │   ├── SessionInterface.php
    │       │   ├── SimpleInterface.php
    │       │   └── setup.php
    │       ├── LeaderBoard.php
    │       ├── Quiz.php
    │       ├── Session.php
    │       └── Simple.php
    ├── public/ (**this is your document root**)
    │   ├── images/
    │   ├── res/
    │   │    ├── bootstrap/
    │   │    ├── css/
    │   │    ├── js/
    │   ├── .htaccess
    │   └── index.php
    ├── routes/
    ├── templates/
    └── vendor/



## Installation

* Things have changed...
 If you are downloading from SourceForge or downloading a release from GitHub, you don't need to have composer installed to add the project dependencies as they are bundled with the project.
 If, however, you are cloning from github, you must run composer install to get the latest changes as new dependencies are being added all the time and the vendor directory is no longer in version control.
* Unpack the zip archive.
* Place the contents of the /public directory inside your document root.
* All other directories should be placed outside of the document root and not accessible via a web browser (look at the above diagram to see the structure).
* Create a MySQL database called 'simple-quiz'
* Import simple-quiz.sql into MySQL using a tool like phpmyadmin.
* Change credentials in /SimpleQuiz/Utils/Base/Config.php to suit.
* Default web admin user is example@gmail.com with password of 123456
* Remember to change admin password from within phpMyadmin. Make sure password is sha1 hashed.
* To create your own questions and answers, phpmyadmin is probably the easiest solution for now until an Admin backend exists.
* Navigate to the web accessible folder in your browser.



## Authors

**Ben Hall**

+ <http://twitter.com/elanman>
+ <http://github.com/elanman>




## Copyright and license

Copyright 2013 Ben Hall under [the Apache 2.0 license](LICENSE).

