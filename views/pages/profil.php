<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'profil'; ?>
<? ob_start() ?>
  <main class="app-profil">
    
    <h1 class="app-profil-title">Mon profil</h1>
    
    <container class="app-profil-container">


      <div class="app-profil-container-personnal">
        <img class="app-profil-container-personnal__pic" src="src/images/batman.jpg" alt="user-pic">
        <h4 class="app-profil-container-personnal__name"><?= $_SESSION['pseudo'] ?></h4>
        <span class="app-profil-container-personnal__date">Inscrit le: <?= date('d/m/y', strtotime($_SESSION['inscription'])) ?></span>
      </div>


      <div class="app-profil-container-secondary">

        <div class="app-profil-container-secondary-achievement">

          <div class="app-profil-container-secondary-achievement__medals">
            <h5 class="app-profil-container-secondary-achievement__medals__title">Mes badges</h5>
            <div class="app-profil-container-secondary-achievement__medals-list">
              <div class="app-profil-container-secondary-achievement__medals-list-bloc">
                <div class="app-profil-container-secondary-achievement__medals-list-bloc__medal">    
                  <img src="" alt="">
                  <span></span>
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
                  <span></span>
                </div>
              </div>
            </div> 
          </div>

        </div>

      </div>

    </container>

  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>