<?php include 'header.php'; ?>
<div id="container" class="quiz">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?php 
            if (! $quiz->session->get('last') ) : 
                $question = $quiz->getQuestion($num);
                $answers = $quiz->getAnswers($num);
            if( $quiz->session->get('user') ) echo '<h4>Current tester: <strong>' . $quiz->session->get('user') . '</strong></h4>'; 
            ?>
            
            <h2>Question <?php echo $num; ?>:</h2>
            <p>What does <strong><?php echo $question; ?></strong> stand for?</p>
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
            echo '<h2 id="score">' . $quiz->session->get('user') . ', your final score is:</h2>' . PHP_EOL;
            echo '<h2 class="userscore">' . $quiz->session->get('score') . '/'. count($quiz->getQuestions()) .'</h2>' . PHP_EOL;
            echo '<h3 id="time">Time Taken: ' . $mins.$secs . '</h3>' . PHP_EOL;
            echo '<h4>Verdict:</h4>' . PHP_EOL;

            if ( $quiz->session->get('score')  <= 5) 
            {
                $verdict = "Don't Give Up Your Day Job.";
            }
            if ($quiz->session->get('score') > 5) 
            {
                $verdict = 'Pretty Poor.';
            }
            if ($quiz->session->get('score') > 10) 
            {
                $verdict = 'Not Bad.';
            }
            if ($quiz->session->get('score') > 15) 
            {
                $verdict = 'You Are A Legend!';
            }

            echo '<p id="verdict">' . $verdict . '</p>';

            echo '<p id="compare"><a href="'. $root . '/quiz/' . $quiz->getId() . '/results">See how you compare! <img src="images/arrow.png" /></a></p>';
            echo '</div>';
        endif;
        ?>
        </div>
    </div>
</div><!--container-->
<?php include 'footer.php'; ?>