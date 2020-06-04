<?php

namespace App;

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

    public function __construct()
    {
        $this->settings = require_once dirname(__DIR__) . '/config/config.php';
    }

    /**
     * @return Config retoune une instance de Config
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        } else {
            return self::$_instance;
        }
    }

    /**
     * @param string|null une Clé de configurqtion: nom de la BD(db_name),...
     * @return string|null Retoune une Clé de configurqtion: nom de la BD(db_name),...
     */
    public function getKey(string $key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        // on retourne la cLE(db_user)
        return $this->settings[$key];
    }
}
