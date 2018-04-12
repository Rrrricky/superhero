<?

/** About general sql queries */
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




/** About account pages */
class Account extends Model{

  public function connected($_pdo){

    // 1. Get username and his status from table users and groups
    // 2. Create an inner join between: id_group from table 'users' and id from table 'groups'
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
    
      $sql = ('SELECT id, id_group, pseudo, pass, date_inscription, picture_name, picture_type FROM users WHERE pseudo = "'.$pseudo.'"'); // Get the id and password 
      $result = $this->query_request($sql, $_pdo);


      // Check errors
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
          $_SESSION['id_group'] = $result[0]->id_group;
          $_SESSION['pseudo'] = $result[0]->pseudo;
          $_SESSION['inscription'] = $result[0]->date_inscription;
          $_SESSION['picture_name'] = $result[0]->picture_name;
          $_SESSION['picture_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_SESSION['picture_name']); //Picture name without extension
          if($result[0]->picture_name != NULL){
            $result[0]->picture_type = trim(explode('/', $result[0]->picture_type)[1]); //To only get the extension
            $_SESSION['picture_type'] = $result[0]->picture_type;
          }
          header('Location: posts');
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

    session_start();

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

      // Check errors 
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

        $_POST['pseudo']='';
        $_POST['email']='';
        $_POST['pass']='';
        $_POST['pass_confirm']='';      

        function callMailer($_pseudo, $_email){
          $actions = new Actions();
          $mail = $actions->mailer($_pseudo, $_email); // Trigger the mailer function of the other class
        }
        callMailer($pseudo, $email);
        header('Location: registrated');
        $errorMessages[] = '';
      }
    }else{

    $_POST['pseudo']='';
    $_POST['email']='';
    $_POST['pass']='';
    $_POST['pass_confirm']='';

    $errorMessages[] = '';
    return $errorMessages;
    }
    $errorMessages[] = '';
    return $errorMessages;
  }
}



/** About secondary actions */
class Actions extends Model{
  
  // Mail to confirm the registration
  public function mailer($_pseudo, $_email){
    $mail = $_email; // Destination
    $jump = '\n';
    
    // Text messages and HTML messages
    $message_txt = 'Bienvenue '.$_pseudo.' !';
    $message_html = '<html><head></head><body>Bienvenue '.$_pseudo.' !</body></html>';
    
    // Boundary
    $boundary = '-----='.md5(rand());
    
    // Subject
    $subject = 'Confirmation d\'inscription';

    
    // Email header
    $header = 'From: \"Eric\"<eric.dufreche@hetic.net>'.$jump;
    $header.= 'Reply-to: \"Eric\" <eric.dufreche@hetic.net>'.$jump;
    $header.= 'MIME-Version: 1.0'.$jump;
    $header.= 'Content-Type: multipart/alternative;'.$jump.' boundary=\"$boundary\"'.$jump;
    
    // Creation of the message
    $message = $jump.'--'.$boundary.$jump;

    // Text format
    $message.= 'Content-Type: text/plain; charset=\"ISO-8859-1\"'.$jump;
    $message.= 'Content-Transfer-Encoding: 8bit'.$jump;
    $message.= $jump.$message_txt.$jump;

    $message.= $jump.'--'.$boundary.$jump;

    // HTML format
    $message.= 'Content-Type: text/html; charset=\"ISO-8859-1\"'.$jump;
    $message.= 'Content-Transfer-Encoding: 8bit'.$jump;
    $message.= $jump.$message_html.$jump;

    $message.= $jump.'--'.$boundary.'--'.$jump;
    $message.= $jump.'--'.$boundary.'--'.$jump;

    // Sending e-mail
    mail($mail, $subject, $message, $header);
  }

  public function getId($_pdo){
    $sql = 'SELECT id FROM posts_tovalidate';
    $query = $this->query_request($sql, $_pdo);
  }
}



/** About the profil page */
class Profil extends Model{

