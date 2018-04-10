<?

// Config
require 'config.php';


// Pages
isset($_GET['q']) ? $q = $_GET['q'] : $q = '';

  if($q === '' || $q === 'home'){
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
  else if($q === 'about'){
      $page = 'about';
  }
  else{
      $page = '404';
  }


  include 'views/pages/'.$page.'.php';
?>