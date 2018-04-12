<?
  require 'models/model.php'; 
  $posts = new Posts;
  $posts->validate($pdo, $_GET['id']); 
