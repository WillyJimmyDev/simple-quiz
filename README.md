* Things have changed...
 If you are downloading from SourceForge, you don't need to have composer installed to add the project dependencies as they are bundled with the project.
 If, however, you are cloning from github, you must run composer install to get the latest changes as new dependencies are being added all the time and the vendor directory is no longer in version control.
 That is, after all, what composer is for.
 Composer has many advantages for any PHP project; it makes installation of required external packages simple.
* Unpack the zip archive into any web accessible folder on your server.
* Create a database called 'simple-quiz'
* Import res/simple-quiz.sql into MySQL using a tool like phpmyadmin.
* Change credentials in /SimpleQuiz/Utils/Base/Config.php to suit
* To create your own questions and answers, phpmyadmin is probably the easiest solution for now until an Admin backend exists.
* Navigate to the web accessible folder in your browser.
