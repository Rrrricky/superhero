<?

session_start(); // Useful to limit the access to some pages
if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
  echo 'Bonjour '.$_SESSION['pseudo'];
  // echo 'Bonjour '.$_COOKIE['pseudo'];
}

//1. Get username and his status from table users and groups
//2. Create an inner join between: id_group from table 'users' and id from table 'groups'
$query = $pdo->query('SELECT u.pseudo AS user_pseudo, g.status AS user_status  
                      FROM users AS u INNER JOIN groups AS g
                      ON u.id_group = g.id'
                    );

$result = $query->fetchAll();