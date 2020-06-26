<?php
namespace Core\Renderer;

class PHPRender implements RenderInterface
{
    private $viewPath;
    protected $templateBase;
    private static $_instance;

 /**
  * @param string $path
  **/   
public static function getInstance(?string $defaultPath=null,?string $templateBase=null){
    if (self::$_instance==null) {
        self::$_instance=new PHPRender();
        if ($defaultPath==null &&$templateBase==null) {
            self::$_instance->addPath($defaultPath,$templateBase);
        }
    }
    return self::$_instance;
}
    public function render($view,$datas){
         ob_start();
    extract($datas);
    require($this->viewPath.str_replace('.','/',$view).'.html.phtml');
    $pageContent=ob_get_clean();
   
    require($this->viewPath.'/'.$this->templateBase.'.html.phtml');
    }

    public function addPath(string $path,?string $templateBase=null){
        if (!is_null($path)) {
            $this->viewPath=$path;
            $this->templateBase=$templateBase;

        }
    
    }
    public function addGlobal(string $key,$value):void{}
}
