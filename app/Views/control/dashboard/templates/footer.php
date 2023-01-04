<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b>  v 7.0.00
    </div>
    <strong>Copyright &copy; 2022 </strong> All rights
    reserved. <?= PROYECTNAME; ?>
  </footer>

</div>
<!-- ./wrapper -->
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>
<!-- jQuery -->
<script src="/controlAssets/js/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/controlAssets/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/controlAssets/js/jquery.dataTables.min.js"></script>
<script src="/controlAssets/js/dataTables.bootstrap4.min.js"></script>
<script src="/controlAssets/js/dataTables.responsive.min.js"></script>
<script src="/controlAssets/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/controlAssets/js/bs-custom-file-input.min.js"></script>
<script src="/controlAssets/js/adminlte.min.js"></script>
<script src="/controlAssets/js/overlayScrollbars/jquery.overlayScrollbars.min.js"></script>
<!-- sweet alert 2 -->
<script src="/controlAssets/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
<script src="/controlAssets/js/admin-ajax.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/controlAssets/js/demo.js"></script>

<!-- App table -->
<script src="/controlAssets/js/app.js"></script>
<script src="/controlAssets/js/login-ajax.js"></script>
<!-- Formulas Algoritmos -->

<script src="/controlAssets/js/GridViewScroll.js"></script>

<?php if(isset($script)){ echo $script;}?>
<?php if(isset($app)){echo $app;}; ?>
<?php if(isset($js)){echo $js;}; ?>
</body>

</html>