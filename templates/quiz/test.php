<?php include 'header.php'; ?>
<div id="container" class="quiz">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?php 
            if (! $session->get('last') ) : 
                $question = $quiz->getQuestion($num);
                $answers = $quiz->getAnswers($num);
            ?>
            <h4>Current tester: <strong><?php echo $user; ?></strong></h4>
            <h2>Question <?php echo $num; ?>:</h2>
            <p><?php echo $question; ?></p>
            <form id="questionBox" method="post" action="<?php echo $root; ?>/quiz/process">
                <ul>
                <?php 
                $shuffledAnswers = shuffle_assoc($answers);

                $acount = 0;
                foreach ($shuffledAnswers as $answer) 
                {
                    echo '<li><input type="radio" id="answer' . $acount . '" value="' . $answer . '" name="answers" />' .PHP_EOL;
                    echo '<label for="answer' . $acount . '">' . $answer . '</label></li>' . PHP_EOL;
                    $acount++;
                }
                ?>
                </ul>
            <p>
                <input type="hidden" name="num" value="<?php echo $num; ?>" />
                <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                <input type="hidden" name="submitter" value="TRUE" />
                <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit Answer" />
            </p>
        </form>
        <?php 
        else :
            $timeportions = explode(':', $timetaken);
            $mins = $timeportions[0] == '00' ? '' : ltrim($timeportions[0],'0') . ' mins ';
            $secs = $timeportions[1] . ' secs' ;
            echo '<div id="finalscore">';
            echo '<h2 id="score">' . $user . ', your final score is:</h2>' . PHP_EOL;
            echo '<h2 class="userscore">' . $session->get('score') . '/'. count($quiz->getQuestions()) .'</h2>' . PHP_EOL;
            echo '<h3 id="time">Time Taken: ' . $mins.$secs . '</h3>' . PHP_EOL;

            echo '<p id="compare"><a href="'. $root . '/quiz/' . $quiz->getId() . '/results">See how you compare! <img src="images/arrow.png" /></a></p>';
            echo '</div>';
        endif;
        ?>
        </div>
    </div>
</div><!--container-->
<?php include 'footer.php'; ?>