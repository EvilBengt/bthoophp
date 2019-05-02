<?php

namespace EVB\OneHundred;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $this->app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class OneHundredController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        return $this->app->response->redirect("onehundred-controller/init");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function initAction() : object
    {
        $theDice = new HistogramDice();

        $this->app->session->set(
            "onehundred",
            new Game(
                $theDice,
                new NormalPlayer(
                    new NormalDiceHand(
                        [$theDice, $theDice]
                    )
                ),
                new NormalPlayer(
                    new NormalDiceHand(
                        [$theDice, $theDice]
                    )
                )
            )
        );

        $this->app->page->add("oneHundredController/init");

        return $this->app->page->render([
            "title" => "Starta spelet"
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function rollAction() : object
    {
        $game = $this->app->session->get("onehundred");

        if ($game->getWinner()) {
            return $this->app->response->redirect("onehundred-controller/game-over");
        }

        $game->rollPlayer();

        if ($game->playerRolledOnes()) {
            return $this->app->response->redirect("onehundred-controller/roll-results-stop");
        } else {
            return $this->app->response->redirect("onehundred-controller/roll-results");
        }
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function rollResultsAction() : object
    {
        $title = "Play the game";

        $game = $this->app->session->get("onehundred");

        $scores = [
            "playerScore" => $game->getPlayerTotalScore(),
            "computerScore" => $game->getComputerTotalScore()
        ];

        $histogram = [
            "histogram" => $game->getHistogram()
        ];

        $this->app->page->add("oneHundredController/scores", $scores);
        $this->app->page->add("oneHundredController/histogram", $histogram);
        $this->app->page->add("oneHundredController/roll", ["roll" => $game->getLastRoll()]);
        $this->app->page->add("oneHundredController/rollOk", ["sum" => $game->getPlayerTempScore()]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function rollResultsStopAction() : object
    {
        $title = "Play the game";

        $game = $this->app->session->get("onehundred");

        $scores = [
            "playerScore" => $game->getPlayerTotalScore(),
            "computerScore" => $game->getComputerTotalScore()
        ];

        $histogram = [
            "histogram" => $game->getHistogram()
        ];

        $this->app->page->add("oneHundredController/scores", $scores);
        $this->app->page->add("oneHundredController/histogram", $histogram);
        $this->app->page->add("oneHundredController/roll", ["roll" => $game->getLastRoll()]);
        $this->app->page->add("oneHundredController/rollOver");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function saveAction() : void
    {
        $game = $this->app->session->get("onehundred");

        $game->savePlayer();

        if ($game->getWinner()) {
            $this->app->response->redirect("onehundred-controller/game-over");
            return;
        }

        $this->app->response->redirect("onehundred-controller/computer");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function computerAction() : object
    {
        $game = $this->app->session->get("onehundred");

        $game->playComputer();

        $this->app->response->redirect("onehundred-controller/computer-results");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function computerResultsAction() : object
    {
        $title = "Play the game";

        $game = $this->app->session->get("onehundred");

        $scores = [
            "playerScore" => $game->getPlayerTotalScore(),
            "computerScore" => $game->getComputerTotalScore()
        ];

        $histogram = [
            "histogram" => $game->getHistogram()
        ];

        $this->app->page->add("oneHundredController/scores", $scores);
        $this->app->page->add("oneHundredController/histogram", $histogram);
        $this->app->page->add("oneHundredController/computerResults", ["results" => $game->getComputerResults()]);

        return $this->app->page->render([
            "title" => $title
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function gameOverAction() : object
    {
        $title = "Play the game";

        $game = $this->app->session->get("onehundred");

        $scores = [
            "playerScore" => $game->getPlayerTotalScore(),
            "computerScore" => $game->getComputerTotalScore()
        ];

        $histogram = [
            "histogram" => $game->getHistogram()
        ];

        $this->app->page->add("oneHundredController/scores", $scores);
        $this->app->page->add("oneHundredController/histogram", $histogram);
        $this->app->page->add("oneHundredController/gameOver", ["winner" => $game->getWinner()]);

        return $this->app->page->render([
            "title" => $title
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!!";
    }
}
