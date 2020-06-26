<?php

use App\Controller\PostController;

define('ROOT', dirname(__DIR__));
require ROOT . '/src/App.php';


$app = App::run();



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
  $postController=new PostController();
  //$UserController=new UserController();

    ob_start();
    if ($p === 'home') {
        $postController->index();
    } elseif ($p === 'post.show') {
          $postController->show();
       
    } elseif ($p === 'category') {
         $postController->show();
    }
     elseif ($p === 'login') {
        
        echo 'tot';
    }
   