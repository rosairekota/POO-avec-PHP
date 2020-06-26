<?php
namespace Core\Renderer;

interface RenderInterface{

    public function render(string $views,$datas);

    public function addPath(string $path,?string $templateBase=null);

      public function addGlobal(string $key,$value):void;
}