<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
              <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
              <div id="ajaxupdater" class="alert"></div>
          <h4>Welcome Quizmaster!</h4>
          <p>Be careful; with great power comes great responsibility.</p>
          <h4>Quizzes</h4>
          <?php if (count($quizzes) > 0): ?>
            <table id="quizzes" class="table table-striped">
                <thead>
                    <tr><th>Name</th><th>Description</th><th>Category</th><th>Active</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($quizzes as $quiz) :
                            $activeSpan = $quiz->active == 1 ? 'glyphicon-ok-circle' : 'glyphicon-remove-circle';
                            echo '<tr class="quiz"><td><strong><a href="'. $root .'/admin/quiz/'. $quiz->id .'">' . $quiz->name. '</a></strong></td><td>'.$quiz->description.'</td><td>'.$quiz->category.'</td><td><span class="glyphicon '.$activeSpan.'"></span></td><td><a href="'. $root .'/admin/quiz/'. $quiz->id .'" data-quiz-id="'.$quiz->id.'" title="Edit Questions" class="edit btn btn-default btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> <button data-quiz-id="'.$quiz->id.'" title="Delete Quiz" class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                        endforeach;
                    ?>
                </tbody>
            </table>
          <?php else: ?>
          <p>There aren't any quizzes at the moment. Why not create one now?</p>
          <p>Just click the 'Create New Quiz' button below...</p>
          <?php endif; ?>
            <p>
                <button id="addquiz" title="Add New Quiz" type="button" class="btn btn-primary pull-right">Create New
                    Quiz <span class="glyphicon glyphicon-plus-sign"></span></button>
            </p>
        </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    
    <!-- Add Quiz Modal -->
    <div class="modal fade" id="quiz-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add A New Quiz:</h4>
          </div>
            <form id="quizadd" method="post" action="<?php echo $root . '/admin/quiz/'; ?>">
            <div class="modal-body">
                <p><label for="quizname">Quiz Name:</label>
                   <input name="quizname" id="quizname" type="text" placeholder="Quiz Name" class="form-control" />
                   <span class="helper help-block">Please provide a name for the quiz</span>
                </p>
                <p><label for="description">Quiz Description:</label>
                   <input name="description" id="description" type="text" placeholder="Quiz Description" class="form-control" />
                </p>
                <p><label for="category">Quiz Category:</label>
                   <select name="category" id="category" class="form-control">
                       <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                       <?php endforeach; ?>
                   </select>
                </p>
                <h4>Active?</h4>
                <p><label for="quizactiveyes"> Yes: </label>
                   <input name="active" id="quizactiveyes" value="1" type="radio" class="radio-inline" />
                   <label for="quizactiveno"> No: </label>
                   <input name="active" id="quizactiveno" value="0" type="radio" class="radio-inline" />
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Create Quiz</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php include 'footer.php'; ?>
