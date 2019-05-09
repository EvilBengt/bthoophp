<?php

namespace Anax\View;

?>
<form method="post">
    <fieldset>
    <legend>Create</legend>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
    <p>
        <a href="all">Show all</a>
    </p>
    </fieldset>
</form>
