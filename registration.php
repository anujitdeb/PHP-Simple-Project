<?php
session_start(); // Start the session
include "dbConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="css/style.css">
    <meta name="robots" content="noindex, follow">
    <script nonce="a261599c-1b15-40e3-9a63-1bce0b02bfb5">(function (w, d) {
            !function (dp, dq, dr, ds) {
                dp[dr] = dp[dr] || {};
                dp[dr].executed = [];
                dp.zaraz = {deferred: [], listeners: []};
                dp.zaraz.q = [];
                dp.zaraz._f = function (dt) {
                    return async function () {
                        var du = Array.prototype.slice.call(arguments);
                        dp.zaraz.q.push({m: dt, a: du})
                    }
                };
                for (const dv of ["track", "set", "debug"]) dp.zaraz[dv] = dp.zaraz._f(dv);
                dp.zaraz.init = () => {
                    var dw = dq.getElementsByTagName(ds)[0], dx = dq.createElement(ds),
                        dy = dq.getElementsByTagName("title")[0];
                    dy && (dp[dr].t = dq.getElementsByTagName("title")[0].text);
                    dp[dr].x = Math.random();
                    dp[dr].w = dp.screen.width;
                    dp[dr].h = dp.screen.height;
                    dp[dr].j = dp.innerHeight;
                    dp[dr].e = dp.innerWidth;
                    dp[dr].l = dp.location.href;
                    dp[dr].r = dq.referrer;
                    dp[dr].k = dp.screen.colorDepth;
                    dp[dr].n = dq.characterSet;
                    dp[dr].o = (new Date).getTimezoneOffset();
                    if (dp.dataLayer) for (const dC of Object.entries(Object.entries(dataLayer).reduce(((dD, dE) => ({...dD[1], ...dE[1]})), {}))) zaraz.set(dC[0], dC[1], {scope: "page"});
                    dp[dr].q = [];
                    for (; dp.zaraz.q.length;) {
                        const dF = dp.zaraz.q.shift();
                        dp[dr].q.push(dF)
                    }
                    dx.defer = !0;
                    for (const dG of [localStorage, sessionStorage]) Object.keys(dG || {}).filter((dI => dI.startsWith("_zaraz_"))).forEach((dH => {
                        try {
                            dp[dr]["z_" + dH.slice(7)] = JSON.parse(dG.getItem(dH))
                        } catch {
                            dp[dr]["z_" + dH.slice(7)] = dG.getItem(dH)
                        }
                    }));
                    dx.referrerPolicy = "origin";
                    dx.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(dp[dr])));
                    dw.parentNode.insertBefore(dx, dw)
                };
                ["complete", "interactive"].includes(dq.readyState) ? zaraz.init() : dp.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);</script>

    <style>
        /* Add your custom styles for the navbar */
        .navbar {
            background-color: #3498db;
            padding: 10px;
            color: #fff;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }
    </style>
</head>

<body>

<div class="navbar bg-secondary">
    <div class="display-flex justify-content-between">
        <div>
            <a href="/php-simple-project/index.php">
                <span style="font-size: 20px; margin-left: 50px;">
                    Student Portal
                </span>
            </a>
        </div>
        <div>
            <a href="/php-simple-project/index.php">
                <span style="font-size: 15px; text-decoration: underline; margin-right: 80px">
                    Home
                </span>
            </a>
        </div>
    </div>
</div>

    <?php

        $name = "";
        $email = "";
        $phone = "";
        $user_password = "";
        $errorMessage = null;
        $successMessage = null;

        if (isset($_GET['successMessage'])) {
            $successMessage = $_GET['successMessage'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $user_password = $_POST['password'];

            do {
                if (empty($name) || empty($email) || empty($phone) || empty($user_password)) {
                    $errorMessage = "All fields are required!";
                    /*$_SESSION['errorMessage'] = "All fields are required!";*/
                    break;
                }

                $sql = "INSERT INTO users (name, email, phone, password)" . "VALUES('$name', '$email', '$phone', '$user_password')";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Query failed: " . $connection->error);
                } else {
//                    header("location: login.php");
                    echo '<script>window.location.href = "/php-simple-project/login.php";</script>';
                    exit;
                }
            } while (false);
        }

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }
        if ($errorMessage != null) {
            echo "
                    <script>
                        alert('$errorMessage');
                    </script>
                 ";
            unset($_SESSION['errorMessage']); // Clear the message
        }
    ?>

<div class="main">
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Registration</h2>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <input type="text" name="name" id="your_name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="your_name" placeholder="Your email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="your_name" placeholder="Your phone number"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="your_pass" placeholder="Password"/>
                        </div>
                        <div class="form-group form-button" style="margin-bottom: 0px;l">
                            <input type="submit" id="signin" class="form-submit"/>
                        </div>
                        <div class="form-group">
                            <a href="login.php" class="signup-image-link" style="margin-top: 0px; margin-left: 250px">Sign
                                In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon='{"rayId":"83d338c62c3aba50","version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body>
</html>