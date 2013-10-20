<?php include 'header.php'; ?>
<div id="container" class="quiz">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <h2>The Results Page For <span><?php echo $quiz->session->get('user');  ?></span></h2> 
            <?php
            $x = 1;
            $numquestions = count($quiz->getQuestions());
       
            foreach ($quiz->getAnswers() as $answergroup) :
                if ($x % 2 !== 0) echo '<div style="clear:both"></div>';
                echo '<div class="col-md-6 clearfix">';
                echo '<h4>Question' . ($x) . ': ' . $quiz->getQuestion($x) . '</h4>';
                echo '<ol>' . PHP_EOL;
                    $y = 0;
                    foreach( $answergroup as $answer) :
                        if (isset($_SESSION['correct'][$x])):
                            //first in array(correct by default) AND chosen by user
                            if ( ($y === 0) && ( in_array( $answer, $_SESSION['correct'][$x]) ) ) :
                                echo '<li class="correctuser">'. $answer. ' (Correct!)</li>' . PHP_EOL;
                            //correct but not chosen by user
                            elseif ($y === 0) :
                                echo '<li class="correct">' . $answer . '</li>'  . PHP_EOL;
                            //wrong, not chosen by user
                            else :
                                echo "<li>$answer</li>\n";
                            endif;
                           
                            //wrong AND chosen by user
                        else :
                            if ( in_array( $answer, $_SESSION['wrong'][$x])) :
                                echo '<li class="wrong">' . $answer . ' (Woops!)</li>' . PHP_EOL;
                            //correct but not chosen by user
                            elseif ($y === 0) :
                                echo '<li class="correct">' . $answer . '</li>'  . PHP_EOL;
                            //wrong, not chosen by user
                            else :
                                echo "<li>$answer</li>\n";
                            endif;
                        endif;
                        
                         $y++;
                    endforeach;
                echo '</ol>';
                echo '</div>';
             
                //move on to next set of answers
                $x++;
            endforeach; ?>
            </div>
            <div class="col-md-3">   
                <h2>Top Scorers</h2>
                <ul class="leaders">
                    <?php
                    $leaders = $quiz->getLeaders(30);
                    $counter = 1;
                    foreach ($leaders as $key => $value) :
                        
                        //if current user, bolden the username
                        if ( ( $quiz->session->get('user') ) && ($key == $quiz->session->get('user') ) ) :
                            $key = '<strong class="currentuser">' . $key . '</strong>';
                        endif;
                        
                        echo '<li>' . $key. ': ' .  $value . '/' . $numquestions . '</li>';
                        
                        $counter++;
                        
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div><!--container-->
<?php include 'footer.php'; ?>