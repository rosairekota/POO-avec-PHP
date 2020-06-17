<?php

namespace Core;

class Config
{
    /**
     * @var array c'est une tableaux des configurations(db_user,db_host...)
     */
    private array $settings = [];

    /**
     * @var Config
     */
    private static $_instance;

    public function __construct($file)
    {
        $this->settings = require $file; // file =fichier de configuration;
    }

    /**
     * @return Config retoune une instance de Config
     */
    public static function getInstance($file)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        } else {
            return self::$_instance;
        }
    }

    /**
     * @param string|null une Clé de configurqtion: nom de la BD(db_name),...
     * @return array|null Retoune une Clé de configurqtion: nom de la BD(db_name),...
     */
    public function getKey(string $key)
    {

        if (!isset($this->settings[$key])) {
            return null;
        }

        return $this->settings[$key];
    }
}
