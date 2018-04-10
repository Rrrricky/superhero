<? $title = 'Error'; ?>
<? require 'views/partials/header.php'; ?>
<? ob_start() ?>
  <p>Couldn't connect to the database.</p>
<? $container = ob_get_clean() ?> 
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>