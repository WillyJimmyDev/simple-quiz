<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
                <h2>Simple Quiz :: Admin <small><?php echo $user; ?></small></h2>
                <h4>Question: <?php echo $question; ?></h4>
                <ul>
                    <li><h5>Answers:</h5>
                        <ul>
                          <?php
                          foreach ($answers as $answer) :
                              echo '<li>' .$answer . '</li>';
                          endforeach;
                          ?> 
                        </ul>
                    </li>
                </ul>
            </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>