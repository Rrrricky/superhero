<?
  session_start();
  require 'models/model.php';
  $account = new Account();
  echo $account->connected($pdo);
  $title = 'E19 - P2021';
  include 'views/partials/header.php'; 
  $container = ''; 
  require 'templates/template.php';
  require 'views/partials/footer.php'; 

  