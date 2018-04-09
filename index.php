<?

// Config
include 'config.php';


// Routing
//$query = $pdo->query('SELECT id FROM articles');
//$ids = $query->fetchAll(); // Get every id

$array_ids = [];

// foreach($ids as $_ids):
//   array_push($array_ids, $_ids->id); // Put every id in an array
// endforeach;

isset($_GET['q']) ? $q = $_GET['q'] : $q = '';
// isset($_GET['id']) ? $id = $_GET['id'] : $id = '';

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
  // else if(in_array($id, $array_ids)){ // Check if the id exists in the array
  //     $page = 'article';
  // }
  else{
      $page = '404';
  }

  // Includes
  include 'views/partials/header.php';
  include 'views/pages/'.$page.'.php';
  include 'views/partials/footer.php';

?>