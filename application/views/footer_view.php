
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="http://www.djpbn.kemenkeu.go.id/kanwil/kalbar/id/">Kanwil DJPb Prov. Kalbar</a>.</strong> &nbsp; All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src=<?= base_url("bower_components/jquery/dist/jquery.min.js");?>></script>
<!-- Bootstrap 3.3.7 -->
<script src=<?= base_url("bower_components/bootstrap/dist/js/bootstrap.min.js");?>></script>
<!-- Select2 -->
<script src=<?= base_url("bower_components/select2/dist/js/select2.full.min.js");?>></script>
<!-- DataTables -->
<!--<script src=<?= base_url("bower_components/datatables.net/js/jquery.dataTables.min.js");?>></script> -->
<!-- <script src=<?= base_url("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js");?>></script> -->
<!-- Slimscroll -->
<script src=<?= base_url("bower_components/jquery-slimscroll/jquery.slimscroll.min.js");?>></script>
<!-- FastClick -->
<script src=<?= base_url("bower_components/fastclick/lib/fastclick.js");?>></script>
<!-- Bootstrap Notify -->
<script src=<?= base_url("bower_components/bootstrap-notify/bootstrap-notify.min.js");?>></script>
<!-- Bootstrap Validator -->
<script src=<?= base_url("bower_components/bootstrap-validator/bootstrapValidator.min.js");?>></script>
<!-- AdminLTE App -->
<script src=<?= base_url("dist/js/adminlte.min.js");?>></script>
<!-- iCheck -->
<script src=<?= base_url("plugins/iCheck/icheck.min.js");?>></script>

<script src="<?= base_url(); ?>bower_components/datatables.net/1.10.13/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables.net-bs/jquery.dataTables.bootstrap.min.js"></script> <!-- Somehow we still need this -->
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.print.min.js"></script>
<!-- <script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.colVis.min.js"></script> -->
<script src="<?= base_url(); ?>bower_components/jszip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url(); ?>bower_components/pdfmake-0.1.18/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>bower_components/pdfmake-0.1.18/vfs_fonts.js"></script>

<script type="text/javascript">

var notify_success = {
  // settings
  element: ".content-header",
  type: "success",
  allow_dismiss: false,
  placement: {
    from: "top",
    align: "right"
  },
  delay: 3000,
  animate: {
    enter: 'animated fadeInRight',
    exit: 'animated fadeOutRight'
  },
  template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
      '<span data-notify="title"><h4><i class="icon fa fa-check"></i>{1}</h4></span>' +
      '<span data-notify="message">{2}</span>' +
    '</div>'
};
var notify_danger = {
  // settings
  type: "danger",
  allow_dismiss: false,
  placement: {
    from: "bottom",
    align: "right"
  },
  delay: 3000,
  animate: {
    enter: 'animated fadeInRight',
    exit: 'animated fadeOutRight'
  },
  template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
      '<span data-notify="title"><h4><i class="icon fa fa-ban"></i>{1}</h4></span>' +
      '<span data-notify="message">{2}</span>' +
    '</div>'
};
</script>
