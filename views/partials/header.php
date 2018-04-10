<? ob_start() ?>
  <? if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])): ?>
    <a class="app-header-nav__item" href="login">
      <span class="app-header-nav__item">Connexion</span>
    </a>
  <? else: ?>
    <a class="app-header-nav__item" href="logout">
      <span class="app-header-nav__item">Déconnexion</span>
    </a>
  <? endif ?>
<? $header_container = ob_get_clean() ?>
<? require 'templates/header.php'; ?>