<?php

namespace Anax\View;

?>
<form method="get">
    <fieldset>
    <legend>Search</legend>
    <p>
        <label>Title (use % as wildcard):
            <input type="search" name="search" value="<?= htmlentities($search) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" value="Search">
    </p>
    <p><a href="all">Show all</a></p>
    </fieldset>
</form>
