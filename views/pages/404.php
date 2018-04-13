<? session_start() ?>
<? $title = '404'; ?>
<? ob_start() ?>
  <container class="app-unfindable">
    <div class="app-unfindable__404">404</div>
    <div class="app-unfindable__page">Can't find the page</div>
  </container>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>