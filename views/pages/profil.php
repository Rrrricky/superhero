<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Profil'; ?>
<? ob_start() ?>
  <div>Hello <?= isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '' ?></div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>