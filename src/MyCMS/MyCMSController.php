<?php

namespace EVB\MyCMS;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

use EVB\MyCMS\MyCMS;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

class MyCMSController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexAction() : object
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $pages = $cms->listPages();

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS"
        ]);
        $this->app->page->add("myCMS/index", [
            "pages" => $pages
        ]);

        return $this->app->page->render([
            "title" => "Sidor | MyCMS"
        ]);
    }

    public function pagesAction($path) : object
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $page = $cms->getContent($path);

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS"
        ]);
        $this->app->page->add("myCMS/page", [
            "page" => $page
        ]);

        return $this->app->page->render([
            "title" => $page->title . " | MyCMS"
        ]);
    }

    public function blogAction($post = null) : object
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        if ($post) {
            return $this->blogPost($post, $cms);
        }

        $posts = $cms->listBlogPosts();

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Blogg"
        ]);
        $this->app->page->add("myCMS/blog", [
            "posts" => $posts
        ]);

        return $this->app->page->render([
            "title" => "Blogg | MyCMS"
        ]);
    }

    private function blogPost($post, MyCMS $cms) : object
    {
        $postData = $cms->getContent($post);

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Blogg"
        ]);
        $this->app->page->add("myCMS/post", [
            "post" => $postData
        ]);

        return $this->app->page->render([
            "title" => $postData->title . " | Blogg | MyCMS"
        ]);
    }

    public function adminAction() : object
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $rows = $cms->listAll();

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Admin"
        ]);
        $this->app->page->add("myCMS/admin", [
            "rows" => $rows
        ]);

        return $this->app->page->render([
            "title" => "Admin | MyCMS"
        ]);
    }

    public function createActionGet()
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $title = $this->app->request->getGet("title");

        $slug = $cms->slugify($title);

        if (!$cms->slugIsUnique($slug)) {
            return $this->app->response->redirect("mycms/admin");
        }

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Admin"
        ]);
        $this->app->page->add("myCMS/adminCreate", [
            "slug" => $slug,
            "title" => $title
        ]);

        return $this->app->page->render([
            "title" => "Skapa innehåll | Admin | MyCMS"
        ]);
    }

    public function createActionPost() : object
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $data = [
            $this->app->request->getPost("path") == "" ? null : $this->app->request->getPost("path"),
            $this->app->request->getPost("slug"),
            $this->app->request->getPost("title"),
            $this->app->request->getPost("data"),
            $this->app->request->getPost("type"),
            \implode(",", $this->app->request->getPost("filters"))
        ];

        $cms->create($data);

        return $this->app->response->redirect("mycms/admin");
    }

    public function deleteActionGet($id)
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $row = $cms->getRow($id);

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Admin"
        ]);
        $this->app->page->add("myCMS/adminDelete", [
            "row" => $row
        ]);

        return $this->app->page->render([
            "title" => "Radera | Admin | MyCMS"
        ]);
    }

    public function deleteActionPost()
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $id = $this->app->request->getPost("id");

        $cms->delete($id);

        return $this->app->response->redirect("mycms/admin");
    }

    public function updateActionGet($id)
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $row = $cms->getRow($id);

        $row->filter = \explode(",", $row->filter);
        $row->published = \substr_replace($row->published, "T", 10, 1);

        $this->app->page->add("myCMS/header", [
            "title" => "MyCMS - Admin"
        ]);
        $this->app->page->add("myCMS/adminUpdate", [
            "row" => $row
        ]);

        return $this->app->page->render([
            "title" => "Uppdatera | Admin | MyCMS"
        ]);
    }

    public function updateActionPost()
    {
        $cms = new MyCMS($this->app->db);
        $this->app->db->connect();

        $data = [
            $this->app->request->getPost("path") == "" ? null : $this->app->request->getPost("path"),
            $this->app->request->getPost("slug") == "" ? null : $this->app->request->getPost("slug"),
            $this->app->request->getPost("title"),
            $this->app->request->getPost("data"),
            $this->app->request->getPost("type"),
            \implode(",", $this->app->request->getPost("filters")),
            \substr_replace($this->app->request->getPost("published"), " ", 10, 1),
            $this->app->request->getPost("id")
        ];

        $cms->update($data);

        return $this->app->response->redirect("mycms/admin");
    }
}
