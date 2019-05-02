<?php

namespace Anax\View;

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>100 (Controller-versionen)</h1>
<table class="table">
    <thead>
        <tr>
            <th>Du</th>
            <th>Datorn</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $playerScore ?></td>
            <td><?= $computerScore ?></td>
        </tr>
    </tbody>
</table>
