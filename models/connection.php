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