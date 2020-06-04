<?php

namespace App;

use App\Database;
use App\Config;

class App
{

    public string $title = 'Mon Super Site';
    /**
     * @var App une instance de la l'application
     */
    private static $_instance;

    /**
     * @var PDO
     */
    private static $_database;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getDatabase()
    {
        $settings = Config::getInstance();
        if (self::$_database == null) {
            self::$_database = new Database($settings->getKey('db_name'), $settings->getKey('db_user'), self::DB_PASS, self::DB_HOST);
        }

        return self::$_database;
    }

    public static function notFound()
    {
        header('http/1.0 Not Found');
        header('location:index.php?=404');
    }
}
