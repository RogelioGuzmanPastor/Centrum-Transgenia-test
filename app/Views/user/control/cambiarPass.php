<?= view('user/control/_session'); ?>
<form class="login-form" class="validar-pass-igual"  action="<?= route_to('cambiar_pass_post') ?>" method="post" >
  <h1>Actualiza tu contraseña</h1>
  <div class="form-input-material">
    <input type="password" name="password" id="password" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="password">Contraseña</label>
  </div>
  <div class="form-input-material">
    <input type="password" name="password_confirmed" id="password_confirmed" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="password_confirmed">Confirmar Contraseña</label>
  </div>
  <input type="hidden" name="email" value="<?= $correo?> "/>
  <input type="hidden" name="token" value="<?= $token?> "/>
  <input type="hidden" name="google-response-token" id="google-response-token">

  <button type="submit" class="btn btn-primary btn-ghost">Actualizar mi contraseña</button>

</form>