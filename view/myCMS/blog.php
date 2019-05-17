<?php

namespace Anax\View;

?>

<ul>
<?php foreach ($posts as $post) : ?>
    <li>
        <a href="<?= url("mycms/blog/" . $post->link) ?>"><?= $post->title ?></a>
        <p>
            <?= $post->preview ?>
        </p>
    </li>
<?php endforeach; ?>
</ul>
