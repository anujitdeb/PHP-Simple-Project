<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container">
        <a class="navbar-brand text-white" href="/php-simple-project/index.php">Student Portal</a>

        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5">
                    <a class="nav-link" href="/php-simple-project/index.php"><span
                                style="text-decoration: underline; color: white">Home</span></a>
                </li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-outline-light my-2 my-sm-0" type="button">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-outline-light my-2 my-sm-0" type="button">Logout</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
