<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'profil'; ?>
<? ob_start() ?>
  <main class="app-profil">
    <h1 class="app-profil-title">Mon profil</h1>
    <container class="app-profil-personnal">
      <img src="app-profil-personnal__pic" alt="user-pic">
      <h1 class="app-profil-personnal__name"><?= $_SESSION['pseudo'] ?></h1>
    </container>
    <container class="app-profil-achievement">
      <div class="app-profil-achivement__medals">
        <h2 class="app-profil-achivement__medals__title">Mes badges</h2>
        <container class="app-profil-achivement__medals-list">
          <div class="app-profil-achivement__medals-list-bloc">
            <div class="app-profil-achivement__medals-list-bloc__medal">    
              <img src="" alt="">
              <span></span>
            </div>
          </div>
        </container> 
      </div>
      <div class="app-profil-achivement__comments">
        <h2 class="app-profil-achivement__medals__title">Mes commentaires</h2>
        <container class="app-profil-achivement__medals-list">
          <div class="app-profil-achivement__medals-list-bloc">
            <div class="app-profil-achivement__medals-list-bloc__medal">    
              <img src="" alt="">
              <span></span>
            </div>
          </div>
        </container> 
      </div>
    </container>
  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>