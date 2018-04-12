<?

// Config
require 'config.php';


// Pages
isset($_GET['q']) ? $q = $_GET['q'] : $q = '';
isset($_GET['id']) ? $id = $_GET['id'] : $id = '';


$sql = 'SELECT id FROM posts_tovalidate';
$query = $pdo->query($sql);
$ids = $query->fetchAll();

$array_ids = [];

// Put every id in an array
foreach($ids as $_ids):
  array_push($array_ids, $_ids->id); 
endforeach;


  if($q === '' || $q === 'home'){
      $page = 'home';
  }
  else if($q === 'register'){
      $page = 'register';
  }
  else if($q === 'registrated'){
      $page = 'registrated';
  }
  else if($q === 'login'){
      $page = 'login';
  }
  else if($q === 'logout'){
      $page = 'logout';
      header('Location: home');
  }
  else if($q === 'about'){
      $page = 'about';
  }
  else if($q === 'posts'){
      $page = 'posts';
  }
  else if($q === 'profil'){
      $page = 'profil';
  }
  else if($q === 'create'){
      $page = 'create';
  }
  else if($q === 'post_sended'){
      $page = 'post_sended';
  }
  else if($q === 'admin'){
      $page = 'admin';
  }
  else if($q === 'delete_post' AND in_array($id, $array_ids)){
    $page = 'delete_post';
    header('Location: admin');
  }
  else if($q === 'validate_post' AND in_array($id, $array_ids)){
    $page = 'validate_post';
    header('Location: admin');
  }
  else{
    $page = '404';
  }


  include 'views/pages/'.$page.'.php';
?>