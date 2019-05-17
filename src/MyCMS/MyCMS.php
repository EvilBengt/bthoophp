<?php

namespace EVB\MyCMS;

use EVB\MyTextFilter\MyTextFilter;

class MyCMS
{
    /**
     * Database connection through Anax\Database
     *
     * @var \Anax\Database
     */
    private $db;

    /**
     * Textfilter class
     *
     * @var \EVB\MyTextFilter\MyTextFilter
     */
    private $filter;

    public function __construct($db)
    {
        $this->db = $db;
        $this->filter = new MyTextFilter();
    }

    public function listPages()
    {
        $sql = <<<END
            SELECT COALESCE(path, slug) AS link,
                   title
              FROM content
             WHERE type = "page"
               AND published IS NOT NULL
               AND published <= NOW()
               AND deleted IS NULL
                OR deleted > NOW();
END;
        return $this->db->executeFetchAll($sql);
    }

    public function getContent($path)
    {
        $sql = <<<END
            SELECT title,
                   data,
                   filter
              FROM content
             WHERE path = ?
                OR slug = ?;
END;
        $page = $this->db->executeFetch($sql, [$path, $path]);

        $page->data = $this->filter->parse(
            $page->data,
            \explode(",", $page->filter)
        );

        return $page;
    }

    public function listBlogPosts()
    {
        $sql = <<<END
            SELECT COALESCE(path, slug) AS link,
                   title,
                   CONCAT(SUBSTRING(data, 1, 100), "...") AS preview
              FROM content
             WHERE type = "post"
               AND published IS NOT NULL
               AND published <= NOW()
               AND deleted IS NULL
                OR deleted > NOW();
END;
        return $this->db->executeFetchAll($sql);
    }

    public function listAll()
    {
        $sql = <<<END
            SELECT id,
                   path,
                   slug,
                   type,
                   title,
                   filter,
                   published,
                   created,
                   updated,
                   deleted
              FROM content;
END;
        return $this->db->executeFetchAll($sql);
    }

    public function slugify($text)
    {
        return $this->filter->slugify($text);
    }

    public function slugIsUnique($slug)
    {
        $sql = <<<BLA
            SELECT CASE WHEN EXISTS (SELECT * FROM content WHERE slug = ? LIMIT 1)
                        THEN 0
                        ELSE 1
                        END AS is_unique;
BLA;
        return $this->db->executeFetch($sql, [$slug])->is_unique ? true : false;
    }

    public function create($data)
    {
        $sql = <<<END
            INSERT INTO content (path, slug, title, data, type, filter)
            VALUES (?, ?, ?, ?, ?, ?);
END;
        $this->db->execute($sql, $data);
    }


    public function getRow($id)
    {
        $sql = <<<END
            SELECT id,
                   path,
                   slug,
                   type,
                   title,
                   filter,
                   data,
                   published,
                   created,
                   updated
              FROM content
             WHERE id = ?;
END;
        return $this->db->executeFetch($sql, [$id]);
    }

    public function delete($id)
    {
        $sql = <<<END
            DELETE FROM content
             WHERE id = ?
             LIMIT 1;
END;
        $this->db->execute($sql, [$id]);
    }

    public function update($data)
    {
        $sql = <<<END
            UPDATE content
               SET path      = ?,
                   slug      = ?,
                   title     = ?,
                   data      = ?,
                   type      = ?,
                   filter    = ?,
                   published = ?
             WHERE id = ?
             LIMIT 1;
END;
        $this->db->execute($sql, $data);
    }
}
