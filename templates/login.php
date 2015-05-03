<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="<?php echo $root; ?>/res/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/res/css/quiz.css" />
    <title>Simple Quiz :: Login</title>
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
            <li><a href="<?php echo $root; ?>/">Quizzes</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
        <p><?php if (isset($errors['loginerror']) ) { echo $errors['loginerror']; }?></p>
        <p><?php if (isset($errors['registererror']) ) { echo $errors['registererror']; }?></p>
        <div class="row-fluid">
            <div class="col-sm-6 col-sm-offset-3">
                <form id="login-form" class="form-signin" method="post" action="<?php echo $root; ?>/login">
                    <input type="email" name="email" class="form-control" placeholder="Email" autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                    <br>
                    <p><button id="register-button" class="btn btn-lg btn-primary btn-block">Register</button></p>
                </form>
                <form style="display: none" id="register-form" class="form-signin" method="post" action="<?php echo $root;
                ?>/register">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <input type="password" name="regpassword" class="form-control" placeholder="Password">
                    <input type="password" name="regpasswordconf" class="form-control" placeholder="Confirm Password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div><!--container-->
    <script src="<?php echo $root; ?>/res/bootstrap/assets/js/jquery.js"></script>
    <script src="<?php echo $root; ?>/res/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $root; ?>/res/js/login.js"></script>
</body>
</html>
