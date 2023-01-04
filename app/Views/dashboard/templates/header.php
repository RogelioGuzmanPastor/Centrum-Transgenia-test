<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, height=device-height, viewport-fit=cover">
    


    <?php if(isset($criticalcss)){echo $criticalcss;} ?>
    <?php if(isset($metas)){echo $metas;} ?>
    <title><?php if(isset($title)){echo $title;}else{echo "title";}; ?></title>    


    <meta name="robots" content="noindex">

    <meta name="googlebot" content="noindex">
    
    
    <!-- LOCAL: Font Awesome -->
    <!-- <link rel="stylesheet" href="/plugins/fontawesome/css/all.min.css" media="print" onload="this.media='all'" >     -->
    <!-- bootstrap -->        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'"/>

    <!-- CSS General -->
    <link rel="stylesheet" href="/css/masterpage/main.css" <?php if(isset($css_asinc_font_mastercss)){echo $css_asinc_font_mastercss;}; ?>>
    
    <!-- CSS recapcha -->
    <?php if(isset($recapcha)){echo $recapcha;}; ?>
    <!-- CSS Personalizado -->
    <?php if(isset($css)){echo $css;}; ?>    

</head>
<body>

<?= view("dashboard/templates/nav") ?>





