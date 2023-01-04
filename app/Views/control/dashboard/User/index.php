




<!-- Header -->
			
			
			<?php if( $typeUser == 'administrador' || $typeUser == 'editor' ): ?>
		<!-- Main -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    		<section class="content-header p-1 p-lg-5">

						<header class="major">
							<h2>¡Lista de usuarios!</h2>
						</header>
						<p>Conoce los usuarios registrados, y edita sus atributos </p>

                        
							<a href="/user/new" class="btn btn-info">Agregar un nuevo usuario</a>
							
						
					</section>
					
					<?= view("control/dashboard/partials/_session"); ?>
				<!-- Two -->
					<section class="content p-1 p-lg-5">
                        <div class="usuarios row mx-auto ">
							<table class="table table-hover">
								<thead>									
									<tr>
										<th>Avatar</th>
										<th>Usuario</th>
										<th>Nombre</th>
										<th>Correo</th>
										<th>Tipo</th>
										<th>acciones</th>
									</tr>
								</thead>
								<tbody>
									
									<?php $t = 0; foreach($usuarios as $key => $u) : 
										$t++;
										?>
										<tr class="">
											<td style="max-width: 50px; vertical-align: middle;">
												<?= view("Views/control/dashboard/User/_imagenes", ['imagen' => $u->imagen]); ?>
											</td>
											<td style="vertical-align: middle;">
												<span ><?= $u->username; ?></span>
											</td>
											<td style="vertical-align: middle;">
												<span ><?= $u->nombre; ?></span>
											</td>
											<td style="vertical-align: middle;">
												<span ><?= $u->email; ?></span>
											</td>
											<td style="vertical-align: middle;">
											<span ><?= $u->type; ?></span>
											</td>
											<td style="vertical-align: middle;">											
													
													<a href="/user/<?= $u->id_token; ?>/edit" class="button btn btn-teme mb-2">Editar</a>
													<form action="/user/delete/<?= $u->id_token; ?>" method="post" class="px-0 mb-0">            
														<input type="submit" name="submit" value="Borrar" class="delete btn" />
													</form>
											</td>
										</tr>
										
									<?php endforeach; ?>

								</tbody>
							</table>
                        </div>
                                
                        

                        <?= $pager->links() ?>

					    <div class="col-12 mt-3 text-center">
							<p><b>Usuarios:</b> <?= $t; ?></p>
						</div>
					</section>

				
			</div>
			<?php else: ?>

			<div id="main">
			<?= view('403/error403.php'); ?>
				
			</div>

			<?php endif; ?>