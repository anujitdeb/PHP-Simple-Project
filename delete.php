<?php
session_start();

include "dbConnection.php";

$errorMessage = "Failed to delete.";
$successMessage = "Successfully Deleted.";

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
