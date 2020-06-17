<?php


use App\App;

class TableOLD
{

    protected static $_table;

    protected $table;

    public function __construct()
    {
        if (is_null($this->table)) {
            $class_name = explode('\\', get_class($this)); //permet d'avoir le nom de la classe fille
            $parts = end($class_name);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 'Table'; //permet d'avoir le nom de la table
        }
    }


    public static function find($id)
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        return  self::query("SELECT *
                                   FROM " . static::$_table . "
                                   WHERE id=? 
                                   ", [$id], get_called_class(), true);
    }
    public static function findAll()
    {
        // App\App::getDatabase()->query('SELECT * FROM post', 'App\Table\Post');
        $categories = App::getDatabase()->query("SELECT *
                                                FROM " . static::$_table . "
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
