<?php
 
require( "config.php" );
session_start();

$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$error = isset($_GET['error']) ? $_GET['error'] : "";

if ( $action != "login" && $action != "logout" && !$username && $action != "register" ) {
  login();
  exit;
}

if ($error == 'NotFound') {
  error();
}
 
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'register':
    register();
    break;
  case 'input_news':
    input_news();
    break;
  case 'edit_news':
    edit_news();
    break;
  case 'list_news':
    list_news();
    break;
  case 'publish':
    publish();
    break;
  case 'delete_news':
    delete_news();
    break;
  case 'add_user':
    add_user();
    break;
  case 'user_management':
    user_management();
    break;
  case 'delete_user':
    delete_user();
    break;
  case 'activate_user':
    activate_user();
    break;
  case 'deactivate_user':
    deactivate_user();
    break;
  default:
    dashboard();
}
 
function login() {
 
  $results = array();
  $results['pageTitle'] = "Admin Login | Widget News";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if (empty($username) or empty($password)) {
        // Login failed: display an error message to the user
        $results['errorMessage'] = "Please Fill Username and Password!";
        require( TEMPLATE_PATH . "/admin/loginForm.php" );
    } else {
        $check_login = mysql_query("SELECT id_group, nama, status FROM users WHERE username='$username' AND password='$password'");
        
        if (mysql_num_rows($check_login) > 0) {
            $run = mysql_fetch_array($check_login);
            $id_group = $run['id_group'];
            $name = $run['nama'];
            $status = $run['status'];
            if ($status == '0') {
                $results['errorMessage'] = "Your Account has been disabled";
                require( TEMPLATE_PATH . "/admin/loginForm.php" );
            } else {
                $_SESSION['id_group'] = $id_group;
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name;
                header('location: admin.php');
            }
        } else {
            $results['errorMessage'] = "Wrong Username and Password ";
            require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }
    }  
  } else {
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
}
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}

function register(){
    $results = array();
    if (isset($_POST['regis'])) {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $password1 = $_POST['password1'];
      $password2 = $_POST['password2'];
      $kategori = $_POST['kategori'];
      if ($password1 != $password2) {
        $results['errorMessage'] = "Password doesn't match !";
        require( TEMPLATE_PATH . "/admin/registrasi.php" );
      }else{
        $password1 = md5($password1);
        //$tes = "INSERT INTO users (nama,username,password,id_group,status) VALUES('','$name','$username','$password1','$kategori','0')";
        //echo $tes;die;
        $insert = mysql_query("INSERT INTO users (nama,username,password,id_group,status) VALUES('$name','$username','$password1','$kategori','0')");
        $results['successMessage'] = "Registration succeeded !";
        require( TEMPLATE_PATH . "/admin/registrasi.php" );
      }
    }else{
      require( TEMPLATE_PATH . "/admin/registrasi.php" );
    }
}

function dashboard(){
  $results = array();
  $results['pageTitle'] = "Dashboard";
  $results['main_active'] = TRUE;

  require( TEMPLATE_PATH . "/admin/dashboard.php" );
}

function input_news(){
  $results = array();
  $results['pageTitle'] = "Insert News";
  $results['news_active'] = TRUE;
  $results['insertjs'] = '$(function () {
                            $(".textarea").wysihtml5();
                            $("#datepicker1").datepicker({
                                format: "dd/mm/yyyy"
                            })
                          });';
  $results['formAction'] = "input_news";

  //print_r($_POST);die;
  if (isset($_POST['save'])) {
    //print_r($_FILES["gambar"]);die;
    if ($_FILES["gambar"]['name'] != "") {
      $target_file = UPLOAD_PATH.basename($_FILES["gambar"]["name"]);
      //echo $target_file;die;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".<br>";
          $uploadOk = 1;
      } else {
          echo "File is not an image.<br>"; 
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["gambar"]["size"] > 2000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          echo "Sorry, only JPG, JPEG, and PNG files are allowed.<br>";
          $uploadOk = 0;
      }
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; die;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";die;
          }
      }
      $filename=$_FILES["gambar"]["name"];
    }else{
      $filename = "";
    }
     
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert($filename);
    //$result['message'] = "Berhasil Memasukkan Berita";
    header( "Location: admin.php?action=list_news&status=1" );
    
  }elseif (isset($_POST['save_publish'])) {
    if ($_FILES["gambar"]['name'] != "") {
      $target_file = UPLOAD_PATH.basename($_FILES["gambar"]["name"]);
      //echo $target_file;die;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".<br>";
          $uploadOk = 1;
      } else {
          echo "File is not an image.<br>"; 
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["gambar"]["size"] > 2000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          echo "Sorry, only JPG, JPEG, and PNG files are allowed.<br>";
          $uploadOk = 0;
      }
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; die;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";die;
          }
      }
      $filename=$_FILES["gambar"]["name"];
    }else{
      $filename = "";
    }

    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert_publish($filename);
    $result['message'] = "Berhasil Memasukkan dan Mempublikasikan Berita";
    header( "Location: admin.php?action=list_news&status=2" );
  }else{
    $results['berita']= new Article;
    $results['tanggal'] ="";
    $data = Article::getKategori();
    $results['kategori'] = $data;
    // print_r($data);die;
    require(TEMPLATE_PATH.'/admin/edit_berita.php');
  }
}

