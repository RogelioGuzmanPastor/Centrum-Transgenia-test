<?php if(session('message')){ ?>
<div class="alert alert-danger  fade show" role="alert" style="text-transform: uppercase">
        <?= session('message') ?>        
    
</div>

<?php } ?>