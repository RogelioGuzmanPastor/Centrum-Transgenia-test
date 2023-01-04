<?php if (! empty($errors)) : ?>
	<div class="errors col-12 col-lg-8 mx-auto mb-5" role="alert">
		
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php foreach ($errors as $error) : ?>
                

                    <strong><?= esc($error) ?></strong>
            <?php endforeach ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
	</div>
<?php endif ?>
