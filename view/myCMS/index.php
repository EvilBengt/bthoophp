<?php

namespace Anax\View;

?>

<ul>
<?php foreach ($pages as $page) : ?>
    <li>
        <a href="<?= url("mycms/pages/" . $page->link) ?>"><?= $page->title ?></a>
    </li>
<?php endforeach; ?>
</ul>
