<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Register</title>
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
    <div class="register-box">
      <div class="register-logo">
        <b>Sport</b> Science
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

         <?php if ( isset( $results['errorMessage'] ) ) { ?>
        <h4 class="login-box-msg errorMessage"><b><i><?php echo $results['errorMessage'] ?></i></b></h4>
        <?php } elseif ( isset( $results['successMessage'] ) ) { ?>
        <h4 class="login-box-msg successMessage"><b><i><?php echo $results['successMessage'] ?></i></b></h4>
        <?php } ?>

        <form action="admin.php?action=register" method="post">
          <input type="hidden" name="regis" value="true" />
          <div class="form-group has-feedback">
            <label>Full Name</label>
            <input name="name" type="text" class="form-control" placeholder="Full name" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Username</label>
            <input name="username" type="text" class="form-control" placeholder="Username" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Password</label>
            <input name="password1" type="password" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Confirm Password</label>
            <input name="password2" type="password" class="form-control" placeholder="Retype password" required/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>User Type</label>
            <select class="form-control" name="kategori" id="kategori" required>
              <option value="">Please Select</option>
              <option value="3">Redaktur</option>
              <option value="4">Jurnalis</option>
              <option value="5">User</option>
            </select>
          </div>
          <div class="row">
            <!-- <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>                        
            </div> --><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>        
        <br/>
        <br/>
        <a href="admin.php?action=login" class="text-center">Sign In</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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