<!DOCTYPE html>
<html lang="es">
<head>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php if(isset($criticalcss)){echo $criticalcss;} ?>
    <?php if(isset($metas)){echo $metas;} ?>
    <title><?php if(isset($title)){echo $title;}else{echo "title";}; ?></title>    
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/controlAssets/css/all.min.css">

  <!-- Ionicons -->  
  <link rel="stylesheet" href="/controlAssets/css/ionicons/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/controlAssets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/controlAssets/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/controlAssets/css/adminlte.min.css">
  <link rel="stylesheet" href="/controlAssets/css/overlayScrollbars/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/controlAssets/css/admin.css">
  
  
   <!-- CSS recapcha -->
   <?php if(isset($recapcha)){echo $recapcha;}; ?>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?php if(isset($css)){ echo $css;}?>
</head>

<?= view("control/dashboard/templates/barra"); ?>
<?= view("control/dashboard/templates/navegacion"); ?>