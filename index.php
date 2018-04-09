<?

// Config
require 'config.php';

isset($_GET['q']) ? $q = $_GET['q'] : $q = '';

  if($q === ''){
      $page = 'home';
  }
  else if($q === 'register'){
      $page = 'register';
  }
  else if($q === 'login'){
      $page = 'login';
  }
  else if($q === 'logout'){
      $page = 'logout';
  }
  else{
      $page = '404';
  }

  // Includes
  include 'views/partials/header.php';
  include 'views/pages/'.$page.'.php';
  include 'views/partials/footer.php';

?>