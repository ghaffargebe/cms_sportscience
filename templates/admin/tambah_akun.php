<?php include "templates/include/header.php"; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Account
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Setting</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class='row'>
        <div class='col-md-12'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Menambahkan Akun Baru</h3>
            </div><!-- /.box-header -->
          <form action="admin.php?action=add_user" method="post">
            <input type="hidden" name="tambahakun" value="true" />
            <div class='box-body pad'>
            <?php if ( isset( $results['message'] ) ) { ?>
			        <div class="message"><?php echo $results['message'] ?></div>
			      <?php } ?>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input name="nama" type="text" class="form-control" id="NamaLengkap" placeholder="Masukkan Nama Lengkap Anda" required>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input name="username" type="text" class="form-control" id="Username" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group has-feedback">
            <label>Password</label>
            <input name="password" type="password" class="form-control" placeholder="Password" required />
          </div>
          <div class="form-group has-feedback">
            <label>Confirm Password</label>
            <input name="password2" type="password" class="form-control" placeholder="Retype password" required/>
          </div>
            <div class="form-group">
              <label>Jenis Akun</label>
              <select name="group" class="form-control" required>
              	<option value="">Please Select</option>
                <?php if ($_SESSION['id_group'] == '1') {
                  echo "<option value='1'>Super Admin</option>";
                  echo "<option value='2'>Admin</option>";
                }elseif ($_SESSION['id_group'] == '2') {
                  echo "<option value='2'>Admin</option>";
                }?>
              	<option value="3">Redaktur</option>
                <option value="4">Jurnalis</option>
                <option value="5">User</option>
              </select>
            </div>
            <div class="box-footer">
	          <button name="save" type="submit" class="btn btn-primary">Save</button>
	        </div>
          </div>
          </form>
        </div><!-- /.col-->
      </div><!-- ./row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include "templates/include/footer.php" ?>