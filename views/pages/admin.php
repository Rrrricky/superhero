<? session_start() ?>
<? require 'models/model.php'; ?>
<? $posts = new Posts() ?>
<? $get_unvalidate = $posts->get_unvalidate($pdo) ?>
<? $title = 'Gestion'; ?>
<? ob_start() ?>
<container class="app-admin">
  <h1 class="app-admin-title">Validation d'annonces</h1>
  <? for($i=0; $i<count($get_unvalidate); $i++): ?>
  <div class="app-admin-post">
    <div><span class="app-admin-post__data">Catégorie :</span> <?= $get_unvalidate[$i]->category ?></div>
    <div><span class="app-admin-post__data">Titre :</span> <?= $get_unvalidate[$i]->title ?></div>
    <div><span class="app-admin-post__data">Description : </span> <?= $get_unvalidate[$i]->description ?></div>
    <div><span class="app-admin-post__data">Location :</span> <?= $get_unvalidate[$i]->location ?></div>
    <div><span class="app-admin-post__data">Date :</span> <?= $get_unvalidate[$i]->date ?></div>
    <div><span class="app-admin-post__data">Nom :</span> <?= $get_unvalidate[$i]->name ?></div>
    <div><span class="app-admin-post__data">Email :</span> <?= $get_unvalidate[$i]->email ?></div>  
    <div><span class="app-admin-post__data">Téléphone :</span> <?= $get_unvalidate[$i]->phone ?></div>  
    <div class="app-admin-post__button"></div>
      <a href="validate_post?id=<?= $get_unvalidate[$i]->id ?>"><button class="app-admin-post__button-element">Valider</button></a>
      <a href="delete_post?id=<?= $get_unvalidate[$i]->id ?>"><button class="app-admin-post__button-element">Supprimer</button></a>
    </div>
  </div>
  <? endfor ?>
</container>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>