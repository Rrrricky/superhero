<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account; ?>
<? $errorMessages[] = $account->inscription($pdo) ?>
<? $title = 'Register' ?>
<? ob_start() ?>
  <? foreach($errorMessages as $messages): ?>
    <p class="app-register-error"><?= $messages ?></p>
  <? endforeach ?>
  <form class="app-subform" action="#" method="post">
    <h1 class="app-subform-title">S'inscrire</h1>
    <label for="name">Pseudo</label>
    <input type="text" id="name" placeholder="Super-Me" name="pseudo" value="">
    <label for="mail">E-mail</label>
    <input type="mail" id="mail" placeholder="eric.eric@gmail.com" name="email" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <label for="password_confirm">Password confirmation</label>
    <input type="password" id="password_confirm" name="pass_confirm" value="">
    <button class="app-loginform-button" type="submit" value="submit">Inscription</button>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>