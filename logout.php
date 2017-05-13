<?php
session_start();

// remove all session variables
$_SESSION = array(); 

// destroy the session 
session_destroy();
header('Location:index.html') ;

?>