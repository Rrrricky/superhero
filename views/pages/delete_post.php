<?
  require 'models/model.php'; 
  $posts = new Posts;
  $posts->delete($pdo, $_GET['id']); 
// $query = $pdo->exec('DELETE FROM posts_tovalidate WHERE id='.$_GET['id']);