<?php include 'header.php'; ?>
<div id="container" class="quiz">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
            <?php //
            if (isset($flash['quizerror']))
            {
                echo $flash['quizerror'];
            }   
            ?>
            </div>
        </div>
    </div><!--container-->
<?php include 'footer.php';
