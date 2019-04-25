<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["guess"] = new EVB\Guess\Guess();
    $_SESSION["result"] = "";
    $_SESSION["cheat"] = "";
    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $game = $_SESSION["guess"] ?? null;
    if (!$game) {
        return $app->response->redirect("guess/init");
    }

    $title = "Play the game";

    $result = "";

    $data = [
        "result" => $_SESSION["result"] ?? "",
        "triesLeft" => $game->getTries(),
        "cheat" => $_SESSION["cheat"] ?? ""
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - POST
 */
$app->router->post("guess/play", function () use ($app) {
    $game = $_SESSION["guess"] ?? null;
    if (!$game || isset($_POST["restart"])) {
        return $app->response->redirect("guess/init");
    }

    $result = "";

    if (isset($_POST["guess"]) && isset($_POST["value"])) {
        try {
            $_SESSION["result"] = $game->makeGuess($_POST["value"]);
        } catch (EVB\Guess\GuessException $e) {
            $_SESSION["result"] = "Något gick fel: " . $e->getMessage();
        }
    } else if (isset($_POST["cheat"])) {
        $_SESSION["cheat"] = $game->getNumber();
    }

    return $app->response->redirect("guess/play");
});
