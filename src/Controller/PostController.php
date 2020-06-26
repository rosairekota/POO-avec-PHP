<?php
namespace App\Controller;



class PostController extends AppController{
private $Post;
private $Category;
public function __construct()
{
  parent::__construct();
  $this->Post=$this->loadModel('Post');
   $this->Category=$this->loadModel('Category');
}
public function index(){

  $categories = $this->Category->findAll();
  $posts = $this->Post->getLast();

  $this->render('posts/index.html.twig',compact('posts','categories'));
 
}
public function create(){}
public function edit(){}
public function show(){

  $post = $this->Post->find($_GET['id']);

  
 
  $this->render('blog.show',compact('post'));
}
public function categories(){}


}