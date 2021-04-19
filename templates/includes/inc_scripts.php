<!-- jQuery -->
<script src="<?php echo PLUGINS.'jquery/jquery.min.js'; ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo PLUGINS.'jquery-ui/jquery-ui.min.js'; ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo PLUGINS.'bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo PLUGINS;?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo PLUGINS;?>jszip/jszip.min.js"></script>
<script src="<?php echo PLUGINS;?>pdfmake/pdfmake.min.js"></script>
<script src="<?php echo PLUGINS;?>pdfmake/vfs_fonts.js"></script>
<script src="<?php echo PLUGINS;?>datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo PLUGINS;?>datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="<?php echo PLUGINS;?>select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo PLUGINS.'bs-custom-file-input/bs-custom-file-input.min.js'; ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo PLUGINS.'overlayScrollbars/js/jquery.overlayScrollbars.min.js'; ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo JS.'adminlte.min.js'; ?>"></script>
<!-- toastr js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- waitme js -->
<script src="<?php echo PLUGINS.'waitme/waitMe.min.js'; ?>"></script>
<!-- Summernote js -->
<script src="<?php echo PLUGINS.'summernote/summernote.min.js'; ?>"></script>
<!-- Lightbox js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo PLUGINS;?>sweetalert2/sweetalert2.min.js"></script>

<!-- Objeto Bee Javascript registrado -->
<?php echo load_bee_obj(); ?>

<!-- Scripts registrados manualmente -->
<?php echo load_scripts(); ?>

<!-- Scripts personalizados Bee Framework -->
<script src="<?php echo JS.'functions.js?v='.get_version(); ?>"></script>

<!-- Scripts personalizados Bee Framework -->
<script src="<?php echo JS.'main.js?v='.get_version(); ?>"></script>

<!-- Scripts archivo de funciones por cada página -->
<?php  
    if(isset($d->functions) && $d->functions != null):
?>
    <script src="<?php echo JS.$d->functions.'?v='.get_version(); ?>"></script>
<?php 
    endif
?>