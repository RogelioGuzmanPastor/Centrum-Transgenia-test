<form class="login-form"  action="<?= route_to('registro') ?>" method="POST">
  <h1>Registrate ahora</h1>
  <div class="form-input-material">
    <input type="text" name="nombre" id="nombre" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="nombre">Nombre Completo</label>
  </div>
  <div class="form-input-material">
    <input type="text" name="email" id="email" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="email">Correo</label>
  </div>
  <div class="form-input-material">
    <input type="text" name="username" id="username" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="username">Usuario</label>
  </div>
  <div class="form-input-material">
    <input type="password" name="password" id="password" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="password">contraseña</label>
  </div>
  <input type="hidden" name="google-response-token" id="google-response-token">
  <button type="submit" class="btn btn-primary btn-ghost">Registrarse</button>
</form>