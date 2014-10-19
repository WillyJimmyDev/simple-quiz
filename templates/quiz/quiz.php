<?php 
    include'header.php';
    $numquestions = $quiz->countQuestions();
    $leadersToShow = 10;
?>
    <div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-5 col-md-push-5">
          <h2>Quiz :: <?php echo $quiz->getName(); ?></h2>
          <h4><?php echo $quiz->getDescription(); ?></h4>
          <p>Once you have started the quiz, you must answer all of the questions. If you try to go back to the previous question, your score will be reset and you will be sent back to the start.</p>
          <p>For each question, choose an answer and click <strong>'Submit Answer'</strong>. You'll then be given the next question.</p>
          <p>There are <?php echo $numquestions; ?> questions, so let's get cracking!</p>
          <p>You'll get your score at the end of the test.</p>
          <div id="leaders-score">
                <h4>Top <?php echo $leadersToShow; ?> Scorers</h4>
                <div class="row">
                    <ul class="leaders col-md-6">
                        <?php
                        $leaders = $quiz->getLeaders($leadersToShow);
                        $counter = 1;
                        foreach ($leaders as $leader) :

                            echo '<li><strong>' . $leader["name"] . '</strong>: ' .  $leader["score"] . '/' . $numquestions . '</li>';

                            //Use modulus to create new sub-list if required.
                            if ($counter % (round($leadersToShow/2)) == 0) :  
                                echo '</ul>' . PHP_EOL . '<ul class="leaders col-md-6">' . PHP_EOL;
                            endif;

                            $counter++;

                        endforeach;
                        ?>
                    </ul>
                </div>
            </div><!-- leaders-score-->
        </div>
        
        <div class="col-md-3 col-md-offset-2 col-md-pull-5">
          <h2>Start The Quiz</h2>
            <form id="questionBox" method="post" action="<?php echo $root; ?>/quiz/process">
                <!--<p>If you want worldwide glory and fame, register a username below.</p>--> 
                <?php if ($requireauth) : ?>
                <p>
                    <label for="username">Create A Username:</label><br />
                    <input type="text" id="username" class="form-control" name="username" placeholder="Username" />
                    <input type="hidden" name="register" value="TRUE" />
                </p>
                <?php endif; ?>
                <p>
                <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                    <input type="submit" id="submitstart" class="btn btn-primary" value="Start Quiz" /></p>
            </form> 
            <p id="helper"><?php echo $error; ?></p>
        </div><!-- /.col-lg-4 -->
        
      </div><!-- /.row -->
        
    </div><!--container-->
<?php include 'footer.php'; ?>