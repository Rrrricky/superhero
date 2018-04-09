<?

if(!empty($_POST)){

  $pseudo = $_POST['pseudo'];

  $query = $pdo->query('SELECT id, pass FROM users WHERE pseudo = "'.$pseudo.'"'); //Get the id and password 
  $result = $query->fetchAll();

  $isPasswordCorrect = password_verify($_POST['pass'], $result[0]->pass); // Compare password used with the hash in the database

  if(!$result){
    echo 'Wrong username or password!';
  }
  if($isPasswordCorrect) {
    session_start();
    $_SESSION['id'] = $result[0]->id;
    $_SESSION['pseudo'] = $result[0]->pseudo;
    echo 'You\'re connected!';
  }
  else{
    echo 'Wrong username or password!';
  }
}

?>

<form action="#" method="post">
  <label for="pseudo">Pseudo</label>
  <input type="text" id="pseudo" name="pseudo" value="">
  <label for="password">Password</label>
  <input type="password" id="password" name="pass" value="">
  <button type="submit" value="submit">Send</button>
</form>