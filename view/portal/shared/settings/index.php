<?php
if (isset($_POST['data'])) {
    $file = '/Applications/XAMPP/xamppfiles/htdocs/blog/controller/account/settings/user_information.txt';

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/plain");
    readfile($file);
}
include("../../partials/header.php"); ?>
<?php include('../../../../controller/account/settings.php'); ?>
<div class="main-panel">
    <!-- heading -->
    <div class="content-wrapper">
        <!-- heading -->
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <h2 class="fw-bold">Settings for <a class="fw-bolder" href="../profile.php">@<?php echo $session->username ?></a></h2>
            <div class="row flex-grow mt-4 pt-4">


                <div class="row">
                    <!-- sidebar -->
                    <div class="col-lg-4 d-flex flex-column sticky-top">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin ">
                                <div class="card card-rounded">
                                    <nav class="card-body">
                                        <ul class="nav flex-column">
                                            <!-- edit profile -->
                                            <li class="nav-item fs-5 ">
                                                <a class="nav-link text-black" href="index.php?source=profile">
                                                    <i class="fa-solid fa-user"></i>
                                                    <span class="ml-2">Edit Profile</span>
                                                </a>
                                            </li>

                                            <!-- change password -->
                                            <li class="nav-item fs-5 ">
                                                <a class="nav-link text-black" href="index.php?source=password">
                                                    <i class="fa-solid fa-key"></i>
                                                    <span class="ml-2">Change password</span>
                                                </a>
                                            </li>

                                            <!-- customisation -->
                                            <!-- <li class="nav-item fs-5 ">
                                            <a class="nav-link text-black" href="index.php?source=customization">
                                                <i class="fa-solid fa-gear"></i>
                                                <span class="ml-2">Customization</span>
                                            </a>
                                        </li> -->

                                            <!-- data export -->
                                            <li class="nav-item fs-5 mb-2">
                                                <a class="nav-link text-black" href="index.php?source=data">
                                                    <i class="fa-solid fa-database"></i>
                                                    <span class="ml-2">Data Export</span>
                                                </a>
                                            </li>

                                            <!-- delete account -->
                                            <li class="nav-item fs-6 border-top pt-2">
                                                <a class="nav-link text-danger" href="index.php?source=delete_account">
                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                    <span class="ml-2">Delete account</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main content -->
                    <?php

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = ''; // to remove errors
                    }

                    switch ($source) {
                        case 'profile':
                            include("profile.php");
                            break;
                        case 'password':
                            include("password.php");
                            break;
                        case 'data':
                            include("data_export.php");
                            break;
                        case 'delete_account':
                            include("delete_account.php");
                            break;
                            // case 'customization':
                            //     include("customization.php");
                            //     break;
                        default:
                            include("profile.php");
                            break;
                    }

                    ?>




                </div>
            </div>


            <!-- profile section -->

            <?php include("../../partials/footer.php"); ?>