function edit_news(){
  $results = array();
  $results['pageTitle'] = "Edit News";
  $results['news_active'] = TRUE;
  $results['insertjs'] = '$(function () {
                            $(".textarea").wysihtml5();
                            $("#datepicker1").datepicker({
                                format: "dd/mm/yyyy"
                            })
                          });';
 
  $results['formAction'] = "edit_news";
  if (isset($_POST['save'])) {
    $article = new Article;
    //print_r($_POST);die;
    if ( !$article = Article::getById( (int)$_POST['id_berita'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
    if ($_FILES["gambar"]['name'] != "") {
      $target_file = UPLOAD_PATH.basename($_FILES["gambar"]["name"]);
      //echo $target_file;die;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".<br>";
          $uploadOk = 1;
      } else {
          echo "File is not an image.<br>"; 
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["gambar"]["size"] > 2000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          echo "Sorry, only JPG, JPEG, and PNG files are allowed.<br>";
          $uploadOk = 0;
      }
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; die;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";die;
          }
      }
      $filename=$_FILES["gambar"]["name"];
      $article->update_gambar($filename);
    }else{
      $filename = "";
    }
    //print_r($_POST);die;
    $article->storeFormValues( $_POST );
    $article->update();
    $result['message'] = "Berhasil Mengubah Berita";
    header( "Location: admin.php?action=list_news&status=3" );
  }elseif (isset($_POST['save_publish'])) {
    if ( !$article = Article::getById( (int)$_POST['id_berita'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
    if ($_FILES["gambar"]['name'] != "") {
      $target_file = UPLOAD_PATH.basename($_FILES["gambar"]["name"]);
      //echo $target_file;die;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".<br>";
          $uploadOk = 1;
      } else {
          echo "File is not an image.<br>"; 
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["gambar"]["size"] > 2000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          echo "Sorry, only JPG, JPEG, and PNG files are allowed.<br>";
          $uploadOk = 0;
      }
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; die;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";die;
          }
      }
      $filename=$_FILES["gambar"]["name"];
      $article->update_gambar($filename);
    }else{
      $filename = "";
    }
    
    $article->storeFormValues( $_POST );
    $article->update_publish();
    $result['message'] = "Berhasil Mengubah dan Mempublikasikan Berita";
    header( "Location: admin.php?action=list_news&status=4" );
  }else{
    $id_berita = $_GET['id'];
    $data = Article::getById($id_berita);
    $results['berita']= $data;
    $tanggal = explode("-", $results['berita']->tanggal);
    $results['tanggal'] = $tanggal[1]."/".$tanggal[2]."/".$tanggal[0];
    $results['kategori'] = Article::getKategori();
    // print_r($results['berita']->isi);die;
    require(TEMPLATE_PATH.'/admin/edit_berita.php');
  }
}

