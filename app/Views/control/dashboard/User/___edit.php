<?= view("dashboard/partials/_form-error"); ?>

<form action="/juegosfrecuentes/update/<?= $juego->id ?>" method="post" enctype="multipart/form-data">

    <?= view("juegosfrecuentes/_form",['juego' => $juego]);   ?>

</form>