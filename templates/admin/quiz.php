<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              <h2>Simple Quiz :: Admin <small><?php echo $user; ?></small></h2>
              <h4>At A Glance:</h4>
          <ul>
              <li><strong>Name</strong>: <?php echo $quiz->getName(); ?></li>
              <li><strong>Description</strong>: <?php echo $quiz->getDescription(); ?></li>
              <li><strong>Active? <?php echo $quiz->isActive() ? '<span class="glyphicon glyphicon-ok">' : '<span class="glyphicon glyphicon-remove-circle">' ?></strong></li>
              <li><strong>Number Of Questions</strong>: <?php echo count($quiz->getQuestions()); ?></li>
              <li><strong>Times Taken</strong>: <?php echo count($quiz->getUsers()); ?></li>
          </ul>
          <h4>More Information:</h4>
          <ul>
              <li><h5>Questions:</h5>
                  <ul>
                    <?php
                    foreach ($quiz->getQuestions() as $id => $text) :
                        echo '<li>' .$text . ' <a href="'.$root.'/admin/quiz/'.$quiz->getId().'/question/edit/'.$id.'/"><span class="glyphicon glyphicon-pencil"></a></li>';
                    endforeach;
                    ?> 
                  </ul>
              </li>
<!--              <li><h5>Users</h5>
                  <ul>
                    //<?php
//                    foreach ($quiz->getUsers() as $quizuser => $quizscore) :
//                        echo '<li>' .$quizuser . '</li>';
//                    endforeach;
//                    ?> 
                  </ul>
              </li>-->
          </ul>
        </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>