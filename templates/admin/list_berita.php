<?php include "templates/include/header.php" ?>

<div class="content-wrapper">
    <section class="content-header">
          <h1>
            List Berita
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Berita</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <a href="admin.php?action=input_news"><button class="btn btn-success">Add New</button></a>
                  </div>
                  <?php if ( isset( $results['message'] ) ) { ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                      <?php echo $results['message'] ?>
                    </div>
                 <?php } ?>
                 <!-- <div class="message">tes</div> -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; 
                          $status = array('0' => 'Not Publish',
                                          '1' => 'Published', ); 
                      for ($i=0; $i < $results['total']; $i++) { ?>
                      <tr>
                        <td><?php echo $no;$no++;?></td>
                        <td><?php echo $results['berita'][$i]->judul?></td>
                        <td><?php echo $results['kategori'][$results['berita'][$i]->id_kategori];?></td>
                        <td><?php echo $status[$results['berita'][$i]->status];?></td>
                        <td><?php echo $results['berita'][$i]->username;?></td>
                        <td><?php echo "<a href='admin.php?action=publish&id=".$results['berita'][$i]->id."'><button class='btn btn-primary'>Publish</button></a>"; echo "&nbsp";
                                  echo "<a href='admin.php?action=edit_news&id=".$results['berita'][$i]->id."'><button class='btn btn-warning'>Edit</button></a>"; echo "&nbsp";
                                  echo "<a href='admin.php?action=delete_news&id=".$results['berita'][$i]->id."'><button class='btn btn-danger'>Delete</button></a>";
                              ?></td>
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