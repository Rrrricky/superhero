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
      $_POST['pass'] = htmlspecialchars($_POST['pass']);

      if(empty($pseudo)){
        $errorMessages[] = 'Missing username';
      }
      if(empty($email)){
        $errorMessages[] = 'Missing email';
      }
      if(empty($_POST['pass'])){
        $errorMessages[] = 'Missing password';
      }
      if(empty($_POST['pass_confirm'])){
        $errorMessages[] = 'Missing verification password';
      }
      if($_POST['pass'] != $_POST['pass_confirm']){
        $errorMessages[] = 'Different passwords';
      }
      if(strlen($pseudo)<2){
        $errorMessages[] = 'Min two chars for the username';
      }
      if(strlen($pseudo)>16){
        $errorMessages[] = 'Max 16 chars for the username';
      }
      if(strlen($_POST['pass'])<5){
        $errorMessages[] = 'Min 5 chars for the password';
      }
      if(strpos($email, '@') != true){
        $errorMessages[] = 'Need a valid email';
      }

      // Check if the username is already taken
      $sql = ('SELECT pseudo FROM users WHERE pseudo = "'.$pseudo.'"');
      $result = $this->query_request($sql, $_pdo);

      if(!empty($result)){
        $errorMessages[] = 'Username already taken';
      }

      // If there is no error
      if(empty($errorMessages)){

        // Password hashing
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT); 

        // Insert request
        $sql = ('INSERT INTO users (pseudo, id_group, email, pass, date_inscription) 
                VALUES (:pseudo, :id_group, :email, :pass, CURDATE())');
        
        $prepare = $this->prepare_request($sql, $_pdo);
        
        $prepare->bindValue(':pseudo', $pseudo);
        $prepare->bindValue(':id_group', 2); // The user will be member, not an admin
        $prepare->bindValue(':email', $email);
        $prepare->bindValue(':pass', $pass_hache);

        $execute = $prepare->execute();

        function callMailer($_pseudo, $_email){
          $actions = new Actions();
          $mail = $actions->mailer($_pseudo, $_email); //Trigger the mailer function of the other class
          echo $mail;
        }
        callMailer($pseudo, $email);
        $errorMessages[] = '';
      }
    }
    $errorMessages[] = '';
    return $errorMessages;
  }
}




class Actions{
  
  public function mailer($_pseudo, $_email){
    $mail = $_email; // Destination
    $jump = '\n';
    
    //Text messages and HTML messages
    $message_txt = 'Bienvenue '.$_name.' !';
    $message_html = '<html><head></head><body>Bienvenue '.$_name.' !</body></html>';
    
    //Boundary
    $boundary = '-----='.md5(rand());
    
    //Subject
    $subject = 'Confirmation d\'inscription';

    
    //Email header
    $header = 'From: \"Eric\"<eric.dufreche@hetic.net>'.$jump;
    $header.= 'Reply-to: \"Eric\" <eric.dufreche@hetic.net>'.$jump;
    $header.= 'MIME-Version: 1.0'.$jump;
    $header.= 'Content-Type: multipart/alternative;'.$jump.' boundary=\"$boundary\"'.$jump;
    
    //Creation of the message
    $message = $jump.'--'.$boundary.$jump;

    //Text format
    $message.= 'Content-Type: text/plain; charset=\"ISO-8859-1\"'.$jump;
    $message.= 'Content-Transfer-Encoding: 8bit'.$jump;
    $message.= $jump.$message_txt.$jump;

    $message.= $jump.'--'.$boundary.$jump;

    //HTML format
    $message.= 'Content-Type: text/html; charset=\"ISO-8859-1\"'.$jump;
    $message.= 'Content-Transfer-Encoding: 8bit'.$jump;
    $message.= $jump.$message_html.$jump;

    $message.= $jump.'--'.$boundary.'--'.$jump;
    $message.= $jump.'--'.$boundary.'--'.$jump;

    //Sending e-mail
    mail($mail, $subject, $message, $header);
  }
}