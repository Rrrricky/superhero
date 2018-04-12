<?
  require 'models/model.php'; 
  $posts = new Posts;
  $posts->delete($pdo, $_GET['id']); 