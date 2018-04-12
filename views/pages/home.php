<?
  session_start();
  require 'models/model.php';
  $account = new Account();
  echo $account->connected($pdo);
  $title = 'E19 - P2021';
?>
<? ob_start() ?>
  <main class="app-home">
    <div class="app-home-title">Hero <span class="app-home-title__word">Up</span></div>
    <div class="app-home-headline">On ne naît pas héros, on le devient.</div class="app-home-title__headline">
    <? if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])): ?>
      <container class="app-home-buttons">
        <a href="login">
          <button class="app-home-buttons__connection">Connexion</button>
        </a>
        <a href="register">
          <button class="app-home-buttons__registration">Inscription</button>
        </a>
      </container>
    <? endif ?>
  </main>  
<? $container = ob_get_clean() ?>
<? 
  require 'templates/template.php';
  require 'views/partials/footer.php'; 
?>

  
