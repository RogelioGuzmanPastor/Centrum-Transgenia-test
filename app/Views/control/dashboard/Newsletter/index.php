




<!-- Header -->
			
			
			<?php if( $typeUser == 'administrador' || $typeUser == 'editor' ): ?>
		<!-- Main -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    		<section class="content-header p-1 p-lg-5">

						<header class="major">
							<h2>¡Lista de usuarios registrados al Newsletter!</h2>
						</header>
						<p>Conoce los usuarios registrados al newsletter </p>

                        							
							
						
					</section>
					
					<?= view("control/dashboard/partials/_session"); ?>
				<!-- Two -->
					<section class="content p-1 p-lg-5">
                        <div class="usuarios row mx-auto ">
							<table class="table table-hover">
								<thead>									
									<tr>
										<th>Id</th>
										<th>Email</th>										
										<th>acciones</th>
									</tr>
								</thead>
								<tbody>
									
									<?php $t = 0; foreach($usuarios as $key => $u) : 
										$t++;
										?>
										<tr class="">
											<td style="max-width: 50px; vertical-align: middle;">
												<span ><?= $u->id; ?></span>
												
											</td>
											<td style="vertical-align: middle;">
												<span ><?= $u->email; ?></span>
											</td>
											
											<td style="vertical-align: middle;">											
													
													
													<form action="/newsletter/delete/<?= $u->id; ?>" method="post" class="px-0 mb-0">            
														<input type="submit" name="submit" value="Borrar" class="delete btn btn-danger" />
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