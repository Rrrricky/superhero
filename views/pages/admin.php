<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Gestion'; ?>
<? ob_start() ?>

<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>