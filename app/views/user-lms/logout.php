<?php

session_start();
session_destroy();  // Destroy session to log the user out
header('Location: /login');  // Redirect to the login page after logout
exit;
?>
