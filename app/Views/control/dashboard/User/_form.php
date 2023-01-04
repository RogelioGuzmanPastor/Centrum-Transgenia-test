



    <?php if($edit){ ?>
        <div class="col-12 px-0 my-4">

            <?= view("Views/control/dashboard/User/_imagenes", ['imagen' => $usuario->imagen]); ?>
        </div>
            
        <input class="form-control" disabled="disabled" type="text" name="username" id="username"  placeholder="username"  value="<?= old('usuario', $usuario->username) ?>"/><br />        

        <input class="form-control" disabled="disabled" type="text" name="email" id="email"  placeholder="email"  value="<?= old('email', $usuario->email) ?>"/><br />

        <input class="form-control" type="text" name="nombre" id="nombre"  placeholder="Nombre Completo"  value="<?= old('user', $usuario->nombre) ?>"/><br />

        <input class="form-control" type="password" name="password" id="password"  placeholder="Cambiar contraseña"  value=""/><br />
        
        <?php if($type == 'administrador' ){?>
            <select name="type" id="type" class="form-control mb-4">
                <option <?php if($usuario->type == 'administrador'): echo 'selected'; endif; ?> value="administrador">Administrador</option>
                <option <?php if($usuario->type == 'editor'): echo 'selected'; endif; ?> value="editor">Editor</option>                
                <option <?php if($usuario->type == 'usuario'): echo 'selected'; endif; ?> value="usuario">Usuario</option>
            </select>
            
        <?php } else if($typeUser == 'editor' && $usuario->type != 'administrador') { ?>

            <select name="type" id="type" class="form-control mb-4">                
                <option <?php if($usuario->type == 'editor'): echo 'selected'; endif; ?> value="editor">Editor</option>                
                <option <?php if($usuario->type == 'usuario'): echo 'selected'; endif; ?> value="usuario">Usuario</option>
            </select>
        <?php } ?>

        <div class="custom-file mb-4">
            <input type="file" name="imagen" id="customFileLang" class="custom-file-input mb-3" lang="es"/>        
            <label class="custom-file-label" for="customFileLang">Cambiar la imagen de perfil</label>
        </div>
        
    <?php } else { ?>
        
        
        
        <input class="form-control" type="text" name="username" id="username"  placeholder="username"  value=""/><br />
        
        <input class="form-control" type="text" name="email" id="email"  placeholder="email"  value="<?= old('email', $usuario->email) ?>"/><br />
        
        <input class="form-control" type="text" name="nombre" id="nombre"  placeholder="Nombre Completo"  value="<?= old('nombre', $usuario->nombre) ?>"/><br />
        
        <input class="form-control" type="password" name="password" id="password"  placeholder="Definir contraseña"  value=""/><br />
        <?php if($type == 'administrador'){?>
            <select name="type" id="type" class="form-control mb-4">
                <option  value="administrador">Administrador</option>
                <option  value="editor">Editor</option>                
                <option  value="usuario" selected>Usuario</option>
            </select>

        <?php } else if($typeUser == 'editor') { ?>

        <select name="type" id="type" class="form-control mb-4">
            
            <option value="editor">Editor</option>            
            <option value="usuario" selected>Usuario</option>
        </select>
        <?php } ?>

            
    <?php }?>

    <input type="hidden" name="google-response-token" id="google-response-token">
    <input type="submit" name="submit" value="Guardar" class="btn btn-success" />

