<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $results['pageTitle']?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="theme/dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="theme/dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="theme/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="theme/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="theme/plugins/iCheck/flat/green.css" rel="stylesheet" type="text/css" />

    <link href="theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="skin-green">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="admin.php" class="logo"><b>Sport</b> Science</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a> -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- <img src="theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/> -->
                  <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <p>
                      <?php echo "Hello, ".$_SESSION['name']; ?>
                      <!-- <small>Member since Nov. 2006</small> -->
                    </p>
                    <div class="pull-right">
                      <a href="admin.php?action=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <!-- <img src="theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> -->
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['name']; ?></p>
              <a href="admin.php?action=logout"> Logout</a>
            </div>
          </div>
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if (isset($results['main_active'])){?>
              <li class="active treeview">
            <?php }else{ ?>
              <li class="treeview">
              <?php }?>
              <a href="admin.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            
            <?php if (isset($results['news_active'])){?>
              <li class="active treeview">
            <?php }else{ ?>
              <li class="treeview">
              <?php }?>
              <a href="#">
                <i class="fa fa-edit"></i> <span>News</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin.php?action=input_news"><i class="fa fa-circle-o"></i> Insert News</a></li>
                <?php if ($_SESSION['id_group'] == "1"  ||  $_SESSION['id_group'] == "2"  ||  $_SESSION['id_group'] == "3") { ?>
                  <li><a href="admin.php?action=list_news"><i class="fa fa-circle-o"></i> List News</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php if ($_SESSION['id_group'] == "1"  ||  $_SESSION['id_group'] == "2") { ?>
            <?php if (isset($results['user_active'])){?>
              <li class="active treeview">
            <?php }else{ ?>
              <li class="treeview">
              <?php }?>
              <a href="#">
                <i class="fa fa-table"></i> <span>Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin.php?action=add_user"><i class="fa fa-circle-o"></i> Add New User</a></li>
                <li><a href="admin.php?action=user_management"><i class="fa fa-circle-o"></i> User Management</a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      