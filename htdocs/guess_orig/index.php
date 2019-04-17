<?php
/**
 * Guess my number
 */
require "autoload.php";
require "config.php";

session_name("numberGuessData");
session_start();

$game = $_SESSION["guess"] ?? new Guess();

$result = "";
$cheat = "";

if (isset($_POST["guess"]) && isset($_POST["value"])) {
    $result = $game->makeGuess($_POST["value"]);
} else if (isset($_POST["restart"])) {
    destroy_session();
    header("Location: index.php");
    exit();
} else if (isset($_POST["cheat"])) {
    $cheat = $game->getNumber();
}

$triesLeft = $game->getTries();

require "view/main.php";

$_SESSION["guess"] = $game;


function destroy_session()
{
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}
