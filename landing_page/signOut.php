<?php
session_start();

$_SESSION["userID"]="";
$_SESSION["userFullName"]="";
$_SESSION["email"]="";
session_destroy();

header('Location: ../landing_page/index.php');
?>