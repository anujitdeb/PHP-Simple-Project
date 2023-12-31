<?php
include "navbar.php";
include "dbConnection.php";
include 'checkAuthentication.php';
include "header.html";
include "footer.html";
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
