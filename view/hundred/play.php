<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Gissa mitt tal</h1>
<form method="post">
    <input type="number" name="value" autofocus>
    <button type="submit" name="guess">Gissa</button>
    <button type="submit" name="restart">Börja om</button>
    <button type="submit" name="cheat">Fuska</button>
</form>
<p>
    <?= $result ?>
</p>
<p>
    <?= $triesLeft ?> gissningar kvar.
</p>
<p>
    <?= $cheat ?>
</p>
