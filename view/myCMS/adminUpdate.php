<?php

namespace Anax\View;

?>

<h2>Redigera innehåll</h2>

<form method="POST" action="<?= url("mycms/update") ?>">
    <input type="hidden" name="id" value="<?= $row->id ?>">
    <label class="block-label">
        Path:
        <input type="text" name="path" value ="<?= $row->path ?>">
    </label>
    <label class="block-label">
        Slug:
        <input type="text" name="slug" readonly value="<?= $row->slug ?>">
    </label>
    <label class="block-label">
        Titel:
        <input type="text" name="title" value="<?= $row->title ?>">
    </label>
    <fieldset>
        <legend>Typ</legend>
        <label class="block-label">
            <input type="radio" name="type" value="page" <?= $row->type == "page" ? "checked" : "" ?>>
            Page
        </label>
        <label class="block-label">
            <input type="radio" name="type" value="post" <?= $row->type == "post" ? "checked" : "" ?>>
            Post
        </label>
    </fieldset>
    <fieldset>
        <legend>Filter</legend>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="bbcode" <?= \in_array("bbcode", $row->filter) ? "checked" : "" ?>>
            BBCode
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="link" <?= \in_array("link", $row->filter) ? "checked" : "" ?>>
            Länkar
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="markdown" <?= \in_array("markdown", $row->filter) ? "checked" : "" ?>>
            Markdown
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="nl2br" <?= \in_array("nl2br", $row->filter) ? "checked" : "" ?>>
            nl2br
        </label>
    </fieldset>
    <label class="block-label">
        Innehåll:
        <textarea name="data" cols="30" rows="10"><?= $row->data ?></textarea>
    </label>
    <label class="block-label">
        Publicerat:
        <input type="datetime-local" placeholder="åååå-mm-ddThh:mm" name="published" value="<?= $row->published ?>">
    </label>
    <button type="submit">Spara ändringar</button>
</form>
