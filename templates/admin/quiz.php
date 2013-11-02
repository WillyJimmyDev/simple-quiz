<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
            <div id="intro" class="col-md-8 col-md-offset-2">
                 <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
                 <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
                <div id="ajaxupdater" class="alert"></div>
                <h3>Quiz Details:</h3>
                <ul>
                    <li><strong>Name</strong>: <?php echo $quiz->getName(); ?></li>
                    <li><strong>Description</strong>: <?php echo $quiz->getDescription(); ?></li>
                    <li><strong>Active? <?php echo $quiz->isActive() ? '<span class="glyphicon glyphicon-ok">' : '<span class="glyphicon glyphicon-remove-circle">' ?></strong></li>
                    <li><strong>Number Of Questions</strong>: <?php echo count($quiz->getQuestions()); ?></li>
                    <li><strong>Times Taken</strong>: <?php echo count($quiz->getUsers()); ?></li>
                </ul>
                <h4>Questions:</h4>
                <table id="questions" class="table table-striped table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Question</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($quiz->getQuestions() as $id => $text) :?>
                        <tr class="question">
                            <td class="question"><?php echo $text; ?></td>
                            <td style="text-align:center;">
                                <button data-question-id="<?php echo $id; ?>" title="Edit Question" class="edit btn btn-default btn-primary" type="button"><span class="glyphicon glyphicon-pencil"></span></button>
                                <a href="<?php echo $root; ?>/admin/quiz/<?php echo $quiz->getId(); ?>/question/<?php echo $id; ?>/edit/" title="Edit Answers" class="answerlink btn btn-default btn-primary"><span class="glyphicon glyphicon-list"></span></a>
                                <button data-question-id="<?php echo $id; ?>" data-quiz-id="<?php echo $quiz->getId(); ?>" title="Delete Question" class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>  
                    </tbody>
                </table>
                <p>
                    <button id="addquestion" title="Add New Question" type="button" class="btn btn-primary pull-right">Add <span class="glyphicon glyphicon-plus-sign"></span></button>
                </p>
            </div>
      </div><!-- /.row -->
        
</div><!--container-->
<!-- Modals -->
<!-- Edit Question Modal -->
    <div class="modal fade" id="qmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Question:</h4>
          </div>
            <form id="questionedit" method="post" action="">
            <div class="modal-body">
                <p>
                   <input name="questiontext" id="questioninput" type="text" class="form-control" />
                   <input name="questionid" id="questionid" type="hidden" />
                   <input type="hidden" name="_METHOD" value="PUT" />
                   <span class="helper help-block">Questions can't be empty!.</span>
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button id="savetext" type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
<!-- Add Question Modal -->
    <div class="modal fade" id="q-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add A New Question:</h4>
          </div>
            <form id="questionadd" method="post" action="">
            <div class="modal-body">
                <p><label for="newquestioninput">Question:</label>
                   <input name="questiontext" id="newquestioninput" type="text" placeholder="Your question here" class="form-control" />
                   <span class="helper help-block">Questions can't be empty!</span>
                </p>
                <h5><strong>Answers:</strong></h5>
                <table id="newanswers" class="table table-responsive table-hover table-bordered">
                    <thead>
                        <tr><th style="text-align: center;">Correct Answer?</th><th>Answer</th></tr>
                    </thead>
                    <tbody>
                        <tr class="answer-row">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" value="0" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="answer[]" placeholder="Answer" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr class="answer-row">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" value="1" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="answer[]" placeholder="Answer" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr class="template answer-row" style="display:none;">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                <input type="text" placeholder="Answer" name="" value="" class="form-control answerinput">
                                <span class="input-group-btn">
                                    <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><button id="addanswer" type="button" class="btn btn-primary pull-right">Add Another Answer <span class="glyphicon glyphicon-plus-sign"></span></button></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save Question</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php include 'footer.php'; ?>