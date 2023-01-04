
<!-- Header -->
		

		<!-- Main -->
		<?php if( $typeUser == 'administrador' || $typeUser == 'moderador'  ): ?>
			<!-- Main -->
		<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    		<section class="content-header p-1 p-lg-5">
						<header class="major">
							<h2>Edita la informacion de la actualizacion</h2>
						</header>
						

                        <?php if($typeUser == 'administrador'){ ?>
							<a href="/actualizaciones" class="btn btn-info">Ver actualizaciones</a>
							
						<?php } ?>
						
					</section>
					
					<?= view("control/dashboard/partials/_session"); ?>
				<!-- Two -->
					<section class="content p-1 p-lg-5">
                        
						<div class="row flex-column ">
							
						<?= view("control/dashboard/partials/_form-error"); ?>

						<form class="mx-auto text-center col-12 col-lg-6 " action="/actualizaciones/update/<?= $actualizacion->id ?>" method="post" enctype="multipart/form-data">

							<?= view("control/dashboard/Actualizaciones/_form",['actualizacion' => $actualizacion, "edit" => true, "type" => $typeUser]);   ?>

						</form>

					</section>
			
			</div>
		<?php else: ?>
		
			<div id="main">

				<?= view('403/error403.php'); ?>
			</div>

		<?php endif; ?>