<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              <h2>Simple Quiz :: Admin <small><?php echo $user; ?></small></h2>
          <h4>Welcome Quizmaster!</h4>
          <p>Be careful; with great power comes great responsiblity.</p>    
          <h4>Quizzes</h4>
            <table class="table table-striped">
                <thead>
                    <tr><th>Name</th><th>Description</th><th>Active</th></tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($quizzes as $quiz) :
                        $activeSpan = $quiz->active == 1 ? 'glyphicon-ok-circle' : 'glyphicon-remove-circle';
                        echo '<tr><td><strong><a href="'. $root .'/admin/edit-quiz/'. $quiz->id .'">' . $quiz->name. '</a></strong></td><td>'.$quiz->description.'</td><td><span class="glyphicon '.$activeSpan.'"></span></td></tr>';
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>