<?php 
// Check information
if(!empty($_POST)){
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Password hashing

// Insert request
$prepare = $pdo->prepare('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
                          VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');

$prepare->bindValue(':pseudo', $pseudo);
$prepare->bindValue(':id_group', 2);
$prepare->bindValue(':email', $email);
$prepare->bindValue(':pass', $pass_hache);

$execute=$prepare->execute();

echo '<pre>';
print_r($execute);
echo '</pre>';

echo 'Registered';
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
    <label for="name">Pseudo</label>
    <input type="text" id="name" placeholder="Super-Me" name="pseudo" value="">
    <label for="mail">E-mail</label>
    <input type="mail" id="mail" placeholder="eric.eric@gmail.com" name="email" value="">
    <label for="password">Password</label>
    <input type="password" id="password" name="pass" value="">
    <label for="password_confirm">Password confirmation</label>
    <input type="password" id="password_confirm" name="pass_confirm" value="">
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
