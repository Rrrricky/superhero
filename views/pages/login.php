<? require 'models/model.php'; ?>
<? $account = new Account ?>
<?= $account->connection($pdo); ?>
<? $title = 'Login'; ?>
<? require 'views/partials/header.php'; ?>
<? ob_start() ?>
  <form class="app-loginform" action="#" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <button type="submit" value="submit">Send</button>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>