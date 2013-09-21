* Things are changing...
 You will need to have composer installed to add the project dependencies.
 Composer has many advantages for any PHP project; it makes installation of required external packages simple.
* Unpack the zip archive into any web accessible folder on your server.
 Run 'composer install' to get the required dependencies (currently only Pimple for DIC).
* Import res/simple-quiz.sql into MySQL.
* Create a database called 'simple-quiz'
* Change credentials in /classes/config.class.php to suit
* To create your own questions and answers, phpmyadmin is probably the easiest solution for now until an Admin backend exists.
* Navigate to the web accessible folder in your browser and it should just work.
