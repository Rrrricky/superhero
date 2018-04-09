<?

session_start(); // Useful to limit the access to some pages
if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
  echo 'Bonjour '.$_SESSION['pseudo'];
  // echo 'Bonjour '.$_COOKIE['pseudo'];
}



//1. Get username and his status from table users and groups
//2. Create an inner join between:
     // id_group from table 'users' 
     // and id from table 'groups'
$query = $pdo->query('SELECT u.pseudo AS user_pseudo, g.status AS user_status  
                      FROM users AS u INNER JOIN groups AS g
                      ON u.id_group = g.id'
                    );

$result = $query->fetchAll();


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
  <div class="loader-container">
    <div id="loader"></div>
  </div>
  <h1></h1>
  <script src="src/loader.js"></script>
  <script src="src/scripts/FirstClass.js"></script>
  <script src="src/scripts/main.js"></script>
</body>
</html>