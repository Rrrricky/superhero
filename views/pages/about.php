<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<?= $account->connection($pdo); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? ob_start() ?>
  <div class="app-about">
    <h1 class="app-about-title">Des super-héros du <span class="app-about-title__colored">quotidien</span></h1>
    <div class="app-about-description">
      <p class="app-about-description__graph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque ab deleniti necessitatibus nulla perferendis ducimus ipsum. Qui minus unde iusto ratione voluptate enim libero perferendis aspernatur dolores commodi, officia saepe? Lorem ipsum dolor sit, amet consectetur. Ex eos mollitia quos? Dignissimos corrupti velit error ipsum repudiandae, in tempore nam.</p>
      <p class="app-about-description__graph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque ab deleniti necessitatibus nulla perferendis ducimus ipsum. Qui minus unde iusto ratione voluptate enim libero perferendis aspernatur dolores commodi, officia saepe? Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
      <a class="app-about-register" href="register">
        <p>Nous rejoindre</p>
        <span class="app-about-register__arrow">→</span>
      </a>
    </div>
      <img class="app-about-image" src="src/images/about.jpg" alt="washing">
  </div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>