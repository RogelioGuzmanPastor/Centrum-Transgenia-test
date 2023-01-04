<!-- Footer -->
<footer id="footer" class="container-fluid">
    
    <!-- <ul class="copyright">
        <li>Design to: funda tu sitio weeb</li>
    </ul> -->
    
    <div class="copyright mx-auto text-center">
        <?php if(isset($iniciado)){ ?>
            <?php if($iniciado):?>
                <a class="btn btn-outline-secondary" href="/logout">Cerrar Sesión</a>
            <?php else: ?>
                <a class="btn btn-outline-secondary" href="/login">Iniciar Sesión / Registrarse</a>                
            <?php endif; ?>
        <?php } ?>
    </div>
</footer>

</main>

<!-- CDN: JQuery -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->



<!-- <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script> 
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/pouchdb@7.2.1/dist/pouchdb.min.js"></script> -->

<!-- <script src="/js/libs/plugins/mdtoast.min.js"></script>-->
<script src="/js/app.js?n=1"></script> 


<?php if(isset($app)){echo $app;}; ?>
<?php if(isset($js)){echo $js;}; ?>
</body>
</html>