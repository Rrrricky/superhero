<? session_start() ?>
<? $title = 'Merci'; ?>
<? ob_start() ?>
  <div class="app-registrated">
    <p>Merci pour votre annonce.</p>
    <p>Celle-ci sera visible une fois validée.</p>
  </div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>