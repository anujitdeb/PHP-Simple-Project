<?php
session_start();

// Unset the user session
session_unset();
$_SESSION['successMessage'] = "Successfully logged out.";

// Redirect back to the home page
header("Location: /php-simple-project/index.php");
exit();
?>
