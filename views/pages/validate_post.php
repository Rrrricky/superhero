<?
  require 'models/model.php'; 
  $model = new Model;
  $result = $model->validate($pdo); 
// $query = $pdo->exec('DELETE FROM posts_tovalidate WHERE id='.$_GET['id'])
