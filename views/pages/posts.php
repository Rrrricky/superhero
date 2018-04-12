<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Posts'; ?>
<? $posts = new Posts() ?>
<? $getPosts = $posts->getPosts($pdo) ?>
<? ob_start() ?>
  <main class="app-posts">
    <h1 class="app-posts-title">Annonces</h1>
    <? if(!empty($_SESSION['pseudo'])): ?>
    <a class="app-posts-create" href="create">
      <span>✚ Poster une annonce</span>
    </a>
    <? else: ?>
    <a class="app-posts-create" href="login">
      <span>✚ Me connecter pour poster une annonce</span>
    </a>
    <? endif ?>
    <div class="app-posts__filter">
      <label class="app-posts__filter__label" for="filter">
        <span>Filtres</span>
        <span class="app-posts__filter__arrow">▾</span>
      </label>
      <select class="app-posts__filter__select" name="filter" id="filter">
        <option class="app-posts__filter__select__option" value="recent">Récents</option>
        <option class="app-posts__filter__select__option" value="olds">Anciens</option>
      </select>
    </div>
    <div class="app-posts-container">
    <? for($i=0; $i<count($getPosts); $i++): ?>
      <div class="app-posts-container__post">
        <div class="app-posts-container__post__visual">
          <img src="" alt="category-pic">
        </div>
        <div class="app-posts-container__post__text">
          <div class="app-posts-container__post__text__category"><?= $getPosts[$i]->category; ?></div>
          <div class="app-posts-container__post__text__subject">
            <span class="app-posts-container__post__text__subject-title"><?= $getPosts[$i]->title; ?></span>
            <span class="app-posts-container__post__text__subject-location">- <?= $getPosts[$i]->location; ?></span>
          </div>
          <div class="app-posts-container__post__text__availability"><?= $getPosts[$i]->date; ?></div>
          <div class="app-posts-container__post__text__creation"><?= $getPosts[$i]->date_creation; ?></div>
          <a class="app-posts-container__post__text-button" href="#">
            <button>Secourir</button>
          </a>
        </div>
      </div>
    <? endfor ?>
    </div>
    <!-- <div class="app-posts-container">
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
    </div>
    <div class="app-posts-container">
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
    </div> -->
  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>