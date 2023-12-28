<?php
session_start();
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
    <title>All Students</title>
</head>
<body>
<?php
    include "navbar.php";
?>
<div class="container my-5">

    <?php
    $errorMessage = null;
    $successMessage = null;

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
        <h3>List of Students : </h3>
        <a href="create.php" class="btn btn-info">
            <i class="fas fa-plus"></i> Add
        </a>
    </div>
    <hr>
    <table class="table">
        <thead>
        <tr class="text-center">
            <th>SN</th>
            <th>Name</th>
            <th>Phone</th>
            <th>e-mail</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "php-crud";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM users";
        $result = $connection->query($sql);

        if (!$result) {
            die("Query failed: " . $connection->error);
        }

        if ($result->num_rows) {
            $i = 1;
            while ($data = $result->fetch_assoc()) {
                echo "
               <tr class='text-center'>
                  <td>$i</td>
                  <td>$data[name]</td>
                  <td>$data[phone]</td>
                  <td>$data[email]</td>
                  <td>
                     <a href='edit.php?id=$data[id]' class='btn btn-info'>
                        <i class='fas fa-edit'></i> Edit
                     </a>
                     <a href='delete.php?id=$data[id]' class='btn btn-danger'>
                        <i class='fas fa-trash-alt'></i> Delete
                     </a>
                  </td>
               </tr>
            ";
                $i++;
            }
        } else {
            echo "<tr><td colspan='5' class='text-center fw-bolder'>No data found!</td></tr>";
        }
        $connection->close();
        ?>
        </tbody>
    </table>
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
