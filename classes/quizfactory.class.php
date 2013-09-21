<?php
class QuizFactory {
    
    public static function getQuiz(Pimple $container)
    {
        return new Quiz($container);
    }
}
?>