<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="theme/dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="theme/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="theme/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Sport</b> Science
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <?php if ( isset( $results['errorMessage'] ) ) { ?>
        <p class="login-box-msg errorMessage"><?php echo $results['errorMessage'] ?></p>
        <?php } else{
          echo '<p class="login-box-msg">Sign in to start your session</p>';
          }?>
        <form action="admin.php?action=login" method="POST">
          <input type="hidden" name="login" value="true" />
          <div class="form-group has-feedback">
            <input id="username" type="text" class="form-control" placeholder="Username" name="username" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control" placeholder="Password" name="password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
        <br>
        <a href="admin.php?action=register" class="text-center">Register</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="theme/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="theme/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>