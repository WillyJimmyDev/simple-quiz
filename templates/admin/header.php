<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="<?php echo $root; ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo $root; ?>/res/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/res/css/quiz.css" />
    <title>Simple Quiz :: Admin</title>
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
            
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $root; ?>/admin/">All Quizzes</a></li>
                    <li class="disabled"><a href="<?php echo $root; ?>/admin/config/">Settings</a></li>
                    <li class="disabled"><a href="<?php echo $root; ?>/admin/edit/">Change Password</a></li>
                    <li><a href="<?php echo $root; ?>/logout/">Logout</a></li>
                </ul>
            </li>
          </ul>
            <p class="signed navbar-text pull-right"><span class="glyphicon glyphicon-user"></span> Signed in as
                <strong><?php echo $user->getName(); ?></strong></p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
