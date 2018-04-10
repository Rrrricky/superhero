<? session_start() ?>
<? require 'models/model.php'; ?>
<? $account = new Account(); ?>
<?= $account->connection($pdo); ?>
<? $title = 'Qui sommes-nous ?'; ?>
<? include 'views/partials/header.php'; ?>
<? ob_start() ?>
  <div class="app-about">
    <h1 class="app-about-title">Des super-héros du quotidien</h1>
    <div class="app-about-description">
      <p class="app-about-description__graph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque ab deleniti necessitatibus nulla perferendis ducimus ipsum. Qui minus unde iusto ratione voluptate enim libero perferendis aspernatur dolores commodi, officia saepe? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores iste et maxime, doloribus unde commodi, at officiis, ex eos mollitia quos? Dignissimos corrupti velit error ipsum repudiandae, in tempore nam.</p>
      <p class="app-about-description__graph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque ab deleniti necessitatibus nulla perferendis ducimus ipsum. Qui minus unde iusto ratione voluptate enim libero perferendis aspernatur dolores commodi, officia saepe? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores iste et maxime, doloribus unde commodi, at officiis, ex eos mollitia quos? Dignissimos corrupti velit error ipsum repudiandae, in tempore nam.</p>
    </div>
  </div>
<? $container = ob_get_clean() ?>
<? require 'templates/template.php'; ?>
<? require 'views/partials/footer.php'; ?>