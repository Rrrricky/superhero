<? ob_start() ?>
  <? if(empty($_SESSION)): ?>
    <a class="app-header-nav__item" href="login">
      <span class="app-header-nav__item">Connexion</span>
    </a>
  <? else: ?>
    <a class="app-header-nav__item" href="register">
      <span class="app-header-nav__item">Profil</span>
    </a>
  <? endif ?>
<? $header_container = ob_get_clean() ?>
<? require 'templates/header.php'; ?>