<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
            <div id="intro" class="col-md-8 col-md-offset-2">
                 <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
                 <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
                <div id="ajaxupdater" class="alert"></div>
                <div><a class="btn btn-primary" href="<?php echo $root; ?>/admin/"><span class="glyphicon glyphicon-arrow-left"></span> Back to all quizzes</a></div>
                <br />
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h3>Quiz Details:</h3></div>
                    <div class="panel-body">
                      <ul style="width:50%;" class="list-group">
                          <li class="list-group-item"><strong>Name</strong>: <?php echo $quiz->getName(); ?></li>
                          <li class="list-group-item"><strong>Description</strong>: <?php echo $quiz->getDescription(); ?></li>
                          <li class="list-group-item"><strong>Category</strong>: <?php echo $quiz->getCategory(); ?></li>
                          <li class="list-group-item"><strong>Active? </strong><?php echo $quiz->isActive() ? '<span class="glyphicon glyphicon-ok">' : '<span class="glyphicon glyphicon-remove-circle">' ?></li>
                          <li class="list-group-item"><strong>Number Of Questions</strong>: <span class="badge"><?php
                                  echo $quiz->countQuestions(); ?></span></li>
                          <li class="list-group-item"><strong>Times Taken</strong>: <span class="badge"><?php echo count($quiz->getUsers()); ?></span></li>
                      </ul>
                        <button id="editquiz" title="Edit Quiz Details" type="button" class="btn btn-primary">Edit Quiz Details <span class="glyphicon glyphicon-pencil"></span></button>
                    </div>
                  <div class="panel-heading"><h3>Questions:</h3></div>
                    <!-- Table -->
                    <table id="questions" class="table table-striped table-responsive">
                          <thead>
                              <tr>
                                  <th>Question</th><th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($quiz->getQuestions() as $question) :?>
                              <tr class="question">
                                  <td class="question"><?php echo $question->getText(); ?></td>
                                  <td style="text-align:center;">
                                      <button data-question-id="<?php echo $question->getNum(); ?>" title="Edit
                                      Question" class="edit btn btn-default btn-primary" type="button"><span class="glyphicon glyphicon-pencil"></span></button>
                                      <a href="<?php echo $root; ?>/admin/quiz/<?php echo $quiz->getId();
                                      ?>/question/<?php echo $question->getNum(); ?>/edit/" title="Edit Answers"
                                         class="answerlink btn btn-default btn-primary"><span class="glyphicon glyphicon-list"></span></a>
                                      <button data-question-id="<?php echo $question->getNum(); ?>" data-quiz-id="<?php
                                      echo $quiz->getId(); ?>" title="Delete Question" class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                              </tr>
                              <?php endforeach; ?>  
                          </tbody>
                      </table>
                      <div class="panel-body">
                          <button id="addquestion" title="Add New Question" type="button" class="btn btn-primary pull-right">Add Question <span class="glyphicon glyphicon-plus-sign"></span></button>
                      </div>
                </div>
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
    
    <!-- Update Quiz Modal -->
    <div class="modal fade" id="quiz-edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Quiz:</h4>
          </div>
            <form id="quizedit" method="post" action="<?php echo $root . '/admin/quiz/'; ?>">
            <div class="modal-body">
                <p><label for="quizname">Quiz Name:</label>
                   <input name="quizname" id="quizname" type="text" placeholder="Quiz Name" class="form-control" value="<?php echo $quiz->getName(); ?>" />
                   <span class="helper help-block">Please provide a name for the quiz</span>
                </p>
                <p><label for="description">Quiz Description:</label>
                   <input name="description" id="description" type="text" placeholder="Quiz Description" value="<?php echo $quiz->getDescription(); ?>" class="form-control" />
                </p>
                <p><label for="category">Quiz Category:</label>
                   <select name="category" id="category" class="form-control" />
                     <?php foreach ($categories as $category) : ?>
                           <?php $selected = ($category->name == $quiz->getCategory()) ? 'selected' : ''; ?>
                           <option value="<?php echo $category->id; ?>" <?php echo $selected; ?>><?php echo $category->name; ?></option>
                       <?php endforeach; ?>
                   </select>
                </p>
                <h4>Active?</h4>
                <p><label for="quizactiveyes" class="inline"> Yes: </label>
                   <input name="active" id="quizactiveyes" value="1" <?php if ($quiz->isActive()) { echo 'checked';} ?> type="radio" class="" /><br />
                   <label for="quizactiveno"> No: </label>
                   <input name="active" id="quizactiveno" value="0" <?php if (! $quiz->isActive()) { echo 'checked';} ?> type="radio" class="radio-inline" />
                   <input type="hidden" name="_METHOD" value="PUT" />
                   <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php include 'footer.php'; ?>
