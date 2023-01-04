<?php if(session('message')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: uppercase">
        <?= session('message') ?>        
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php } ?>