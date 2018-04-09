<?
//Careful: never put this file on a public GitHub repository
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'si_back_e19_p2021');
define('DB_PORT', '8889');
define('DB_USER', 'root');
define('DB_PASS', 'root');
try{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //Remove the double pdo
}
catch(Exception $e){
    $mail = 'eric.dufreche@hetic.net'; // Destination
    $jump = '\n';
    
    //Text messages and HTML messages
    $message_txt = 'There was a massive problem during the co to the database.';
    $message_html = '<html><head></head><body>There was a massive problem during the co to the database.</body></html>';
    
    //Boundary
    $boundary = '-----='.md5(rand());
    
    //Subject
    $subject = 'Database problem!';

    
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

    $mail = 'eric.dufreche@hetic.net';

    //Sending e-mail
    mail($mail, $subject, $message, $header);
    require 'views/pages/error_dbase.php';
    exit();
}