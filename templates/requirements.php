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
<li><p>PHP Version: <?php echo $requirements['version'][0] . ' ' . $requirements['version'][1]; ?></p>
<p class="alert alert-info">(<?php echo $requirements['version'][2]; ?>)</p>
</li>
<li>
<p>Access To Randomness: <?php echo $requirements['random'][0] . ' ' . $requirements['random'][1]; ?></p>
<p class="alert alert-info">(<?php echo $requirements['random'][2]; ?>)</p>
</li>
</ul>
</div>
</div><!--/span-->
</div><!--/row-->
</div><!--container-->
</body>
</html>