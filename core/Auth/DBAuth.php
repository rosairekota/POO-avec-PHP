<?php
namespace Core\Auth;

use Core\Database\DatabaseInterface;

/**
 * Classe d'authentification des Users par Base de données
 */
class DBAuth
{
  
    private DatabaseInterface $db;


    public function __construct(DatabaseInterface $db)
    {
        $this->db=$db;
        
    }
    /**
     * la fonction de connexion
     *
     * @param $username
     * @param $password
     * @return boolean
     **/
    public function login($username, $password)
    {
        $user=$this->db->prepare('SELECT * FROM users WHERE username=?',[$username],null,true);
        if ($user) {
           if ($user->password===sha1($password)) {
               $_SESSION['auth']=$user->id;
                return true;
           };
         
        }
      
        return false;
        
    }

    /**
     * Cette fonction permet de verifier si l'utilisateur  est deja conntecter
     *
     * Pour cela, on utilisera la session
     *
     * @return $_SESSION
     **/
    public function logged()
    {
       return isset($_SESSION['auth']) ;
       
    }
    
    /**
     * @return $_SESSION
     */
    public function getUserId (){
        if ($this->logged()) {
           return $_SESSION['auth'];
        }
    }
}

