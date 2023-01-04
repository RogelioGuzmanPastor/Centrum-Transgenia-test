



    <?php if($edit){ ?>
        
        <input class="form-control mb-3" type="text" name="titulo" id="titulo"  placeholder="Titulo actualizacion"  value="<?= old('actualizacion', $actualizacion->titulo) ?>"/><br />        
        <textarea name="actualizacion" id="actualizacion" cols="5" rows="10" placeholder="Informacion sobre la actualizacion" class="form-control"><?= old('actualizacion', $actualizacion->actualizacion) ?></textarea>
        <input class="form-control" type="text" name="version" id="version"  placeholder="version"  value="<?= old('actualizacion', $actualizacion->version) ?>"/><br />                
        <select name="color" id="color" class="form-control mb-3 " required>
            <option ></option>
            <option  style="background:#28b800; color: #fff;" value="#28b800" <?php if($actualizacion->color == '#28b800'){ echo 'selected';};?>><span class="p-5">Implementacion nueva</span></option>
            <option  style="background:#E0CE00; " value="#E0CE00" <?php if($actualizacion->color == '#E0CE00'){ echo 'selected';};?>><span class="p-5">Correccion Bugs</span></option>
            <option  style="background:#E00000; color: #fff;" value="#E00000" <?php if($actualizacion->color == '#E00000'){ echo 'selected';};?>><span class="p-5">Modificacion de Funcionabilidad</span></option>
        </select>
        
    <?php } else { ?>
                
        <input class="form-control mb-3" type="text" name="titulo" id="titulo"  placeholder="Titulo actualizacion"  value=""/><br />        
        <textarea name="actualizacion" id="actualizacion" cols="5" rows="10" placeholder="Informacion sobre la actualizacion" class="form-control"></textarea>
        <input class="form-control" type="text" name="version" id="version"  placeholder="version"  value=""/><br />                
        <select name="color" id="color" class="form-control mb-3 " required>
            <option ></option>
            <option  style="background:#28b800; color: #fff;" value="#28b800" ><span class="p-5">Implementacion nueva</span></option>
            <option  style="background:#E0CE00; " value="#E0CE00" ><span class="p-5">Correccion Bugs</span></option>
            <option  style="background:#E00000; color: #fff;" value="#E00000" ><span class="p-5">Modificacion de Funcionabilidad</span></option>
        </select>
            
    <?php }?>

    <input type="hidden" name="google-response-token" id="google-response-token">
    <input type="submit" name="submit" value="Guardar" class="btn btn-success" />

