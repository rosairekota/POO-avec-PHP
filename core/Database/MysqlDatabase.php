<?php

namespace Core\Database;

use Core\Database\Database;
use \PDO;

class MysqlDatabase extends Database
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

    public function query($statement, $class_name = null, bool $one = false)
    {
        // $classe = explode('\\', $class_name); //permet d'avoir le nom de la classe fille
        // $parts = end($classe);
        // $table = strtolower(str_replace('Entity', '', $parts));
        // var_dump($class_name);
       
        $req = $this->getPdo()->query($statement);
         if ($this->checkStatement($statement,$req)) {
             # code...
         }
        else{
        $request= $this->checkFetchPdo($class_name,$req);
        if ($one) {
            $datas = $request->fetch();
        } else {

            $datas = $request->fetchAll();
        }
        
        return $datas;
        }
    }

    public function prepare($statement, $params = [], $class_name=null, $one = false)
    {
        $req = $this->getPdo()->prepare($statement);
        $res= $req->execute($params);
       if ( $this->checkStatement($statement,$res)) {
           # code...
       }else{
        // on fait de petite manip pour qu'on soit a mesure de recuperer un seul enregistrement. 
        //car le fetchAll renvoi un tableau et donc ca genere une erreure.
        $request= $this->checkFetchPdo($class_name,$req);
        if ($one) {
            $datas = $request->fetch();
        } else {

            $datas = $request->fetchAll();
        }
        return $datas;
       }
    }

    /** 
     * Cette fonctrion retourne l'id du dernier enregistrement 
     **/
    public function getLastInsertId()
    {
    return $this->getPdo()->lastInsertId();
    }


    /** 
     * ------------------------Partie des fonctions privées-----------------------
     *  
     **/
    private function checkStatement($statement,$res){
        if (
            strpos($statement,'UPDATE')===0||
             strpos($statement,'INSERT')===0||
              strpos($statement,'DELETE')===0
        ) {
            return $res;
        }
    }
    /**
     * @param string|null Nom de la classe:ex.App\Post
     * @param string
     * @return Object
     */
    private function checkFetchPdo($class_name,$req){
        if ($class_name == null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {

            /*on recupere les données en mappant aux classes correspondantes
              Ceci permet d'avoir au niveau de nos entites toutes les donnes en fonction de chaque table:
              ex: App\Entity\PostEntity[id,title,content,...]=> ceci permet d'effectuer des traiement en leurs transformant en getters et setters
            */
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        return $req;
    }
}
