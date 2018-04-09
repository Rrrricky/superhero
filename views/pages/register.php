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