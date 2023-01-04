<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, height=device-height, viewport-fit=cover">
    


    <?php if(isset($criticalcss)){echo $criticalcss;} ?>
    <?php if(isset($metas)){echo $metas;} ?>
    <title><?php if(isset($title)){echo $title;}else{echo "title";}; ?></title>    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-DF76EYKMNR"></script> -->
    <!-- <script async src="https://www.googleoptimize.com/optimize.js?id=OPT-P8FG7VR"></script> -->
    <script>
    // window.dataLayer = window.dataLayer || [];
    // function gtag(){dataLayer.push(arguments);}
    // gtag('js', new Date());

    // gtag('config', 'G-DF76EYKMNR');
    </script>

    <!-- <meta name="robots" content="noindex">

    <meta name="googlebot" content="noindex"> -->
    
    
    <!-- LOCAL: Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome/css/all.min.css" media="print" onload="this.media='all'" >    
    <!-- LOCAL: bootstrap -->    
    <!-- <link rel="stylesheet" href="/plugins/bootstrap/bstplite.min.css" media="print" onload="this.media='all'">     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'"/>

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

    <!-- CSS General -->
    <link rel="stylesheet" href="/css/masterpage/main.min.css" <?php if(isset($css_asinc_font_mastercss)){echo $css_asinc_font_mastercss;}; ?>>
    
    <!-- CSS recapcha -->
    <?php if(isset($recapcha)){echo $recapcha;}; ?>
    <!-- CSS Personalizado -->
    <?php if(isset($css)){echo $css;}; ?>    
</head>
<body>

<?= view("dashboard/templates/nav") ?>





