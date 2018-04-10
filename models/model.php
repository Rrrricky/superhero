<?

abstract class Model{
  protected function query_request($sql, $_pdo){ // For query request
      $query = $_pdo->query($sql);
      $result = $query->fetchAll();
      return $result;
    }
  protected function prepare_request($sql, $_pdo){ // For prepare request
      $prepare = $_pdo->prepare($sql);
      return $prepare;
  }
}





class Account extends Model{




  public function connected($_pdo){
    // session_start(); // Useful to limit the access to some pages
    //1. Get username and his status from table users and groups
    //2. Create an inner join between: id_group from table 'users' and id from table 'groups'
    // $query = $_pdo->query
    $sql = ('SELECT u.pseudo AS user_pseudo, g.status AS user_status  
             FROM users AS u INNER JOIN groups AS g
             ON u.id_group = g.id'
           );
    $result = $this->query_request($sql, $_pdo);
  }







  public function connection($_pdo){

    if(!empty($_POST)){ // If data sended by the form
    
      $pseudo = $_POST['pseudo']; 
    
      $sql = ('SELECT id, pseudo, pass FROM users WHERE pseudo = "'.$pseudo.'"'); // Get the id and password 
      $result = $this->query_request($sql, $_pdo);


      if(empty($pseudo)){ // Missing username
        $errorMessages[]='Missing username';
      }
      if(empty($_POST['pass'])){ // Missing password
        $errorMessages[]='Missing password';
      }
      
      if(empty($errorMessages)){ // If nothing is missing
        $pass = $_POST['pass']; 
        if(!$result){ // Check if the username exists in the database
          $errorMessages[] = 'Wrong username or password!';
          return $errorMessages;
        }else{ // If the username exists
          $isPasswordCorrect = password_verify($pass, $result[0]->pass); // Compare password used with the hash in the database
        }
    
      
        if($isPasswordCorrect){ // If the username and password match
          session_start(); // Give the user a session number 
          $_SESSION['id'] = $result[0]->id;
          $_SESSION['pseudo'] = $result[0]->pseudo;
          header('Location: profil');
        }
        else{
          $errorMessages[] = 'Wrong username or password!'; // Incorrect username or password
          return $errorMessages;
        }
      }
      $errorMessages[] = '';
      return $errorMessages;
    }
  }







  public function disconnection(){
    session_start(); // Give the user a session number 

    // Remove session
    $_SESSION = [];
    session_destroy();
  }




  
  
  public function inscription($_pdo){
    // Check information
    if(!empty($_POST)){
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $email = htmlspecialchars($_POST['email']);
      $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Password hashing

      // Insert request
      $sql = ('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
               VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');
      
      $prepare = $this->prepare_request($sql, $_pdo);
      
      $prepare->bindValue(':pseudo', $pseudo);
      $prepare->bindValue(':id_group', 2); // The user will be member, not an admin
      $prepare->bindValue(':email', $email);
      $prepare->bindValue(':pass', $pass_hache);

      $execute = $prepare->execute();
    }
  }
}











// <?

// class Account{

//   public function connected($_pdo){
//     session_start(); // Useful to limit the access to some pages
//     if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
//       echo 'Bonjour '.$_SESSION['pseudo'];
//       // echo 'Bonjour '.$_COOKIE['pseudo'];
//     }
//     //1. Get username and his status from table users and groups
//     //2. Create an inner join between: id_group from table 'users' and id from table 'groups'
//     $query = $_pdo->query('SELECT u.pseudo AS user_pseudo, g.status AS user_status  
//                           FROM users AS u INNER JOIN groups AS g
//                           ON u.id_group = g.id'
//                         );
//     $result = $query->fetchAll();
//   }


//   public function connection($_pdo){
//     if(!empty($_POST)){
    
//       $pseudo = $_POST['pseudo'];
    
//       $query = $_pdo->query('SELECT id, pseudo, pass FROM users WHERE pseudo = "'.$pseudo.'"'); //Get the id and password 
//       $result = $query->fetchAll();
    
//       $isPasswordCorrect = password_verify($_POST['pass'], $result[0]->pass); // Compare password used with the hash in the database
    
//       if(!$result){
//         echo 'Wrong username or password!';
//       }
    
//       if($isPasswordCorrect){
//         session_start(); // Give the user a session number 
//         $_SESSION['id'] = $result[0]->id;
//         $_SESSION['pseudo'] = $result[0]->pseudo;
        
//         setcookie('pseudo', $result[0]->pseudo, time() + 10, null, null, false, true); // httpOnly option to avoid XSS breach
//         setcookie('id', $result[0]->id, time() + 10, null, null, false, true);
    
//         echo 'You\'re connected!';
//       }
//       else{
//         echo 'Wrong username or password!';
//       }
//     }
//   }


//   public function disconnection(){
//     session_start(); // Give the user a session number 

//     // Remove session
//     $_SESSION = [];
//     session_destroy();
    
//     // Remove autolog cookies
//     setcookie('login', '');
//     setcookie('pass_hache', '');
    
//     echo 'Disconnected';
//   }


//   public function inscription($_pdo){
//     // Check information
//     if(!empty($_POST)){
//       $pseudo = htmlspecialchars($_POST['pseudo']);
//       $email = htmlspecialchars($_POST['email']);
//       $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Password hashing

//       // Insert request
//       $prepare = $_pdo->prepare('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
//                                 VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');

//       $prepare->bindValue(':pseudo', $pseudo);
//       $prepare->bindValue(':id_group', 2);
//       $prepare->bindValue(':email', $email);
//       $prepare->bindValue(':pass', $pass_hache);

//       $execute=$prepare->execute();

//       echo 'Registered';
//     } 
//   }
// }