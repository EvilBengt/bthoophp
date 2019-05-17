<?php

namespace Anax\View;

?>
<header>
    <h1><?= $title ?></h1>

    <nav>
        <a href="<?= url("mycms") ?>">Sidor</a>
        <a href="<?= url("mycms/blog") ?>">Blogg</a>
        <a href="<?= url("mycms/admin") ?>">Admin</a>
    </nav>
</header>
