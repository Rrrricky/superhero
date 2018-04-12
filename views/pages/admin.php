<? session_start() ?>
<? require 'models/model.php'; ?>
<? $posts = new Posts() ?>
<? $get_unvalidate = $posts->get_unvalidate($pdo) ?>
<? $title = 'Gestion'; ?>
<? ob_start() ?>
<container class="app-admin">
  <h1 class="app-admin-title">Déposer une annonce</h1>
  <? for($i=0; $i<count($get_unvalidate); $i++): ?>
  <div class="app-admin-post">
    <div><span class="app-admin-post__data">Catégorie:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Titre:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Description:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Location:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Date:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Nom:</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Email:</span> <?= $get_unvalidate[$i]->title ?></div>  
    <div><span class="app-admin-post__data">Téléphone:</span> <?= $get_unvalidate[$i]->title ?></div>  
    <div class="app-admin-post__button"></div>
      <a class="app-admin-post__button-element" href=""><button>Valider</button></a>
      <a class="app-admin-post__button-element" href="<? $delete = $posts->delete() ?>"><button>Supprimer</button></a>
    </div>
  </div>
  <? endfor ?>
</container>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>