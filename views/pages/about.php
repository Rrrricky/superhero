<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? include 'views/partials/header.php'; ?>
<? ob_start() ?>
  <div>Hello</div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>