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
                    <p>Thank you for registering. Please check your inbox. An email has been sent to your email
                        address. You will need to confirm your email before you can take a quiz.</p>
                </div>
            </div><!--/span-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="sidebar-nav">
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
