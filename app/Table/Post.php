<?php

namespace App\Table;

use App\App;

class Post extends Table

{
    protected static $table = 'Post';

    public static function getLast()
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        $posts = self::query("SELECT p.id,p.title,p.content,p.image,p.created_at,c.id,c.title as category
                                                FROM post as p
                                                LEFT JOIN category as c
                                                ON p.category_id=c.id");

        return $posts;
    }

    public static function lastByCategory(int $category_id)
    {

        $posts = self::query("SELECT p.id,p.title,p.content,p.image,p.created_at,c.id,c.title as category
                                                FROM post as p
                                                LEFT JOIN category as c
                                                ON p.category_id=c.id
                                                WHERE p.category_id=?
                                                ", [$category_id]);

        return $posts;
    }
    public function __get($key)
    {
        // var_dump('Appel de la methode magique');
        $method = 'get' . \ucfirst($key);
        $this->$key = $this->$method();
        //on retoune la methode demande
        return $this->$key;
    }

    public function getURL()
    {
        return "index.php?p=post&id={$this->id}";
    }

    public function getExtrait()
    {
        $content = substr(nl2br($this->content), $start = 0, $end = 50);
        $html = $content . '...<br>';
        $html .= '<a href=' . $this->getURL() . '>Voir la suite</a>';
        return $html;
    }
}
