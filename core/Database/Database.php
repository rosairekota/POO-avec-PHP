<?php

namespace Core\Database;



abstract class Database implements DatabaseInterface
{

    /**
     * @var string|null Ceci prend le nom de la base de données
     */ 
    protected $db_name;

    /**
     * @var string|null Ceci prend le nom de l'utilisateur la base de données
     */
    protected $db_user;

    /**
     * @var string|null  Ceci prend le ,ot de passe
     */
    protected $db_pass;

    /**
     * @var string|null Ceci prend le nom de la machine:ex.localhost
     */
    protected $db_host;

    /**
     * @var PDO|null Ceci prend le PDO
     */
    protected $instance = null;





    public abstract function query($statement, $class_name = null, bool $one = false);

    public abstract function prepare($statement, $params = [], $class_name, $one = false);
}
