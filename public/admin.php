<?php

use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;

define('ROOT', dirname(__DIR__));
require ROOT . '/src/App.php';


$app = App::run();



$app = App::getInstance();





//TRAITEMENT DE NOS ROUTES AVEC NOTRE ROUTEUR
// $routeur =new \Routeur(ROOT .'/views');
// $routeur->get('/','admin/home','home')
//         ->get('/admin','admin/post','post')
//         ->run();



    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $p = $_GET['p'];
    } else {
        $p = 'home';
    }

    // Auth
   
  $auth=new DBAuth($app->getDatabase());
  if (!$auth->logged()) {
      $app->forbidden();
  }
 
    ob_start();
    if ($p === 'home') {
        require ROOT . '/views/admin/posts/index.html.phtml';
    } elseif ($p === 'post.edit') {
        require ROOT . '/views/admin/posts/edit.html.phtml';
    } elseif ($p === 'post.add') {
        require ROOT . '/views/admin/posts/add.html.phtml';
    }
       elseif ($p === 'post.delete') {
        require ROOT . '/views/admin/posts/delete.php';
    }
    $pageContent = ob_get_clean();

    require  ROOT . '/views/layouts/default.html.phtml';
