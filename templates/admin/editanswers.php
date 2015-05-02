<?php
include'header.php';
?>
<div id="container" class="quiz">
        <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              
              <div><a class="btn btn-primary" href="<?php echo $root; ?>/admin/quiz/<?php echo $quizid; ?>/"><span class="glyphicon glyphicon-arrow-left"></span> Back to quiz details</a></div>
                <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
                <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
                <h3>Edit Answers: </h3>
                <div class="row">
                    <div class="col-md-7">
                        <h4><?php echo $question->getText(); ?></h4>
                            <form id="answeredit" action="" method="post">
                            <table id="answers" class="table table-responsive table-hover table-bordered">
                                <thead>
                                    <tr><th style="text-align: center;">Correct Answer</th><th>Text</th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($answers as $answer) : ?>
                                    <tr class="answer-row">
                                        <td style="text-align: center;">
                                           <input class="correct" name="correct" value="<?php echo $i - 1; ?>" type="radio" <?php echo $i == 1 ? 'checked' : ''; ?>> 
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="answer[]" value="<?php echo $answer; ?>" class="form-control">
                                                <span class="input-group-btn">
                                                    <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                    endforeach;
                                    ?>
                                    <tr class="template answer-row" style="display:none;">
                                        <td style="text-align: center;">
                                           <input class="correct" name="correct" type="radio" /> 
                                        </td>
                                        <td>
                                            <div class="input-group">
                                            <input type="text" name="" value="" class="form-control answerinput">
                                            <span class="input-group-btn">
                                                <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                            </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>
                                <button type="submit" class="btn btn-success">Save <span class="glyphicon glyphicon-ok"></span></button>
                                <button id="addanswer" type="button" class="btn btn-primary pull-right">Add <span class="glyphicon glyphicon-plus-sign"></span></button>
                            </p>
                            <input type="hidden" name="_METHOD" value="PUT" />
                        </form> 
                    </div>
                    <div class="col-md-3">
                        <div id="contextual"></div>
                        <div id="contextual2"></div>
                    </div>
                </div>
            </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>
