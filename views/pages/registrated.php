<? session_start() ?>
<? $title = 'Merci'; ?>
<? ob_start() ?>
  <div class="app-registrated">
    <p>Merci pour votre inscription.</p>
    <p>Un email vient de vous être envoyé, vous pouvez dès maintenant vous connecter.</p>
  </div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>