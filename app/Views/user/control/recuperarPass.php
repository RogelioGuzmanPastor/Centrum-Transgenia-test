


<form class="login-form" action="<?= route_to('recuperar_pass_post') ?>" method="post">
  <h1>Recupera tu cuenta</h1>
  <div class="form-input-material">
    <input type="email" name="email" id="username" placeholder=" " autocomplete="off" class="form-control-material" required />
    <label for="username">Email</label>
  </div>

  <input type="hidden" name="google-response-token" id="google-response-token">
  <button type="submit" class="btn btn-primary btn-ghost">Solicitar Mail de Recuperacion</button>

</form>