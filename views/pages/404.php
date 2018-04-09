<? $title = '404'; ?>
<? ob_start() ?>
  <container class="unfindable-container">
    <div class="unfindable">404</div>
    <div class="page">Can't find the page</div>
  </container>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>