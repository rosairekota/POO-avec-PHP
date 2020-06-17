<?php

$app=App::getInstance();
if (!empty($_POST)) {
   $result= $app->getTable('Post')->delete($_POST['id']);
   if ($result==null) {
       header('Location:admin.php');
   }
}