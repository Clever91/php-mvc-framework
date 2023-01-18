<?php

use app\core\Application;

if (Application::$app->session->hasFlash("success")) { ?>
    <div class="alert alert-success">
        <?= Application::$app->session->getFlash("success") ?>
    </div>
<?php } ?>

<h1>Home</h1>
<h3><?= $name ?></h3>