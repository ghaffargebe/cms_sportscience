<?php include "templates/include/header.php" ?>

<div class="content-wrapper">
    <section class="content-header">
          <h1>
            List User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <a href="admin.php?action=add_user"><button class="btn btn-success">Add New</button></a>
                  </div>
                  <?php if ( isset( $results['message'] ) ) { ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                      <?php echo $results['message'] ?>
                    </div>
                 <?php } ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jenis Akun</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; 
                          $status = array('0' => 'Inactive',
                                          '1' => 'Active', ); 
                      for ($i=0; $i < $results['total']; $i++) { ?>
                      <tr>
                        <td><?php echo $no;$no++;?></td>
                        <td><?php echo $results['results'][$i]->nama;?></td>
                        <td><?php echo $results['results'][$i]->username;?></td>
                        <td><?php echo $results['group'][$results['results'][$i]->id_group];?></td>
                        <td><?php echo $status[$results['results'][$i]->status];?></td>
                        <td>
                        <?php 
                        if ($results['results'][$i]->id_group == '1' && $_SESSION['id_group'] != '1') {
                           if ($results['results'][$i]->status == "0") {
                             echo "<button class='btn bg-purple' disabled>Active</button>";
                           }else{
                             echo "<button class='btn btn-warning' disabled>Inactive</button>";
                           }
                           echo "&nbsp;&nbsp;";echo "<button class='btn btn-danger' disabled>Delete</button>";
                        }else{
                          if ($results['results'][$i]->status == "0") {
                            echo "<a href='admin.php?action=activate_user&id=".$results['results'][$i]->id."'><button class='btn bg-purple'>Active</button></a>";
                          } else{
                            echo "<a href='admin.php?action=deactivate_user&id=".$results['results'][$i]->id."'><button class='btn btn-warning'>Inactive</button></a>";
                          }
                          echo "&nbsp;&nbsp;";
                          if ($results['results'][$i]->id_group == '1') {
                            if ($_SESSION['id_group'] == '1') {
                              echo "<a href='admin.php?action=delete_user&id=".$results['results'][$i]->id."'><button class='btn btn-danger'>Delete</button></a>";
                            }
                          } else{
                            echo "<a href='admin.php?action=delete_user&id=".$results['results'][$i]->id."'><button class='btn btn-danger'>Delete</button></a>";
                          }
                        }
                        ?>
                        </td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include "templates/include/footer.php" ?>