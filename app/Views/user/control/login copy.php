<div class="veen">
    <div class="login-btn splits">
        <p>¿Ya eres aguacate?</p>
        <button class="active">Iniciar Seccion</button>
    </div>
    <div class="rgstr-btn splits">
        <p>¿Aun no eres aguacate?</p>
        <button>Registrarse</button> <br>
        <p class="mt-3">¿No es lo que buscabas?</p>
        <a class="btn btn-outline-light redondeado" href="/">Ir al inicio</a>
    </div>
    
    <div class="wrapper">
        <form id="login" action="<?= route_to('user_login_post') ?>"tabindex="500" method="post">
            <?= view('user/control/_session'); ?>
            <h3>Iniciar Seccion</h3>
            <div class="mail">
                <input type="text" name="email">
                <label>Correo / Usuario</label>
            </div>
            <div class="passwd">
                <input type="password" name="password" class="passw">
                <label>Contraseña</label>
            </div>
            <div class="submit">
                <button class="dark">Acceder</button>
            </div>
            <div>
                <a href="/recuperar">¿Olvidaste tu contraseña?</a>
            </div>
            <input type="hidden" name="google-response-token" id="google-response-token">
        </form>
        <form id="register" class="login-orig" tabindex="502"  action="<?= route_to('registro') ?>" method="post">
            <h3>Registrarse</h3>
            <div class="name">
                <input type="text" name="nombre">
                <label>Nombre Completo</label>
            </div>
            <div class="mail">
                <input type="email" name="email">
                <label>Correo</label>
            </div>        
            <div class="uid">
                <input type="text" name="username">
                <label>Usuario</label>
            </div>
            <div class="passwd">
                <input type="password" name="password" class="passw passwregister">
                <label>contraseña</label>
            </div>
            <div class="submit">
                <button class="dark" id="registrarse">Registrarse</button>
            </div>
            <div class="">
                <button class="dark" id="validar-datos" style="background: #ff8b00; border-color: rgb(0, 0, 0);">validar datos</button>
            </div>
            <p class="info-confirmation">Completa los campos y has aparecer el boton de registrarse :) </p>
            <p class="passw-confirmation">La contraseña debe contener al menos 8 caracteres entre numeros, letras y simbolos</p>
            <input type="hidden" name="google-response-token2" id="google-response-token2">
        </form>
    </div>
</div>	
