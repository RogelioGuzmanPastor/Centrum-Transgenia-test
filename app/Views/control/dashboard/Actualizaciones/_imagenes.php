
<?php if($imagen != ''): ?>

    <img class="img-fluid" src="<?= route_to('get_image','actualizaciones',$imagen) ?>" alt="">

<?php else:  ?>
    
    <img class="img-fluid" src="/img/logo.png" alt="">

<?php endif; ?>