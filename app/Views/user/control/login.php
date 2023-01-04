

<form class="login-form" action="<?= route_to('user_login_post') ?>" method="post" >
  <h1>Login</h1>
  <div class="form-input-material">
    <input type="text" name="email" id="username" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="username">Username</label>
  </div>
  <div class="form-input-material">
    <input type="password" name="password" id="password" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="password">Password</label>
  </div>
  <input type="hidden" name="google-response-token" id="google-response-token">
  <button type="submit" class="btn btn-primary btn-ghost">Login</button>
  <a href="<?= route_to('recuperar_pass_get') ?>">¿Olvidaste tu contraseña?</a>
  <a href="<?= route_to('user_register_get') ?>">Registrate</a>
</form>