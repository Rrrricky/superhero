<? require 'models/model.php'; ?>
<? $account = new Account; ?>
<?= $account->inscription($pdo) ?>
<? $title = 'Register' ?>
<? require 'views/partials/header.php'; ?>
<? ob_start() ?>
  <form action="#" method="post">
    <label for="name">Pseudo</label>
    <input type="text" id="name" placeholder="Super-Me" name="pseudo" value="">
    <label for="mail">E-mail</label>
    <input type="mail" id="mail" placeholder="eric.eric@gmail.com" name="email" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <label for="password_confirm">Password confirmation</label>
    <input type="password" id="password_confirm" name="pass_confirm" value="">
    <button type="submit" value="submit">Send</button>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>