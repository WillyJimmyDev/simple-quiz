<?php
include'header.php';
?>
<div id="container" class="quiz">
        <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
                <h2>Simple Quiz :: Admin <small><?php echo $user; ?></small></h2>
                <h3>Edit Question: </h3>
                <div class="row">
                    <div class="col-md-7">
                        <form action="" method="post">
                            <h4><span id="questiontext"><?php echo $question; ?></span> <a id="editor" class="edit"><span class="glyphicon glyphicon-pencil"></span></a></h4>

                            <table class="table table-responsive table-hover table-bordered">
                                <thead>
                                    <tr><th style="text-align: center;">Correct Answer</th><th>Text</th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($answers as $answer) : ?>
                                    <tr class="answer-row">
                                        <td style="text-align: center;">
                                           <input class="correct" name="correct" type="radio" <?php echo $i == 1 ? 'checked' : ''; ?>> 
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="answer<?php echo $i; ?>" value="<?php echo $answer; ?>" class="form-control">
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
    
    <!-- Modal -->
    <div class="modal fade" id="qmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Question:</h4>
          </div>
          <div class="modal-body">
              <p><input id="questioninput" type="text" class="form-control" /></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button id="savetext" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php include 'footer.php'; ?>