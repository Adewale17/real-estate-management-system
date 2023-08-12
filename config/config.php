
<?php
try{

if(!defined('SERVERNAME')) define("SERVERNAME", "localhost");
if(!defined('DBNAME')) define("DBNAME","homeland");
if(!defined('USERNAME')) define("USERNAME","root");
if(!defined('PASSWORD')) define("PASSWORD","");

$conn = new PDO ("mysql:host=".SERVERNAME.";dbname=".DBNAME."",USERNAME, PASSWORD);
$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $Exception){
    echo $Exception ->getMessage();
}

?>                                                                                                                                           