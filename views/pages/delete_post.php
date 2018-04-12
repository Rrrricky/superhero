<?
$query = $pdo->exec('DELETE FROM posts_tovalidate WHERE id='.$_GET['id']);