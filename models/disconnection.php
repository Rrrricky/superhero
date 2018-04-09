<?

session_start(); // Give the user a session number 

// Remove session
$_SESSION = [];
session_destroy();

// Remove autolog cookies
setcookie('login', '');
setcookie('pass_hache', '');

echo 'Disconnected';