<?php
include "navbar.php";
include "dbConnection.php";
include "header.html";
include "footer.html";
?>

<div class="container my-5">

    <?php

    $name = "";
    $email = "";
    $phone = "";
    $errorMessage = null;
    $successMessage = null;

    if (isset($_GET['successMessage'])) {
        $successMessage = $_GET['successMessage'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        do {
            if (empty($name) || empty($email) || empty($phone)) {
                $errorMessage = "All fields are required!";
                /*$_SESSION['errorMessage'] = "All fields are required!";*/
                break;
            }

            $sql = "INSERT INTO users (name, email, phone)" . "VALUES('$name', '$email', '$phone')";
            $result = $connection->query($sql);

            if (!$result) {
                die("Query failed: " . $connection->error);
            } else {
//            $successMessage = "Successfull.";
                $_SESSION['successMessage'] = "Successfully created.";
                header("location: create.php?successMessage=" . urlencode($successMessage));
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

    if (isset($_SESSION['successMessage'])) {
        $successMessage = $_SESSION['successMessage'];
    }
    if (!empty($successMessage)) {
        echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Yeaaa!</strong> $successMessage
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
         ";
        unset($_SESSION['successMessage']); // Clear the message
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
                <div class="row mb-2">
                    <label class="col-md-2 col-form-label">name</label>
                    <div class="col-md-6">
                        <input name="name" class="form-control" type="text" value=""><!-- <?php echo $name ?> -->
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-md-2 col-form-label">email</label>
                    <div class="col-md-6">
                        <input name="email" class="form-control" type="email" value=""><!-- <?php echo $email ?> -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">phone</label>
                    <div class="col-md-6">
                        <input name="phone" class="form-control" type="text" value=""><!-- <?php echo $phone ?> -->
                    </div>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
