<?php

namespace App\Table;

use App\App;

class Table
{

    protected static $table;
    public static function getTableName()
    {
        if (static::$table == null) {
            $class_name = explode('\\', get_called_class()); //permet d'avoir le nom de la classe fille
            static::$table = strtolower(end($class_name)); //permet d'avoir le nom de la table
            var_dump(static::$table);
        }
        return static::$table;
    }

    public static function find($id)
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        return  self::query("SELECT *
                                   FROM " . static::getTableName() . "
                                   WHERE id=? 
                                   ", [$id], get_called_class(), true);
    }
    public static function findAll()
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        $categories = App::getDatabase()->query("SELECT *
                                                FROM " . static::getTableName() . "
                                               ", get_called_class());

        return $categories;
    }


    public  function query(string $statements, array $attributes = null, bool $one = false)
    {
        if ($attributes) {
            return  App::getDatabase()->prepare($statements, $attributes, get_called_class(), $one);
        } else {
            return  App::getDatabase()->query($statements, get_called_class(), $one);
        }
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
