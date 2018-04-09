<?

if(!empty($_POST)){

  $pseudo = $_POST['pseudo'];

  $query = $pdo->query('SELECT id, pseudo, pass FROM users WHERE pseudo = "'.$pseudo.'"'); //Get the id and password 
  $result = $query->fetchAll();

  $isPasswordCorrect = password_verify($_POST['pass'], $result[0]->pass); // Compare password used with the hash in the database

  if(!$result){
    echo 'Wrong username or password!';
  }

  if($isPasswordCorrect){
    session_start(); // Give the user a session number 
    $_SESSION['id'] = $result[0]->id;
    $_SESSION['pseudo'] = $result[0]->pseudo;
    
    setcookie('pseudo', $result[0]->pseudo, time() + 10, null, null, false, true); // httpOnly option to avoid XSS breach
    setcookie('id', $result[0]->id, time() + 10, null, null, false, true);

    echo 'You\'re connected!';
  }
  else{
    echo 'Wrong username or password!';
  }
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
  <form action="#" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <button type="submit" value="submit">Send</button>
  </form>
  <div class="loader-container">
    <div id="loader"></div>
  </div>
  <h1></h1>
  <script src="src/loader.js"></script>
  <script src="src/scripts/FirstClass.js"></script>
  <script src="src/scripts/main.js"></script>
</body>
</html>