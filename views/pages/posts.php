<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Profil'; ?>
<? ob_start() ?>
  <main class="app-posts">
    <div class="app-posts-bloc"></div>
  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>