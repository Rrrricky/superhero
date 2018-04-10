<? require 'models/model.php'; ?>
<? $account = new Account ?>
<?= $account->connection($pdo); ?>
<? $title = 'Login'; ?>
<? require 'views/partials/header.php'; ?>
<? ob_start() ?>
  <form class="app-loginform" action="profil" method="post">
    <h1 class="app-loginform-title">Se connecter</h1>
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <button class="app-loginform-button" type="submit" value="submit">Connexion</button>
    <div class="app-loginform-register">
      <span>Pas encore de compte ?</span>
      <a href="register">Je m'inscris</a>
    </div>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>