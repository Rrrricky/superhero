<? ob_start() ?>
  <? if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])): ?>
    <a class="app-header-nav__item" href="login">
      <span class="app-header-nav__item">Connexion</span>
    </a>
  <? else: ?>
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