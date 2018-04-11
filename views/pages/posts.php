<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Posts'; ?>
<? ob_start() ?>
  <main class="app-posts">
    <h1 class="app-posts-title">Annonces</h1>
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
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
    </div>
    <div class="app-posts-container">
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
    </div>
    <div class="app-posts-container">
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
      <div class="app-posts-container__post"></div>
    </div>
  <main>  
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>