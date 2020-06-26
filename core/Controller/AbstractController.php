<?php
namespace Core\Controller;

use Core\Renderer\PHPRender;

abstract class AbstractController {

private $renderer;
protected $viewPath;
protected $templateBase;

/**
 * @param string $view
 * @param array $datas
 */
public function render(string $view,?array $datas=[]){
     // Le rendu avec PHP
    /* $this->renderer=PHPRender::getInstance($this->viewPath,$this->templateBase);
    //$this->renderer->addPath($this->viewPath,$this->templateBase);

    $this->renderer->render($view,$datas);
    */
  
   // Le rendu avec Twig
    $loader = new \Twig\Loader\FilesystemLoader($this->viewPath);
   
   
      $this->renderer =new \Twig\Environment($loader, ['cache' => false,]);
    $this->renderer->render($view,$datas);
    

}


public function notFound()
    {
        header("Http/1.0 404 not Found");
        die('Page Introuvable');

    }

    
public function forbidden()
    {
        header("Http/1.0 403 forbidden");
        die('Accès interdit');

    }
}