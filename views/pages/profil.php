<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<?= $account->connection($pdo); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? include 'views/partials/header.php'; ?>
<? ob_start() ?>
  <div>Hello <?= isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '' ?></div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>