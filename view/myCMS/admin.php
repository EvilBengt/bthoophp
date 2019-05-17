<?php

namespace Anax\View;

?>
<h2>Allt innehåll</h2>

<table class="my-table">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>ID</th>
            <th>Path</th>
            <th>Slug</th>
            <th>Typ</th>
            <th>Titel</th>
            <th>Filter</th>
            <th>Publicerat</th>
            <th>Skapat</th>
            <th>Uppdaterat</th>
            <th>Raderat</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row) : ?>
        <tr>
            <td>
                <a href="<?= url("mycms/delete/" . $row->id) ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
            <td>
                <a href="<?= url("mycms/update/" . $row->id) ?>">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td><?= $row->id ?></td>
            <td><?= $row->path ?></td>
            <td><?= $row->slug ?></td>
            <td><?= $row->type ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->filter ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->created ?></td>
            <td><?= $row->updated ?></td>
            <td><?= $row->deleted ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Skapa innehåll</h2>

<form action="<?= url("mycms/create") ?>" method="GET">
    <label>
        Titel:
        <input type="text" name="title">
    </label>
    <button type="submit">Fortsätt</button>
</form>
