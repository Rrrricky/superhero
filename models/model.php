<?

function connected($_pdo){
session_start(); // Useful to limit the access to some pages
if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
  echo 'Bonjour '.$_SESSION['pseudo'];
  // echo 'Bonjour '.$_COOKIE['pseudo'];
}

//1. Get username and his status from table users and groups
//2. Create an inner join between: id_group from table 'users' and id from table 'groups'
$query = $_pdo->query('SELECT u.pseudo AS user_pseudo, g.status AS user_status  
                      FROM users AS u INNER JOIN groups AS g
                      ON u.id_group = g.id'
                    );

$result = $query->fetchAll();
}




function connection($_pdo){
  if(!empty($_POST)){
  
    $pseudo = $_POST['pseudo'];
  
    $query = $_pdo->query('SELECT id, pseudo, pass FROM users WHERE pseudo = "'.$pseudo.'"'); //Get the id and password 
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
}




function disconnection(){
  session_start(); // Give the user a session number 

  // Remove session
  $_SESSION = [];
  session_destroy();
  
  // Remove autolog cookies
  setcookie('login', '');
  setcookie('pass_hache', '');
  
  echo 'Disconnected';
}







function inscription($_pdo){
  // Check information
  if(!empty($_POST)){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Password hashing

  // Insert request
  $prepare = $_pdo->prepare('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
                            VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');

  $prepare->bindValue(':pseudo', $pseudo);
  $prepare->bindValue(':id_group', 2);
  $prepare->bindValue(':email', $email);
  $prepare->bindValue(':pass', $pass_hache);

  $execute=$prepare->execute();

  echo 'Registered';
  } 
}