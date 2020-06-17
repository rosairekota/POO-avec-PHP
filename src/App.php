<?php

use Core\Database\DatabaseInterface;
use Core\Database\MysqlDatabase;


/**
 * Application
 */
class App
{
    
    private $db_instance;

    /**
     * @var App
     */
    private static $_instance;
  
  
  
    /**
     * Cette f(x) permet de lancer de notre application
     **/
    public static function run()
    {
        session_start();
        require ROOT .'/vendor/autoload.php';
       // require ROOT .'/src/utils.php';
    
    }
    public static function getInstance(){
        if (self::$_instance==null) {
            self::$_instance=new App();
        }
        return self::$_instance;
    }

     public function getDatabase()
    {
   
       if ($this->db_instance==null) {
           $this->db_instance=new MysqlDatabase('blog_dev');
       }
      
        return $this->db_instance;
    }
    
    /**
     * creation de la factory de pour nos table
     *
     *
     * @param string $class_name
     * @return App\Table\Table
     **/
    public function getTable($class_name)
    {
        $class='App\\Table\\'.ucfirst($class_name).'Table';
       
        return new $class($this->getDatabase());
    }
    
    public function notFound()
    {
        header("Http/1.0 404 not Found");
        header('location:index.php?=404');
        die('Page Introuvable');

    }

    
    public function forbidden()
    {
        header("Http/1.0 403 forbidden");
        die('Accès interdit');

    }

}
