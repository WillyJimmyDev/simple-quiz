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
<!--          <div class="row">
              <?php //foreach ($quizzes as $simplequiz): ?>
                <div class="col-6 col-sm-6 col-lg-4">
                    <h2><?php //echo $simplequiz['name']; ?></h2>
                    <p><?php //echo $simplequiz['description']; ?></p>
                    <p><a class="btn btn-default" href="<?php //echo $root . '/quiz/' . $simplequiz['id']; ?>">View details &raquo;</a></p>
                </div>
              <?php //endforeach;?>
          </div>/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
            <ul class="nav">
              <li>Quizzes</li>
              <?php foreach ($quizzes as $simplequiz)
              {
                  echo '<li><a href="'.$root . '/quiz/' . $simplequiz->id .'">'. $simplequiz->name . '</a></li>';
              }
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->
        
    </div><!--container-->
<?php include 'quiz/footer.php'; ?>