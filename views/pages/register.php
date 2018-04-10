<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account; ?>
<? $errorMessages = $account->inscription($pdo) ?>
<? $title = 'Register' ?>
<? ob_start() ?>
  <? if(isset($errorMessages)):?>
    <? foreach($errorMessages as $message): ?>
      <p class="app-logerror"><?= $message ?></p>
    <? endforeach ?>
  <? endif ?>
  <form class="app-subform" action="#" method="post">
    <h1 class="app-subform-title">Inscription</h1>
    <label for="name">Pseudo</label>
    <input type="text" id="name" placeholder="Super-Me" name="pseudo" value="">
    <label for="mail">E-mail</label>
    <input type="mail" id="mail" placeholder="eric.eric@gmail.com" name="email" value="">
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="pass" value="">
    <label for="password_confirm">Confirmation du mot de passe</label>
    <input type="password" id="password_confirm" name="pass_confirm" value="">
    <button class="app-loginform-button" type="submit" value="submit">Inscription</button>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>