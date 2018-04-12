<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<?= $account->connection($pdo); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? ob_start() ?>
  <div class="app-about">
    <h1 class="app-about-title">Des super-héros du <span class="app-about-title__colored">quotidien</span></h1>
    <div class="app-about-description">
      <p class="app-about-description__graph"><strong>Hero Up</strong> est né en 2018, grâce à une équipe de 5 jeunes étudiants désireux de révolutionner l'entraide au quotidien. Armés de leurs super pouvoirs de codeurs et designeurs, ils vous proposent désormais une première version de leur site internet. Jardinage chez le voisin, bricolage dans le quartier, réparation en tout genre,... Des centaines de missions peuvent être effectuées chaque jour <strong>GRATUITEMENT</strong> !</p>
      <p class="app-about-description__graph">Vous aussi devenez un super-héros du quotidien ou demander l'aide d'un super-héros. N'attendez plus, inscrivez-vous !</p>
      <? if(empty($_SESSION['pseudo'])): ?>
      <a class="app-about-register" href="register">
        <p>Nous rejoindre</p>
        <span class="app-about-register__arrow">→</span>
      </a>
      <? endif ?>
    </div>
      <img class="app-about-image" src="src/images/about.jpg" alt="washing">
  </div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>