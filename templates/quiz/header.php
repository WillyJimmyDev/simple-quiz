<?php
$title = isset($quiz) ? 'Simple Quiz :: ' . $quiz->getName() : 'Simple Quiz';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="<?php echo $root; ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo $root; ?>/res/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/res/css/quiz.css" />
    <title><?php echo $title; ?></title>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo $root; ?>/res/bootstrap/dist/assets/js/html5shiv.js"></script>
      <script src="<?php echo $root; ?>/res/bootstrap/dist/assets/js/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $root; ?>/">Simple Quiz</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li class="dropdown active">
                <a href="<?php echo $root; ?>/categories/" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php foreach ($categories as $cat): ?>
                       <li><a href="<?php echo $root; ?>/categories/<?php echo $cat->id ;?>"><?php echo $cat->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <?php if ($user): ?>
                  <li><a href="<?php echo $root; ?>/logout/">Logout</a></li>
                  <?php if($user->isAdmin()) :?>
                      <li><a href="<?php echo $root; ?>/admin/">Admin</a></li>
                  <?php endif; ?>
              <?php else : ?>
                  <li><a href="<?php echo $root; ?>/login/">Login</a></li>
              <?php endif; ?>
          </ul>
            <?php if ($user) : ?>
                <p class="signed navbar-text pull-right"><span class="glyphicon glyphicon-user"></span> Signed in as
                <strong><?php echo $user->getName(); ?></strong></p>
            <?php endif; ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
