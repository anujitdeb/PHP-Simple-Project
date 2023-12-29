<?php
    if (!isset($_SESSION['user'])) {
        $_SESSION['errorMessage'] = "Please login.";

        // Redirect back to the home page
        header("Location: /php-simple-project/index.php");
        exit();
    }