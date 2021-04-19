  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <strong>Version</strong> <?= SITE_VERSION;?>
    </div>
    <!-- Default to the left -->
    <?= '<strong>'.get_sitename().'</strong> '.date('Y').' &copy; Todos los derechos reservados.'; ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->  
  
<!-- inc_footer.php -->
<?php require_once INCLUDES.'inc_scripts.php'; ?>

</body>
</html>