<?php

namespace App\Table;


use Core\Table\Table;

class PostTable extends Table

{
    protected $table = 'Post';

    /**
     * Selectionne les derniers articles par date decroissante
     * @return array 
     */
    public function getLast()
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
         return $this->query("SELECT p.id,p.title,p.content,p.image,p.created_at,c.id,c.title as categorie
                                                FROM post as p
                                                LEFT JOIN category as c
                                                ON p.category_id=c.id
                                                ORDER BY p.created_at DESC
                                                ");

       
    }

    /**
     * Selectionne l'article en liant le categorie associée
     * @return array 
     */
    public function find($id)
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        return $this->query("SELECT p.id,p.title,p.content,p.image,p.created_at,c.id,c.title as categorie
                                                FROM post as p
                                                LEFT JOIN category as c
                                                ON p.category_id=c.id
                                                WHERE p.id=?
                                                ORDER BY p.created_at DESC
                                                ",[$id],true);

       
    }

    public function findByCategoryId(int $category_id)
    {

        return $this->query("SELECT p.id,p.title,p.content,p.image,p.created_at,c.id,c.title as category
                                                FROM post as p
                                                LEFT JOIN category as c
                                                ON p.category_id=c.id
                                                WHERE p.category_id=?
                                                ", [$category_id]);

       
    }
}
