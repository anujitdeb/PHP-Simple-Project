<?php
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Edit Student</title>
</head>
<body>

<div class="container my-5">

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "php-crud";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $name = "";
    $email = "";
    $phone = "";
    $errorMessage = null;
    $successMessage = null;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET['id'])) {
            header('location: /php-simple-project/students.php');
            exit;
        }

        if (isset($_GET['id'])) $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $connection->query($sql);
        if (!$result) {
            die("Query failed: " . $connection->error);
        }
        $data = $result->fetch_assoc();

        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];


    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        do {
            if (empty($name) || empty($email) || empty($phone)) {
//                $errorMessage = "All fields are required!";
                $_SESSION['errorMessage'] = "All fields are required!";
                break;
            }
            $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id=$id";
            $result = $connection->query($sql);
            if (!$result) {
                die("Query failed " . $connection->error);
            } else {
//                $successMessage = "Successfully updated.";
                $_SESSION['successMessage'] = "Successfully updated.";
                header("location: students.php");
                exit;
            }
        } while (false);
    }

    if (isset($_SESSION['errorMessage'])) {
        $errorMessage = $_SESSION['errorMessage'];
    }
    if ($errorMessage != null) {
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>Opps!</strong> $errorMessage
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
         ";
        unset($_SESSION['errorMessage']); // Clear the message
    }

    ?>

    <div class="d-flex justify-content-between">
        <h3>Create a Student : </h3>
        <a href="students.php" class="btn btn-info">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <hr>
    <div class="card card-body">
        <div class="text-center">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row mb-2">
                    <label class="col-md-2 col-form-label">name</label>
                    <div class="col-md-6">
                        <input name="name" class="form-control" type="text" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-md-2 col-form-label">email</label>
                    <div class="col-md-6">
                        <input name="email" class="form-control" type="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">phone</label>
                    <div class="col-md-6">
                        <input name="phone" class="form-control" type="text" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</html>
