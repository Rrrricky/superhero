<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Posts'; ?>
<? $posts = new Posts() ?>
<? $getPost = $posts->get_validate_post($pdo, $_GET['id']) ?>
<? ob_start() ?>
  <main class="app-post">
    <div class="app-post-container">
      <div class="app-post-container-content">
        <div class="app-post-container-content__category"><?= $getPost[0]->category ?></div>
        <div class="app-post-container-content__title"><?= $getPost[0]->title ?></div>
        <div class="app-post-container-content__location">Lieu : <?= $getPost[0]->location ?></div>
        <div class="app-post-container-content__date">Heure souhaitée : <?= date("d/m/Y", strtotime($getPost[0]->date)) ?> à <?= date("h:m", strtotime($getPost[0]->date)) ?></div>
        <div class="app-post-container-content__description"><?= $getPost[0]->description ?></div>
        <div class="app-post-container-content__name"><?= $getPost[0]->name ?></div>
        <div class="app-post-container-content-contact">
          <h3>Contact</h3>
          <div class="app-post-container-content-contact__email"><?= $getPost[0]->email ?></div>
          <div class="app-post-container-content-contact__phone"><?= $getPost[0]->phone ?></div>
        </div>
        <div class="app-post-container-content__date_creation">Date de publication : <?= date("d/m/Y", strtotime($getPost[0]->date_creation)) ?></div>
      </div>
    </div>
  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>