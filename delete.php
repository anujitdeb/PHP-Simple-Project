<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "php-crud";
$errorMessage = "Failed to delete.";
$successMessage = "Successfully Deleted.";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_GET['id'])) $id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=$id";
$result = $connection->query($sql);

if (!$result) {
    $_SESSION['errorMessage'] = $errorMessage;
    die("Query failed: " . $connection->error);
} else {
    $_SESSION['successMessage'] = $successMessage;
    header("location: students.php");
    exit;
}

?>
