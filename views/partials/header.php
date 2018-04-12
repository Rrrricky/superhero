<? ob_start() ?>

  <!-- If there is no session -->
  <? if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])): ?>
    <a class="app-header-nav__item" href="login">
      <span class="app-header-nav__item-connexion">Connexion</span>
    </a>
  <? else: ?>

    <!-- If there is a session -->

     <!-- If the user is admin -->
     <? if ($_SESSION['id_group'] == 1): ?>
      <a class="app-header-nav__admin" href="admin">
        <span class="app-header-nav__item">Gestion</span>
      </a>
    <? endif ?>

    <!-- If the user is not an admin -->
    <div class="app-header-nav__item app-header-nav__profil js-app-header-nav__profil">
      <span>Hello, <?= isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '' ?></span>
      <div class="app-header-nav__profil__displayer--hidden js-app-header-nav__profil__displayer--hidden">
        <a class="app-header-nav__profil__displayer--hidden__container" href="profil">
          <span class="app-header-nav__profil__displayer--hidden__container__profil">Mon profil</span>
        </a>
        <a class="app-header-nav__profil__displayer--hidden__container" href="logout">
          <span class="app-header-nav__profil__displayer--hidden__container__logout">Déconnexion</span>
        </a>
      </div>
      <div class="app-header-nav__item__pic app-header-nav__profil__pic_container">
        <img class="app-header-nav__profil__pic_container__img" src="uploads/<?= $_SESSION['picture_name'].'.'.$_SESSION['picture_type'] ?>" alt="user-pic">
      </div>
    </div>
  <? endif ?>
  
<? $header_container = ob_get_clean() ?>
<? require 'templates/header.php'; ?>