<?= view("dashboard/partials/_form-error"); ?>

<form action="create" method="post" enctype="multipart/form-data">

    <?= view("juegosfrecuentes/_form",['juego' => $level]);   ?>

</form>