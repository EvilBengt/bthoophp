<?php

namespace Anax\View;

?>

<h2>Skapa innehåll</h2>

<form method="POST" action="<?= url("mycms/create") ?>">
    <label class="block-label">
        Path:
        <input type="text" name="path">
    </label>
    <label class="block-label">
        Slug:
        <input type="text" name="slug" readonly value="<?= $slug ?>">
    </label>
    <label class="block-label">
        Titel:
        <input type="text" name="title" readonly value="<?= $title ?>">
    </label>
    <fieldset>
        <legend>Typ</legend>
        <label class="block-label">
            <input type="radio" name="type" value="page">
            Page
        </label>
        <label class="block-label">
            <input type="radio" name="type" value="post" checked>
            Post
        </label>
    </fieldset>
    <fieldset>
        <legend>Filter</legend>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="bbcode">
            BBCode
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="link">
            Länkar
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="markdown">
            Markdown
        </label>
        <label class="block-label">
            <input type="checkbox" name="filters[]" value="nl2br">
            nl2br
        </label>
    </fieldset>
    <label class="block-label">
        Innehåll:
        <textarea name="data" cols="30" rows="10"></textarea>
    </label>
    <button type="submit">Skapa</button>
</form>
