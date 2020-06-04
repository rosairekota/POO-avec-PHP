<?php

namespace App;

use \PDO;

class Database
{

    /**
     * @var string|null Ceci prend le nom de la base de données
     */
    private $db_name;

    /**
     * @var string|null Ceci prend le nom de l'utilisateur la base de données
     */
    private $db_user;

    /**
     * @var string|null  Ceci prend le ,ot de passe
     */
    private $db_pass;

    /**
     * @var string|null Ceci prend le nom de la machine:ex.localhost
     */
    private $db_host;

    /**
     * @var PDO Ceci prend le PDO
     */
    private $pdo = null;



    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPdo()
    {
        if ($this->pdo == null) {

            $pdo = new PDO("mysql:dbname={$this->db_name}; host={$this->db_host}", $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            //dump('GET PDO INITIALISE');
        }

        // dump('GET PDO CALLED');
        return $this->pdo;
    }

    public function query($statement, $class_name, bool $one = false)
    {
        $req = $this->getPdo()->query($statement);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if ($one) {
            $datas = $req->fetch();
        } else {

            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function prepare($statement, $params = [], $class_name, $one = false)
    {
        $req = $this->getPdo()->prepare($statement);
        $req->execute($params);
        // on fait de petite manip pour qu'on soit a mesure de recuperer un seul enregistrement. 
        //car le fetchAll renvoi un tableau et donc ca genere une erreure.
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if ($one) {
            $datas = $req->fetch();
        } else {

            $datas = $req->fetchAll();
        }
        return $datas;
    }
}
