<?
// Check information
if(!empty($_POST)){
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $email = htmlspecialchars($_POST['email']);
  $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Password hashing

// Insert request
$prepare = $pdo->prepare('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
                          VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');

$prepare->bindValue(':pseudo', $pseudo);
$prepare->bindValue(':id_group', 2);
$prepare->bindValue(':email', $email);
$prepare->bindValue(':pass', $pass_hache);

$execute=$prepare->execute();

echo 'Registered';
}