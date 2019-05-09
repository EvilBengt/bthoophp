<?php

namespace EVB\Movies;

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
class MoviesController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * String to append to end of all titles.
     *
     * @var string
     */
    private $titleExtended = " | My Movie Database";

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        return $this->app->response->redirect("movies/all");
    }

    /**
     * List all movies
     * ANY METHOD mountpoint/all
     *
     * @return object
     */
    public function allAction() : object
    {
        $this->app->db->connect();

        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movies/header");
        $this->app->page->add("movies/show-all", ["resultset" => $res]);

        return $this->app->page->render([
            "title" => "Show all" . $this->titleExtended
        ]);
    }

    /**
     * Search for title
     * ANY METHOD mountpoint/search-title
     *
     * @return object
     */
    public function searchTitleAction() : object
    {
        $search = $this->app->request->getGet("search");

        $this->app->db->connect();

        $sql = "SELECT * FROM movie WHERE title LIKE ?";

        $res = $this->app->db->executeFetchAll($sql, [$search]);

        $this->app->page->add("movies/header");
        $this->app->page->add("movies/search-title", ["search" => $search]);
        if (\count($res) > 0) {
            $this->app->page->add("movies/show-all", ["resultset" => $res]);
        }

        return $this->app->page->render([
            "title" => "Search title" . $this->titleExtended
        ]);
    }

    /**
     * Search for year intervall
     * ANY METHOD mountpoint/search-year
     *
     * @return object
     */
    public function searchYearAction() : object
    {
        $year1 = $this->app->request->getGet("year1");
        $year2 = $this->app->request->getGet("year2");

        $this->app->db->connect();

        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?";

        $res = $this->app->db->executeFetchAll($sql, [
            $year1,
            $year2
        ]);

        $this->app->page->add("movies/header");
        $this->app->page->add("movies/search-year", [
            "year1" => $year1,
            "year2" => $year2
        ]);
        if (\count($res) > 0) {
            $this->app->page->add("movies/show-all", ["resultset" => $res]);
        }

        return $this->app->page->render([
            "title" => "Search title" . $this->titleExtended
        ]);
    }

    /**
     * Edit a movie
     * GET mountpoint/edit
     *
     * @return object
     */
    public function editActionGet() : object
    {
        $this->app->db->connect();

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $res = $this->app->db->executeFetch($sql, [$this->app->request->getGet("id")]);

        $this->app->page->add("movies/header");
        $this->app->page->add("movies/movie-edit", ["movie" => $res]);

        return $this->app->page->render([
            "title" => "Edit movie" . $this->titleExtended
        ]);
    }

    /**
     * Edit a movie, do the stuff
     * POST mountpoint/edit
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $this->app->db->connect();

        $movieId    = $this->app->request->getPost("movieId");
        $movieTitle = $this->app->request->getPost("movieTitle");
        $movieYear  = $this->app->request->getPost("movieYear");
        $movieImage = $this->app->request->getPost("movieImage");

        if ($this->app->request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$movieId]);
        } else if ($this->app->request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }

        return $this->app->response->redirect("movies/all");
    }

    /**
     * Create a movie
     * GET mountpoint/create
     *
     * @return object
     */
    public function createActionGet() : object
    {
        $this->app->page->add("movies/header");
        $this->app->page->add("movies/movie-create");

        return $this->app->page->render([
            "title" => "Create movie" . $this->titleExtended
        ]);
    }

    /**
     * Create a movie, do the stuff
     * POST mountpoint/create
     *
     * @return object
     */
    public function createActionPost() : object
    {
        $this->app->db->connect();

        $movieTitle = $this->app->request->getPost("movieTitle");
        $movieYear  = $this->app->request->getPost("movieYear");
        $movieImage = $this->app->request->getPost("movieImage");

        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?)";
        $this->app->db->execute($sql, [
            $movieTitle,
            $movieYear,
            $movieImage
        ]);

        return $this->app->response->redirect("movies/all");
    }
}
