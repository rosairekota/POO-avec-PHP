<?php

namespace App\Table\Static_Class_OLD;

use App\App;
use App\Table\Table;

class Category extends Table
{
    public static $table = 'category';


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
        return "index.php?p=category&id={$this->id}";
    }

    public function getExtrait()
    {
        $content = substr(nl2br($this->description), $start = 0, $end = 50);
        $html = $content . '...<br>';
        $html .= '<a href=' . $this->getURL() . '>Voir la suite</a>';
        return $html;
    }
}
