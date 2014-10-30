<?php include 'header.php'; ?>
<div id="container" class="quiz">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?php 
            if (! $session->get('last') ) : 
                $question = $quiz->getQuestion($num);
                $answers = $quiz->getAnswers($num);
            ?>
            <?php if ($requireauth) : ?>
                <h4>Current tester: <strong><?php echo $user->getName(); ?></strong></h4>
            <?php endif; ?>
            <h2>Question <?php echo $num; ?>:</h2>
            <p><?php echo $question->getText(); ?></p>
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
                <input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
                <input type="hidden" name="num" value="<?php echo $num; ?>" />
                <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit Answer" />
            </p>
        </form>
        <?php
            /**
             * @todo extract following into helper function
             */
        else :
            $timeportions = explode(':', $timetaken);
            $mins = $timeportions[0] == '00' ? '' : ltrim($timeportions[0],'0') . ' mins ';
            $secs = $timeportions[1] . ' secs' ;
            $percentage = round(( (int) $session->get('score') / (int) $quiz->countQuestions() ) * 100);
            echo '<div id="finalscore">';
            //$user = $requireauth ? $user : "";
            echo '<h2 id="score">' . $user->getName() . ' answered ' . $session->get('score') . ' correct out of a
            possible ' .
                $quiz->countQuestions() . '</h2>' . PHP_EOL;
            echo '<h2 class="userscore">' .  $percentage . '%</h2>' . PHP_EOL;
            echo '<h3 id="time">Time Taken: ' . $mins.$secs . '</h3>' . PHP_EOL;

            echo '<p id="compare"><a href="'. $root . '/quiz/' . $quiz->getId() . '/results">See how you compare!</a></p>';
            echo '</div>';
        endif;
        ?>
        </div>
    </div>
</div><!--container-->
<?php include 'footer.php'; ?>