<?php



/**
 * Implementation d'un routeur basé sur Alto Route
 * Routeur
 */
class Routeur
{
    /**
     * @var String retourne le chemin vers le dossier de views
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $routeur;
    public function __construct(string $viewPath)
    {
        $this->viewPath=$viewPath;
        $this->routeur=new \AltoRouter();
    }
    public function get(string $route, string $view,?string $name):?self
    {
        $this->routeur->map('GET',$route,$view,$name);
       return $this;
    }



    /**
     * il match la route
     *
     * recupere le target et en suite il retourne la vue
     *
     * @return self
     **/
    public function run():?self
    {
       $match=$this->routeur->match();
       $view=$match['target'];
      
       

       ob_start();
       require $this->viewPath.'/'.$view.'.html.phtml';
       $pageContent = ob_get_clean();

       require  $this->viewPath.'/layouts/default.html.phtml';
       return $this;
    }
}