function list_news(){
  $results = array();
  $message = array(
                  "1" => "Berhasil Memasukkan Berita",
                  "2" => "Berhasil Memasukkan dan Mempublikasikan Berita",
                  "3" => "Berhasil Mengubah Berita",
                  "4" => "Berhasil Mengubah dan Mempublikasikan Berita",
                  "5" => "Berita Berhasil Dipublish",
                  "6" => "Berita Telah Dihapus",
              );
  if (isset($_GET['status'])) {
    $results['message'] = $message[$_GET['status']];
    //echo $results['message'];die;
  }
  $results['news_active'] = TRUE;
  $results['pageTitle'] = "List Berita";
  $results['insertjs'] = '$(function () {
        $("#example1").dataTable();
        $("#example2").dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });';

  $data = Article::getList();
  $results['berita'] = $data['results'];
  $results['total'] = $data['total'];
  $get_kategori = Article::getKategori();
  $results['kategori'] = $get_kategori;
   // print_r($results['berita']);die;
  
  require( TEMPLATE_PATH . "/admin/list_berita.php" );
}

function publish(){
    $article = new Article;
   // echo $_GET['id'];die;
    if ($_GET['id']) {
      $id=$_GET['id'];
      //$article->storeFormValues( $_POST );
      $article->publish($id);
      $result['message'] = "Berita Berhasil Dipublish";
      header( "Location: admin.php?action=list_news&status=5" );
    }else{
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
} 

function delete_news(){
    $article = new Article;
    if ($_GET['id']) {
      $id=$_GET['id'];
      $article->delete($id);
      $result['message'] = "Berita Telah Dihapus";
      header( "Location: admin.php?action=list_news&status=6" );
    }else{
      header( "Location: admin.php?error=NotFound" );
      return;
    }
}

function add_user(){
  $results = array();
  $results['pageTitle'] = "Add Account";
  $results['user_active'] = TRUE;
    if (isset($_POST['tambahakun'])) {
      $password1 = $_POST['password'];
      $password2 = $_POST['password2'];
      $group = $_POST['group'];
      if ($password1 != $password2) {
        $results['message'] = "Password doesn't match !";
        require( TEMPLATE_PATH . "/admin/tambah_akun.php" );
      }else{ 
        //print_r($_POST);die;
        $user = new Users;
        $user->storeFormValues( $_POST );
        $user->insert();
        $results['message'] = "Registration succeeded !";
        header( "Location: admin.php?action=user_management&status=1" );
      }
    }else{
      require( TEMPLATE_PATH . "/admin/tambah_akun.php" );
    }
}

function user_management(){
  $results = array();
  $message = array(
                  "1" => "Berhasil Membuat Akun",
                  "2" => "Berhasil Mengaktifkan Akun",
                  "3" => "Berhasil Menonaktifkan Akun",
                  "4" => "Akun Telah Dihapus",
              );
  if (isset($_GET['status'])) {
    $results['message'] = $message[$_GET['status']];
    //echo $results['message'];die;
  }
  $data = Users::getList();
  $data2 = Users::getGroup();
  $results['user_active'] = TRUE;
  $results['results'] = $data['results'];
  $results['group'] = $data2;
  $results['total'] = $data['total'];

  $results['pageTitle'] = "User Management";
  $results['insertjs'] = '$(function () {
        $("#example1").dataTable();
      });';
  require( TEMPLATE_PATH . "/admin/list_user.php" );
}

function delete_user(){
    $users = new Users;
    if ($_GET['id']) {
      $id=$_GET['id'];
      $users->delete($id);
      $result['message'] = "Akun telah dihapus";
      header( "Location: admin.php?action=user_management&status=4" );
    }else{
      header( "Location: admin.php?error=NotFound" );
      return;
    }
}

function activate_user(){
    $users = new Users;
    if ($_GET['id']) {
      $id=$_GET['id'];
      $users->activate($id);
      $result['message'] = "Berhasil mengaktifkan akun";
      header( "Location: admin.php?action=user_management&status=2" );
    }else{
      header( "Location: admin.php?error=usersNotFound" );
      return;
    }
}

function deactivate_user(){
    $users = new Users;
    if ($_GET['id']) {
      $id=$_GET['id'];
      $users->deactivate($id);
      $result['message'] = "Berhasil menonaktifkan akun";
      header( "Location: admin.php?action=user_management&status=3" );
    }else{
      header( "Location: admin.php?error=usersNotFound" );
      return;
    }
}

function error(){
  $results['pageTitle'] = "Page Not Found";
  require (TEMPLATE_PATH."/404.php");
}
 
?>