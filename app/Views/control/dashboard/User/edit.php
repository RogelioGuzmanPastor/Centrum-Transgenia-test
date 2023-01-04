
<!-- Header -->
		

		<!-- Main -->
		<?php if( ($typeUser == 'administrador' || $typeUser == 'editor') || $usuario->id_token == $id_token  ): ?>
			<!-- Main -->
		<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    		<section class="content-header p-1 p-lg-5">
						<header class="major">
							<h2>Edita la informacion de tu perfil</h2>
						</header>
						<p>Modifica la información pertinente</p>

                        <?php if($typeUser == 'administrador' || $typeUser == 'editor'){ ?>
							<a href="/user" class="btn btn-info">Ver la lista de usuarios</a>
							
						<?php } ?>
						
					</section>
					
					<?= view("control/dashboard/partials/_session"); ?>
				<!-- Two -->
					<section class="content p-1 p-lg-5">
                        
						<div class="row flex-column ">
							
						<?= view("control/dashboard/partials/_form-error"); ?>

						<form class="mx-auto text-center col-12 col-lg-6 " action="/user/update/<?= $usuario->id_token ?>" method="post" enctype="multipart/form-data">

							<?= view("control/dashboard/User/_form",['usuario' => $usuario, "edit" => true, "type" => $typeUser]);   ?>

						</form>

					</section>
			
			</div>
		<?php else: ?>
		
			<div id="main">

				<?= view('403/error403.php'); ?>
			</div>

		<?php endif; ?>