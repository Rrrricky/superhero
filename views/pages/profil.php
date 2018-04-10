<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<? $errorMessages[]=''; ?>
<?= $account->connection($pdo, $errorMessages); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? ob_start() ?>
  <div>Hello <?= isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '' ?></div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>