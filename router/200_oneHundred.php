<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game
 */
$app->router->get("onehundred/init", function () use ($app) {
    $_SESSION["onehundred"] = new EVB\OneHundred\Game(
        new EVB\OneHundred\NormalPlayer(
            new EVB\OneHundred\NormalDiceHand(
                2,
                new EVB\OneHundred\NormalDiceFactory()
            )
        ),
        new EVB\OneHundred\NormalPlayer(
            new EVB\OneHundred\NormalDiceHand(
                2,
                new EVB\OneHundred\NormalDiceFactory()
            )
        ),
        5
    );

    $app->page->add("oneHundred/init");

    return $app->page->render([
        "title" => "Starta spelet"
    ]);
});



/**
 * Player's turn
 */
$app->router->get("onehundred/roll", function () use ($app) {
    $game = $_SESSION["onehundred"];

    if ($game->getWinner()) {
        return $app->response->redirect("onehundred/game-over");
    }

    $game->rollPlayer();

    if ($game->playerRolledOnes()) {
        return $app->response->redirect("onehundred/roll-results-stop");
    } else {
        return $app->response->redirect("onehundred/roll-results");
    }
});



/**
 * Player's turn - show results - ok
 */
$app->router->get("onehundred/roll-results", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["onehundred"];

    $scores = [
        "playerScore" => $game->getPlayerTotalScore(),
        "computerScore" => $game->getComputerTotalScore()
    ];

    $app->page->add("onehundred/scores", $scores);
    $app->page->add("onehundred/roll", ["roll" => $game->getLastRoll()]);
    $app->page->add("onehundred/rollOk", ["sum" => $game->getPlayerTempScore()]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Player's turn - show results - stop
 */
$app->router->get("onehundred/roll-results-stop", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["onehundred"];

    $scores = [
        "playerScore" => $game->getPlayerTotalScore(),
        "computerScore" => $game->getComputerTotalScore()
    ];

    $app->page->add("onehundred/scores", $scores);
    $app->page->add("onehundred/roll", ["roll" => $game->getLastRoll()]);
    $app->page->add("onehundred/rollOver");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Player's turn - save
 */
$app->router->get("onehundred/save", function () use ($app) {
    $game = $_SESSION["onehundred"];

    $game->savePlayer();

    if ($game->getWinner()) {
        return $app->response->redirect("onehundred/game-over");
    }

    $app->response->redirect("onehundred/computer");
});



/**
 * Computer's turn
 */
$app->router->get("onehundred/computer", function () use ($app) {
    $game = $_SESSION["onehundred"];

    $game->playComputer();

    $app->response->redirect("onehundred/computer-results");
});



/**
 * Computer's turn - show results
 */
$app->router->get("onehundred/computer-results", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["onehundred"];

    $scores = [
        "playerScore" => $game->getPlayerTotalScore(),
        "computerScore" => $game->getComputerTotalScore()
    ];

    $app->page->add("onehundred/scores", $scores);
    $app->page->add("onehundred/computerResults", ["results" => $game->getComputerResults()]);

    return $app->page->render([
        "title" => $title
    ]);
});



/**
 * Game over - show winner
 */
$app->router->get("onehundred/game-over", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["onehundred"];

    $scores = [
        "playerScore" => $game->getPlayerTotalScore(),
        "computerScore" => $game->getComputerTotalScore()
    ];

    $app->page->add("onehundred/scores", $scores);
    $app->page->add("onehundred/gameOver", ["winner" => $game->getWinner()]);

    return $app->page->render([
        "title" => $title
    ]);
});
