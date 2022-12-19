<?php
require_once("/Applications/XAMPP/xamppfiles/htdocs/blog/modal/engine/init.php");


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAE Blogs</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="../assets/css/fontastic.css">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="../assets/vendor/@fancyapps/fancybox/jquery.fancybox.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <script src="https://kit.fontawesome.com/7be4e2fa54.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <!-- Main Navbar-->
        <nav class="navbar navbar-expand-lg">
            <div class="search-area">
                <div class="search-area-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn"><i class="icon-close"></i></div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <form action="blog.php">
                                <div class="form-group">
                                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Navbar Brand -->
                <div class="navbar-header d-flex align-items-center justify-content-between">
                    <!-- Navbar Brand --><a href="/blog/view/public/index.php" class="navbar-brand">SAE Blogs</a>
                    <!-- Toggle Button-->
                    <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
                </div>
                <!-- Navbar Menu -->
                <div id="navbarcollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="/blog/view/public/blog.php" class="nav-link ">Posts</a></li>

                        <!-- login/register -->
                        <?php
                        // login
                        $login = $session->is_signed_in() ? '<li class="nav-item"><a class="nav-link" href="../portal/index.php">Your Dashboard</a></li>' :  '<li><a class="nav-link scrollto" href="/blog/view/account/login.php">Login</a></li>';
                        echo $login;
                        // register
                        $register = !$session->is_signed_in() ? '<li class="nav-item "><a class="nav-link btn btn-outline-secondary rounded bg-dark text-white" href="/blog/view/account/register.php">Register</a></li>' : '<li><a class="nav-link btn btn-outline-secondary rounded bg-dark text-white" href="/blog/controller/account/logout.php">Log out</a></li>';
                        echo $register;
                        ?>
                    </ul>
                    <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
                </div>
            </div>
        </nav>
    </header>