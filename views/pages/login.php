<? require 'models/model.php'; ?>
<? $account = new Account ?>
<?= $account->connection($pdo); ?>
<? $title = 'Login'; ?>
<? ob_start() ?>
  <form action="#" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <button type="submit" value="submit">Send</button>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>