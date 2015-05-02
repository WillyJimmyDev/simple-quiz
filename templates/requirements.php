<?php include'quiz/header.php'; ?>
<div id="container" class="quiz">
<div class="row row-offcanvas row-offcanvas-right">
<div class="col-xs-12">
<p class="pull-right visible-xs">
<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
</p>
<div>
<h2>Checking Dependencies</h2>
<ul>
<li><p>PHP Version: <?php echo $requirements['version']['vers'] . ' <span class="glyphicon glyphicon-' . $requirements['version']['img'] . '"></span>'; ?></p>
<p class="alert alert-info">(<?php echo $requirements['version']['msg']; ?>)</p>
</li>
<li>
<p>Access To Randomness: <?php echo $requirements['random']['random'] . ' <span class="glyphicon glyphicon-' . $requirements['random']['img']. '"></span>'; ?></p>
<p class="alert alert-info">(<?php echo nl2br($requirements['random']['msg']); ?>)</p>
</li>
</ul>
</div>
</div><!--/span-->
</div><!--/row-->
</div><!--container-->
</body>
</html>
