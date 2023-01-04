




<!-- Header -->
			
			
		<?php if( $typeUser == 'administrador' || $typeUser == 'moderador' || $typeUser == 'profesor' || $typeUser == 'usuario' ): ?>
		<!-- Main -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    		<section class="content-header p-1 p-lg-5">

						<header class="major">
							<h2>¡Conoce mas sobre las nuevas funcionabilidades!</h2>
						</header>						

						<?php if( $typeUser == 'administrador'): ?>
							<a href="/actualizaciones/new" class="btn btn-info">Agregar actualizacion</a>
						<?php endif; ?>
						
					</section>
					
					<?= view("control/dashboard/partials/_session"); ?>
				<!-- Two -->
					<section class="content p-1 p-lg-5">
                        <div class="usuarios row mx-auto ">
							
									
								<?php $t = 0; foreach($actualizaciones as $key => $u) : 
											?>
											<div class="contenedor-actualizacion" style="border-left: 4px solid <?= $u->color; ?>!important;">

											
												<div class="img-actualizacion" style="border: 2px solid <?= $u->color; ?>!important;">
													<?= view("Views/control/dashboard/Actualizaciones/_imagenes", ['imagen' => $u->imagen]); ?>
													<span style="border: 2px solid <?= $u->color; ?>!important;"><?= $u->nombre; ?></span>
												</div>
												<div class="fecha-actualizacion" style="background: <?= $u->color; ?>;">
													<?= substr($u->creado, 0, -3); ?>
												</div>
												<div class="titulo">
													<?= $u->titulo; ?>
												</div>
												<div class="version" style="border: 2px solid <?= $u->color; ?>!important;">
													<?= $u->version; ?>
												</div>
												<div class="actualizacion">
													<?= nl2br($u->actualizacion) ?>
												</div>
												
													
														
														<!-- <form action="/lista-materias/<?= $u->id; ?>" method="post" class="px-0 mb-0">            
															<input type="submit" name="submit" value="Permisos" class="delete btn btn-success" />
														</form> -->
													
															
												
											</div>
										<?php 
										
									endforeach; ?>

								
                        </div>
                                
                        

						
					    <div class="col-12 mt-3 text-center">
							<?= $pager->links() ?>
							
						</div>
					</section>

				
			</div>
			<?php else: ?>

			<div id="main">
			<?= view('403/error403.php'); ?>
				
			</div>

			<?php endif; ?>