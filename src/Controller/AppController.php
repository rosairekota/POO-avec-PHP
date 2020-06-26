<?php
namespace App\Controller;

use App;
use Core\Controller\AbstractController;

class AppController extends AbstractController
{
   protected $model;
    public function __construct()
    {
        $this->viewPath=ROOT.'/views/';
        $this->templateBase='layouts/default';
    }

    protected function loadModel($model){
        if (!is_null($model)) {
           return  $this->model=App::getInstance()->getTable($model);
        }
    }
}
