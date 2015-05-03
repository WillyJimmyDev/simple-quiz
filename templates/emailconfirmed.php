<?php
include 'quiz/header.php';
?>
    <div id="container" class="quiz">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
                <div class="jumbotron">
                    <p>You have successfully confirmed your email address. You can now <a class="btn btn-success" href="<?php
                        echo $root;
                        ?>/login">Login</a></p>
                </div>
            </div><!--/span-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="sidebar-nav">
                    <div class="list-group">
                        <?php foreach ($quizzes as $quiz) : ?>
                            <a href="<?php echo $root . '/quiz/' . $quiz->id; ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo $quiz->name; ?></h4>
                            <p class="list-group-item-text"><?php echo $quiz->description; ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div><!--/.sidebar-nav -->
            </div><!--/span-->
        </div><!--/row-->

    </div><!--container-->
<?php include 'quiz/footer.php';
