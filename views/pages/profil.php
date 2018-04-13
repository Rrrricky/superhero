<? session_start() ?>
<? require 'models/model.php'; ?>
<? $profil = new Profil ?>
<? $errorMessages = $profil->transfer_picture($pdo) ?>
<? $actions = new Actions ?>
<? $result = $actions->api() ?>
<? $title = 'Profil'; ?>
<? ob_start() ?>

<!-- If the user is connected -->
<? if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])): ?>
  <main class="app-profil">
    <h1 class="app-profil-title">Profil</h1>
    <container class="app-profil-container">
      <div class="app-profil-container-personnal">

        <!-- Display the username and date of inscription -->
        <h4 class="app-profil-container-personnal__name"><?= $_SESSION['pseudo'] ?></h4>
        <div class="app-profil-container-personnal__date">Inscrit le: <?= date('d/m/y', strtotime($_SESSION['inscription'])) ?></div>

        <!-- Display the picture if there is one -->
        <? if(!empty($_SESSION['picture_name'])): ?>
          <img class="app-profil-container-personnal__pic" src="uploads/<?= $_SESSION['picture_name'].'.'.$_SESSION['picture_type'] ?>" alt="user-pic">
        <? else: ?>
          <p class="app-profil-container-personnal__nopic">Pas d'image de profil</p>
        <? endif ?>

        <!-- Form to send a picture -->
        <form class="app-profil-container-personnal-form" enctype="multipart/form-data" action="#" method="post"> <!-- enctype for binary data -->
          <input class="app-profil-container-personnal-form__file" type="file" name="profil">
          <button class="app-profil-container-personnal-form__submit" type="submit" value="submit">Send</button>
        </form>
        
        <? foreach($errorMessages as $messages): ?> 
          <p class="app-logerror"><?= $messages ?></p>
        <? endforeach ?>  
      </div>
      <div class="app-profil-container-secondary">
        <div class="app-profil-container-secondary-achievement">
          <div class="app-profil-container-secondary-achievement__medals">
            <h5 class="app-profil-container-secondary-achievement__medals__title">Mes badges</h5>
            <div class="app-profil-container-secondary-achievement__medals-list">
              <div class="app-profil-container-secondary-achievement__medals-list-bloc">
                <div class="app-profil-container-secondary-achievement__medals-list-bloc__medal">    
                  <img src="" alt="">
                  <span>Aucun bagde</span>
                </div>
              </div>
            </div> 
          </div>
          <div class="app-profil-container-secondary-achievement__comments">
            <h5 class="app-profil-container-secondary-achievement__comments__title">Mes commentaires</h5>
            <div class="app-profil-container-secondary-achievement__comments-list">
              <div class="app-profil-container-secondary-achievement__comments-list-bloc">
                <div class="app-profil-container-secondary-achievement__comments-list-bloc__comment">    
                  <img src="" alt="">
                  <span>Aucun commentaire</span>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <!-- API -->
        <div class="app-profil-container-secondary-api">
          <?= str_replace('Chuck Norris', $_SESSION['pseudo'], $result[rand(0, 9)]->fact) ?>
        </div>
      </div>
    </container>
  <main>  
<? else: ?>
  <? header('Location: 404'); ?>
<? endif ?>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>