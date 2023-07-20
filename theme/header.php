<?php
include_once("../core/ApiData.php");
$uri = $_SERVER['REQUEST_URI'];
$curretUri = getCurrentURL();
$cookie = $_SERVER['HTTP_COOKIE'];
$refreshToken = $_COOKIE['refreshToken'];

if (preg_match("/login.php/", $uri)) {
    if (isset($refreshToken)) {
        header("Location: $curretUri/main/email.php");
    }
} else if (preg_match("/email.php/", $uri) || preg_match("/site.php/", $uri) ||     preg_match("/blog.php/", $uri)) {
    if (!isset($refreshToken)) {
        header("Location: $curretUri/main/_login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Save Mail</title>
    <!-- favicon.ico -->
    <link rel="shortcut icon" href="/assets/img/anon.png" type="image/x-icon" />
    <link rel="icon" href="/assets/img/anon.png" type="image/x-icon" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/hack-font@3/build/web/hack-subset.css">
    <!-- Include Jquery -->
    <script src="../assets/js/jquery-3.7.0.min.js"></script>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <!-- Include Popper.js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0/dist/js.cookie.min.js"></script>
    <!-- Include stylesheets  -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css">
    <!-- toggle -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" />
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.min.css">
    <script>
        var api_uri = '<?= $api_uri; ?>';
        var uriLocal = '<?= $curretUri; ?>';
    </script>
    <script src="../assets/js/header.js"></script>
</head>

<body>
    <div class="hack-fuid">
        <?php

        if (preg_match("/email.php/", $uri) || preg_match("/site.php/", $uri) || preg_match("/blog.php/", $uri)) { ?>

            <div class="container">
                <div class="col-lg-12 nav-hack">
                    <div class="row justify-content-center align-items-center text-center text-uppercase text-green g-2">
                        <div class="col"><a class="nav-link 
                    <?php if (preg_match("/email.php/", $uri)) {
                        echo "active";
                    }  ?>                                                            " href="email.php"><i class="icon" data-feather="mail"></i>Email</a>
                        </div>
                        <div class="col"><a class="nav-link                     
                        <?php if (preg_match("/site.php/", $uri)) {
                            echo "active";
                        }  ?>   " href="site.php"><i class="icon" data-feather="globe"></i>Site
                                Pay</a>
                        </div>
                        <div class="col"><a class="nav-link    
                        <?php if (preg_match("/blog.php/", $uri)) {
                            echo "active";
                        }  ?> " href="blog.php"><i class="icon" data-feather="database"></i>Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if (preg_match("/main/", $uri)) { ?>
            <div class="containter">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center text-green">
                        <h1 class="login-tittle">Login Your Access <?= $uri ?></h1>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>