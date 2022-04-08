<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

echo "hola";
// Redirect to login page
//header("location: index.php");
//exit;
?>