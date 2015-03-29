<footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="#">Kemenpora</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="theme/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="theme/dist/js/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="theme/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="theme/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='theme/plugins/fastclick/fastclick.min.js'></script>

    <!-- DATA TABES SCRIPT -->
    <script src="theme/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="theme/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Datepiker -->
    <script src="theme/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CKEditor -->
    <script src="theme/plugins/ckeditor/ckeditor.js"></script>
    <!-- AdminLTE App -->
    <script src="theme/dist/js/app.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      <?php if (isset($results['insertjs'])) {
        echo $results['insertjs'];
      };?>
    </script>
  </body>
</html>