<?php

namespace Core\Entity;


use Core\Table\Table;

class Entity

{

    public function __get($key)
    {
        // var_dump('Appel de la methode magique');
        $method = 'get' . \ucfirst($key);
        $this->$key = $this->$method();
        //on retoune la methode demande
        return $this->$key;
    }
}
