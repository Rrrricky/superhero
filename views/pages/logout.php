<?
  require 'models/model.php';
  $account = new Account;
  echo $account->disconnection();
  $title = 'Logout';
  require 'views/partials/header.php'; 
  $container = '';
  require 'templates/template.php';
  require 'views/partials/footer.php'; 