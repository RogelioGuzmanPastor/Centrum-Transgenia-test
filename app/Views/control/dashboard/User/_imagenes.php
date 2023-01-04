
<?php if($imagen != ''): ?>

    <img class="img-fluid" src="<?= route_to('get_image','avatars',$imagen) ?>" alt="">

<?php else:  ?>
    
    <img class="img-fluid" src="/hola/test.jpg" alt="">

<?php endif; ?>