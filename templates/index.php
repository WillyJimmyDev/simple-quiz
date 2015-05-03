<?php
    include'quiz/header.php'; 
?>
    <div id="container" class="quiz">
        <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Simple Quiz</h1>
            <p>A simple framework for creating and displaying quizzes. Written in PHP.</p>
          </div>
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="sidebar-nav">
              <h4>Recent Quizzes</h4>
              <div class="list-group">
              <?php foreach ($quizzes as $quiz) : 
                    echo '<a href="'.$root . '/quiz/' . $quiz->id .'" class="list-group-item">';
                    echo '<h4 class="list-group-item-heading">'. $quiz->name . '</h4>';
                    echo '<p class="list-group-item-text">'. $quiz->description . '</p>';
                    echo '</a>';
                endforeach;
                ?>
              </div>
          </div><!--/.sidebar-nav -->
        </div><!--/span-->
      </div><!--/row-->
        
    </div><!--container-->
<?php include 'quiz/footer.php';
