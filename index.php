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

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>E19 - P2021</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta property="og:image" content="/og-image.jpg">
  <meta property="og:image:width" content="1145">
  <meta property="og:image:height" content="599">
  <meta property="og:title" content="E19 - P2021">
  <meta property="og:description" content="Super-heroes">
  <link rel="apple-touch-icon" sizes="180x180" href="src/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="src/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="src/favicons/favicon-16x16.png">
  <link rel="manifest" href="src/favicons/site.webmanifest">
  <link rel="mask-icon" href="src/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="styles/reset.css"/>
  <link rel="stylesheet" href="styles/main.css"/>
  <script src="src/lottie.js"></script>
</head>
<body>
  <?
    // Includes
    include 'views/partials/header.php';
    include 'views/pages/'.$page.'.php';
    include 'views/partials/footer.php';
  ?>
  <div class="loader-container">
    <div id="loader"></div>
  </div>
  <h1></h1>
  <script src="src/loader.js"></script>
  <script src="src/scripts/FirstClass.js"></script>
  <script src="src/scripts/main.js"></script>
</body>
</html>