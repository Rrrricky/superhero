<? session_start() ?>
<? require 'models/model.php'; ?>
<? $title = 'Mon annonce'; ?>
<? ob_start() ?>
  <form class="app-postcreation" action="#" method="post">
    <h1 class="app-postcreation-title">Déposer une annonce</h1>
    <label for="category">Catégorie</label>
    <select id="category" name="category" value="">
      <option value="bricolage">Bricolage</option>
      <option value="bricolage">Jardinage</option>
      <option value="nettoyage">Nettoyage</option>
    </select>
    <label class="app-postcreation-inputtitle" for="title">Titre d'annonce</label>
    <input type="text" id="title" name="pass" value="">
    <label for="description">Texte d'annonce</label>
    <input type="text" id="description" name="description" value="">
    <label for="localisation">Localisation</label>
    <input type="text" id="localisation" name="localisation" value="">
    <label for="name">Nom / Surnom</label>
    <input type="text" id="name" placeholder="Super-Me" name="name" value="">
    <label for="email">Email</label>
    <input type="text" id="email" placeholder="superme@me" name="email" value="">
    <label for="phone">Téléphone (facultatif)</label>
    <input type="text" id="phone" name="phone" value="">
    <button class="app-postcreation-button" type="submit" value="submit">Poster</button>
    <small class="app-postcreation-indication">Chaque annonce est soumise à une validation avant d’être postée.</small>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>