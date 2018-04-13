<? session_start() ?>
<? $title = 'Merci'; ?>
<? ob_start() ?>
<!-- If there is a session (user connected) -->
<? if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])): ?>
  <div class="app-registrated">
    <p>Merci pour votre annonce.</p>
    <p>Celle-ci sera visible une fois validée.</p>
  </div>
<!-- If there is no session (user unconnected) -->
<? else: ?>
  <? header('Location: 404'); ?>
<? endif ?>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>