  public function transfer_picture($_pdo){
    
    // Set variables
    if(!empty($_FILES)){
      $upload   = false;
      $pic_blob = '';
      $pic_size = 0;
      $pic_type = '';
      $size_max = 1000000;
      $upload   = is_uploaded_file($_FILES['profil']['tmp_name']);

      if(empty($_FILES['profil']['name'])){
        $errorMessages[] = 'Empty';
        return $errorMessages;
      }

  

      // Check corrupted file
      if (!isset($_FILES['profil']) AND $_FILES['profil']['error'] != 0){ 
        $errorMessages[] = "Problème de transfert";
        return $errorMessages;
      }

      // Check size
      if($_FILES['profil']['size'] > $size_max){ 
        $errorMessages[] = "Fichier trop lourd, 1 Mo max.";
        return $errorMessages;
      }

      // Check extension
      $data_file = pathinfo($_FILES['profil']['name']);
      $extension_upload = $data_file['extension'];
      $extensions_allowed = ['jpg', 'jpeg', 'gif', 'png'];

      if (in_array($extension_upload, $extensions_allowed)){
        $picture_name = $_FILES['profil']['name'];
        $picture_size = $_FILES['profil']['size'];
        $picture_type = $_FILES['profil']['type'];
        $picture_content = file_get_contents($_FILES['profil']['tmp_name']);
 

   
        move_uploaded_file($_FILES['profil']['tmp_name'], 'uploads/' . basename($picture_name));

        // Regex for correct syntax
        $picture_name = strtr($picture_name,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $picture_name = preg_replace('/([^.a-z0-9]+)/i', '-', $picture_name);
        

        // Upadte the user picture
        $sql = ('UPDATE users SET picture = :picture, picture_name = :picture_name, picture_size = :picture_size, picture_type = :picture_type WHERE pseudo = "'.$_SESSION["pseudo"].'"');

        $prepare = $this->prepare_request($sql, $_pdo);
        
        $prepare->bindValue(':picture', addslashes($picture_content)); 
        $prepare->bindValue(':picture_name', $picture_name); 
        $prepare->bindValue(':picture_size', $picture_size); 
        $prepare->bindValue(':picture_type', $picture_type);

        $execute = $prepare->execute();

        $sql = ('SELECT picture_name, picture_type FROM users WHERE pseudo = "'.$_SESSION["pseudo"].'"'); // Get the id and password 
        $result = $this->query_request($sql, $_pdo);

    
        $result[0]->picture_type = trim(explode('/', $result[0]->picture_type)[1]); //To only get the extension
        $_SESSION['picture_name'] = $result[0]->picture_name;
        $_SESSION['picture_type'] = $result[0]->picture_type;
        $_SESSION['picture_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_SESSION['picture_name']); //Picture name without extension
      }
    }
    $errorMessages[] = '';
    return $errorMessages;
  }
}



/** About the posts page */
class Posts extends Model{

  // Display all posts
  public function getPosts($_pdo){
    $sql = 'SELECT category, title, location, date, name, date_creation FROM posts';
    $getPosts = $this->query_request($sql, $_pdo);
    return $getPosts;
  }

  // Send a post
  public function sendPost($_pdo){
  
    // Form sended
    if(!empty($_POST)){
      $category = htmlspecialchars($_POST['category']);
      $title = htmlspecialchars($_POST['title']);
      $description = htmlspecialchars($_POST['description']);
      $location = htmlspecialchars($_POST['location']);
      $date = htmlspecialchars($_POST['date']);
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $phone = htmlspecialchars($_POST['phone']);

      // Check errors 
      if(empty($category)){
        $errorMessages[] = 'Missing category';
      }
      if(empty($title)){
        $errorMessages[] = 'Missing title';
      }
      if(empty($description)){
        $errorMessages[] = 'Missing description';
      }
      if(empty($location)){
        $errorMessages[] = 'Missing location';
      }
      if(empty($date)){
        $errorMessages[] = 'Missing location';
      }
      if(empty($name)){
        $errorMessages[] = 'Missing name';
      }
      if(empty($email)){
        $errorMessages[] = 'Missing email';
      }
      if(strlen($title)>16){
        $errorMessages[] = 'Max 16 chars for the title';
      }
      if(strlen($description)>300){
        $errorMessages[] = 'Max 300 chars for the description';
      }
      if(strlen($title)<4){
        $errorMessages[] = 'Min 4 chars for the title';
      }
      if(strlen($description)<5){
        $errorMessages[] = 'Min 5 chars for the description';
      }
      if(strpos($email, '@') != true){
        $errorMessages[] = 'Need a valid email';
      }

      // If there is no error
      if(empty($errorMessages)){  
        $sql = 'INSERT INTO posts_toValidate (category, title, description, location, date, name, email, phone) VALUES (:category, :title, :description, :location, :date, :name, :email, :phone)';
        $prepare = $this->prepare_request($sql, $_pdo);

        $prepare->bindValue(':category', $category);
        $prepare->bindValue(':title', $title);
        $prepare->bindValue(':description', $description);
        $prepare->bindValue(':location', $location);
        $prepare->bindValue(':date', $date);
        $prepare->bindValue(':name', $name);
        $prepare->bindValue(':email', $email);
        $prepare->bindValue(':phone', $phone);

        $execute = $prepare->execute();

        $_POST['category']='';
        $_POST['title']='';
        $_POST['description']='';
        $_POST['location']='';
        $_POST['date']='';
        $_POST['name']='';
        $_POST['email']='';
        $_POST['phone']='';
      }
      $errorMessages[] = '';
      header('Location: post_sended');
      return $errorMessages;

    // Form not sended
    }else{
      $_POST['category']='';
      $_POST['title']='';
      $_POST['description']='';
      $_POST['location']='';
      $_POST['date']='';
      $_POST['name']='';
      $_POST['email']='';
      $_POST['phone']='';

      $errorMessages[] = '';
      return $errorMessages;
    }
  }

  // Get unvalidated posts
  public function get_unvalidate($_pdo){
    $sql = 'SELECT * FROM posts_tovalidate';
    $getPosts = $this->query_request($sql, $_pdo);
    return $getPosts;
  }

  // Get the specific unvalidated post you clicked on
  public function get_specific_post($_pdo, $__id){
    $sql = 'SELECT * FROM posts_tovalidate WHERE id = '. $__id;
    $getPost = $this->query_request($sql, $_pdo);
    return $getPost;
  }

  // Validate a post
  public function validate($_pdo, $_id){

    $specific = $this->get_specific_post($_pdo, $_id);
 
    $sql = 'INSERT INTO posts (category, title, description, location, date, name, email, phone) 
            VALUES (:category, :title, :description, :location, :date, :name, :email, :phone)';
    
    $prepare = $this->prepare_request($sql, $_pdo);

    $prepare->bindValue(':category', $specific[0]->category);
    $prepare->bindValue(':title', $specific[0]->title);
    $prepare->bindValue(':description', $specific[0]->description);
    $prepare->bindValue(':location', $specific[0]->location);
    $prepare->bindValue(':date', $specific[0]->date);
    $prepare->bindValue(':name', $specific[0]->name);
    $prepare->bindValue(':email', $specific[0]->email);
    $prepare->bindValue(':phone', $specific[0]->phone);

    $execute = $prepare->execute();
    $delete = $this->delete($_pdo, $_id);
  }

  //Delete a post
  public function delete($_pdo, $_id){
    $sql = 'DELETE FROM posts_tovalidate WHERE id = '.$_id;
    $exec = $_pdo->exec($sql);
  }
}