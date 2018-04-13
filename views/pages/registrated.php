<? session_start() ?>
<? $title = 'Merci'; ?>
<? ob_start() ?>
<!-- If the user is not connected -->
<? if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])): ?>
  <div class="app-registrated">
    <p>Merci pour votre inscription.</p>
    <p>Un email vient de vous être envoyé, vous pouvez dès maintenant vous connecter.</p>
  </div>
<!-- If the user is connected -->
<? else: ?>
<? header('Location: 404'); ?>
<? endif ?>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>