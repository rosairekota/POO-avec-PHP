<?php

namespace App\Entity;

use Core\Entity\Entity;
use Core\Table\Table;

class PostEntity extends Entity

{
    public $id;

    public $title;

    public $content;

    public $category_id;
    public $createdAt;


    public function getURL()
    {
        return "index.php?p=post.show&id={$this->id}";
    }

    public function getExtrait()
    {
        $content = substr(nl2br($this->content), $start = 0, $end = 50);
        $html = $content . '...<br>';
        $html .= '<a href=' . $this->getURL() . '>Voir la suite</a>';
        return $html;
    }
    /*


        public function getExtrait()
    {
         $start=0;
         $limit=50;
        if (mb_strlen($this->content)<=$limit) {
            $contents_sub=$this->content;
        }
        /**
         * on fait en sorte qu'on ne puisse pas couper des mots aux quels notre limite est atteint: 
         * en utilisant la fonction mb_strpos()
         * par ex. justem...[des qu'il arrivera ici il va saute pr prendre completement ce mot et couper la il ya l'espace vide]
        
        $lastSpaceNumber=mb_strpos($this->content,' ',$limit);
        var_dump($lastSpaceNumber);
        $contents_sub = mb_substr(nl2br($this->content), $start, $limit);
        $html = $contents_sub . '...<br>';
        $html .= '<a href=' . $this->getURL() . '>Voir la suite</a>';
        return $html;
    }

    */
}
