
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-5 " style="background: transparent;">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link d-flex  align-items-center" style="border-radius: 0px;background: #424242;box-shadow: inset -17px -17px 34px #303030, inset 17px 17px 34px #545454;">

      <img src="/img/logo.png"
           alt="Tu Logo"
           class=" ml-2 elevation-1"
           style=" max-height: 30px; " 
           >
      <h6 class="m-0 pl-2"><b><?= PROYECTNAME ?></b></h6>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: linear-gradient(135deg, rgba(0,0,0,0.85) , #4d4d4d)">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex row justify-content-center text-center">
        <div class="image col-12 ">
          <div class="img-circle elevation-2 d-flex align-items-center justify-content-center cuadro_eterno cuadro-88 mx-auto" style="background: transparent;">
            <?php  if ($imagen != ""): ?>
              <img src="<?= route_to('get_image','avatars',$imagen) ?>" alt="User Image">
              <!-- <img src="<?= $imagen ?>" alt="User Image"> -->
            <?php else: ?>
              <img src="/img/logo.png">
              <?php endif; ?>
            </div>
          </div>
          <div class="info col-12">
            <a href="#" class="d-block">Bienvenido: </a><br>          
        
        </div>
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
        //    if(revisar('grado') == 'Administrador' || revisar('grado') == 'Editor' || revisar('grado') == 'Servicio' ): 
           ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/control" class="nav-link ml-3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inicio</p>
                </a>
              </li>
            </ul>
          </li>
          <?php 
        // endif; 
        // 
        ?>

         
          <?php
          //  if(revisar('grado') == 'Editor' || revisar('grado') == 'Administrador'  || revisar('grado') == 'Usuario' ): 
              // if(revisar('sup') != '9'){
            ?>
            <!-- <li class="nav-header">ATENCION AL CLIENTE </li>
            
            <li class="nav-item">
              <a href="/control/servicios/crear-solicitud.php" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>Dudas  </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/control/servicios/crear-comentarios.php" class="nav-link">                
                <i class="far fa-comment-dots nav-icon"></i>
                <p>Dejamos tu Testimonio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/control/servicios/crear-reportes.php" class="nav-link">
                <i class="fas fa-exclamation-circle nav-icon"></i>
                <p>Resportes </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/control/servicios/FAQ.php" class="nav-link">
                <i class="fas fa-exclamation-circle nav-icon"></i>
                <p>FAQ</p>
              </a>
            </li> -->
            <?php 
          // }   
          ?>

            
            <?php 
          //  endif; 
           ?>
           
              <!-- <?php 
              // if(revisar('grado') == 'Administrador'): 
              ?>
                
                <li class="nav-item">
                  <a href="/control/servicios/dudas.php" class="nav-link ">
                    <i class="far fa-question-circle nav-icon"></i>
                    <p>Contestar Dudas</p>
                  </a>
                </li>
              
              <?php 
            //  endif;
              ?> 
              -->
         
          
          <li class="nav-header">Datos</li>
         
          <li class="nav-item">
             
            <a href="/control/newsletter" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
               Registros newsletter 
              </p>
            </a>
          </li>
          <li class="nav-item">
             
            <a href="/control/datos" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
               Registros datos
              </p>
            </a>
          </li>
          <li class="nav-header">CONFIGURACION</li>
         
          <li class="nav-item">
             
            <a href="/user/<?= $id_token ?>/edit" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
               Perfil 
              </p>
            </a>
          </li>
        

          
          
          <!-- <li class="nav-item ">
            <a href="/control/admins/claves.php" class="nav-link">
              
              <i class="nav-icon fas fa-key"></i>
              <p>Claves</p>
            </a>
          </li> -->
          <?php if( $typeUser == 'administrador'  || $typeUser == 'editor' ): ?>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Administradores
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-3">
                <a href="/user" class="nav-link">
                  <i class="fas fa-user-cog"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item ml-3">
                <a href="/user/new" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Agregar</p>
                </a>
              </li>
              
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-header">NOTAS</li>
         
         <li class="nav-item">
            
           <a href="/actualizaciones" class="nav-link">
             <i class="nav-icon far fa-clipboard"></i>
             <p>
              Actualizaciones 
             </p>
           </a>
         </li>
          
          <li><br><br><br></li>
          <?php 
        // endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>