<?
  require 'models/model.php';
  $account = new Account();
  echo $account->connected($pdo);
  $title = 'E19 - P2021';
  $container = ''; 
  require 'templates/template.php';