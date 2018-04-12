<? session_start() ?>
<? require 'models/model.php'; ?>
<? $posts = new Posts ?>
<? $errorMessages = $posts->sendPost($pdo) ?>
<? $title = 'Mon annonce'; ?>
<? ob_start() ?>
  <? foreach($errorMessages as $messages): ?>
  <p class="app-logerror"><?= $messages ?></p>
  <? endforeach ?>
  <form class="app-postcreation" action="#" method="post">
    <h1 class="app-postcreation-title">Déposer une annonce</h1>
    <label for="category">Catégorie</label>
    <select id="category" name="category" value="">
      <option value="bricolage">Bricolage</option>
      <option value="bricolage">Jardinage</option>
      <option value="nettoyage">Nettoyage</option>
      <option value="nettoyage">Réparation technique</option>
      <option value="nettoyage">Garde</option>
    </select>
    <label class="app-postcreation-inputtitle" for="title">Titre d'annonce</label>
    <input type="text" id="title" name="title" value="<?= $_POST['title'] ?>" >
    <label for="description">Texte d'annonce</label>
    <textarea rows="10" type="text" id="description" name="description" value="<?= $_POST['description'] ?>"></textarea>
    <label for="location">Localisation</label>
    <input type="text" id="location" name="location" value="<?= $_POST['location'] ?>">
    <label for="date">Date et heure souhaitées</label>
    <input type="datetime-local" id="date" name="date" value="<?= $_POST['date'] ?>">
    <label for="name">Nom / Surnom</label>
    <input type="text" id="name" placeholder="Super-Me" name="name" value="<?= $_POST['name'] ?>">
    <label for="email">Email</label>
    <input type="text" id="email" placeholder="superme@me" name="email" value="<?= $_POST['email'] ?>">
    <label for="phone">Téléphone (facultatif)</label>
    <input type="text" id="phone" name="phone" value="<?= $_POST['phone'] ?>">
    <button class="app-postcreation-button" type="submit" value="submit">Poster</button>
    <small class="app-postcreation-indication">Chaque annonce est soumise à une validation avant d’être postée.</small>
  </form>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>