<?php

namespace Anax\View;

?>

<h2>Radera</h2>

<table class="my-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Path</th>
            <th>Slug</th>
            <th>Typ</th>
            <th>Titel</th>
            <th>Publicerat</th>
            <th>Skapat</th>
            <th>Uppdaterat</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->path ?></td>
            <td><?= $row->slug ?></td>
            <td><?= $row->type ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->created ?></td>
            <td><?= $row->updated ?></td>
        </tr>
    </tbody>
</table>

<form method="POST" action="<?= url("mycms/delete") ?>">
    <input type="hidden" name="id" value="<?= $row->id ?>">
    <button type="submit">Radera</button>
</form>
