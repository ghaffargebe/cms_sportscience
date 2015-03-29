<?php include "templates/include/header.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Insert New News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">News</a></li>
        <li class="active">Insert New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class='row'>
        <div class='col-md-12'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Memasukkan Berita Baru</h3>
            </div><!-- /.box-header -->
            <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_berita" value="<?php echo $results['berita']->id ?>"/>
            <div class='box-body pad'>
            <?php if ( isset( $results['message'] ) ) { ?>
			        <div class="message"><?php echo $results['message'] ?></div>
			     <?php } ?>
            <div class="form-group">
              <label>Judul Berita</label>
              <input name="judul" type="text" class="form-control" id="NewsTitle" placeholder="Enter News Title" required value="<?php echo $results['berita']->judul;?>">
            </div>
            <div class="form-group">
              <label>Tanggal Berita</label>
              <input name="tanggal" id="datepicker1" class="form-control datepicker" data-provide="datepicker" placeholder="dd/mm/yyyy" required value="<?php echo $results['tanggal'];?>">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="id_kategori" class="form-control" required>
              	<option value="">Please Select</option>
                <?php for ($i=1; $i <= count($results['kategori']); $i++) { 
                  if ($i == $results['berita']->id_kategori) { ?>
                    <option value='<?php echo $i; ?>' selected ><?php echo $results['kategori'][$i];?></option>";
                 <?php }else{ ?>
                    <option value='<?php echo $i; ?>' ><?php echo $results['kategori'][$i];?></option>";
                 <?php }
                }?>
              </select>
            </div>
            <div class="form-group">
              <label>Upload Gambar<small> (JPG, JPEG, PNG, max. 2MB)</small></label>
              <input id="gambar" name="gambar" type="file">
              <?php if ($results['berita']->gambar != "") { ?>
              <img width="30%" height="30%" src="<?php echo UPLOAD_PATH.$results['berita']->gambar;?>">
              <?php }?>
            </div>
            <div class="form-group">
              <label>Isi Berita</label>
              <textarea id="text" name="isi" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>
                <?php echo $results['berita']->isi;?>
              </textarea>
            </div>
            </div>
            <div class="box-footer">
	          <button name="save" type="submit" class="btn btn-primary">Save</button> &nbsp;&nbsp;&nbsp;
	          <?php if ($_SESSION['id_group'] == "1" || $_SESSION['id_group'] == "2"  ||  $_SESSION['id_group'] == "3") { ?>
            <input type="hidden" name="save_publish" value="true" >
	          <button name="save_publish" type="submit" class="btn btn-warning">Publish</button>
	         <?php }?>
	        </div>
            </form>
          </div>
        </div><!-- /.col-->
      </div><!-- ./row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include "templates/include/footer.php" ?>