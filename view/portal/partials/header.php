<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/blog/modal/engine/init.php"); ?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/blog/controller/user/notification_process.php"); ?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/blog/controller/search/admin.php"); ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sae Share </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/blog/view/portal/vendors/feather/feather.css">
    <link rel="stylesheet" href="/blog/view/portal/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/blog/view/portal/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/blog/view/portal/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/blog/view/portal/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/blog/view/portal/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/blog/view/portal/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/blog/view/portal/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/blog/view/portal/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/blog/view/portal/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://kit.fontawesome.com/7be4e2fa54.js" crossorigin="anonymous"></script>

    <!-- google api -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php if ($_SERVER['PHP_SELF'] == '/blog/view/portal/index.php' && $session->user_role == 'admin') { ?>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["corechart"]

            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Users', <?php echo User::count_all(); ?>],
                    ['Posts', <?php echo Post::count_all(); ?>],
                    ['Comment', <?php echo Comment::count_all(); ?>],
                    ['likes', <?php echo Like::count_all(); ?>]

                ]);

                var options = {
                    pieHole: 0.6,
                    backgroundColor: 'transparent'
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['geochart'],
            });
            google.charts.setOnLoadCallback(drawRegionsMap);

            function drawRegionsMap() {
                var data = google.visualization.arrayToDataTable([

                    ['Country', 'Users'],
                    <?php $location = sae_campus::find_by_query("SELECT DISTINCT id,campus_address FROM sae_campus");
                    foreach ($location as $campus) {
                        $lastid = sae_campus::find_by_id($campus->id + 1);
                        $count = 0;
                        if ($lastid) {
                            echo "['$campus->campus_address', " . count(User::find_all_where('campus', $campus->id)) . "],";
                        } else {
                            echo "['$campus->campus_address', " . count(User::find_all_where('campus', $campus->id)) . "]";
                        }
                    }

                    ?>
                ]);

                var options = {};

                var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

                chart.draw(data, options);
            }
        </script>
    <?php } ?>
</head>

<body>


    <!-- partial:partials/_navbar.html -->

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="/blog/view/portal/index.php">
                    <div class="container-scroller"> <?php echo $session->user_role == 'admin' ? 'SAE Admin' : 'SAE Share'; ?> </div>
                </a>

            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Welcome back,<span class="text-black fw-bold"><?php echo $session->username ?></span></h1>
                    <h3 class="welcome-sub-text">To return back to the blog, view the menu </h3>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form class="search-form" action="#">
                        <i class="icon-search"></i>
                        <input type="search" id="search-admin" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
                </li>
                <!-- notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="notificationDropdown" href="<?php echo $_SERVER['PHP_SELF'] . "?notifications=1" ?>" data-bs-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="count"><?php echo $notify = Notification::notification_count($session->user_id);
                                            ?> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                        <div class="dropdown-item py-3">
                            <p class="mb-0 font-weight-medium float-left">You have <?php echo $notify = Notification::notification_count($session->user_id);
                                                                                    ?> unread notifications </p>
                            <div class="float-right">
                                <a href="/blog/view/portal/shared/notifications.php"><span class="badge badge-pill badge-secondary  text-white">View all</span></a>
                                <a href="<?php echo $_SERVER['PHP_SELF'] . "?read=true" ?>"><span class="badge badge-pill badge-primary ml-0 text-white">Mark as Read</span></a>
                            </div>

                        </div>
                        <div class="dropdown-divider"></div>
                        </td>
                        <?php $notify = Notification::notification(0, $session->user_id);
                        foreach ($notify as $notification_message) {
                        ?>
                            <a class="dropdown-item preview-item" href="/blog/view/portal/shared/notifications.php?view=<?php echo $notification_message->id ?>">
                                <div class="preview-thumbnail">
                                    <img src="/blog/<?php $user = USER::find_by_id($notification_message->sender_id);
                                                    echo $user->image_path_and_placeholder() ?> " alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark"><?php
                                                                                                        $sender = USer::find_by_id($notification_message->sender_id);
                                                                                                        echo $sender->username . " " . $notification_message->action
                                                                                                        ?></p>
                                    <p class="  mb-0"> <?php echo strlen($notification_message->notification_message) > 80 ? substr($notification_message->notification_message, 0, 60) . "..." : substr($notification_message->notification_message, 0, 60);
                                                        ?></p>
                                    <span class="fw-light text-small float-right mt-2">Sent on <?php echo $notification_message->date_sent
                                                                                                ?> </span>
                                </div>
                            </a>
                        <?php  } ?>

                    </div>
                </li>

                <!-- profile -->
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="/blog/<?php $user = USER::find_by_id($session->user_id);
                                                                        echo $user->image_path_and_placeholder() ?> " alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md w-50 rounded-circle" src="/blog/<?php echo $user->image_path_and_placeholder() ?> " alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold"><?php echo $session->fullName ?></p>
                            <p class="fw-light text-muted mb-0"><?php echo $session->email ?></p>
                        </div>
                        <a href="/blog/view/portal/shared/profile.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                        <a href="/blog/controller/account/logout.php" class=" dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>






    <!-- partial -->
    <div class="container-fluid page-body-wrapper">


        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/blog/view/portal/index.php">
                        <i class="mdi mdi-view-dashboard menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>



                <li class="nav-item nav-category">Menu</li>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/view/public/index.php">
                        <i class=" menu-icon mdi mdi-arrow-left"></i>
                        <span class="menu-title">Back to blog</span>
                    </a>
                </li>
                <?php if ($session->user_role == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                            <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                            <span class="menu-title">Users</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/blog/view/portal/pages/all_users.php">All Users</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/blog/view/portal/pages/add_users.php">Add User</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/blog/view/portal/pages/add_users_image.php">User Profile Pictures</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="posts">
                            <i class="menu-icon mdi  mdi-file-document"></i>
                            <span class="menu-title">Posts</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="posts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="/blog/view/portal/pages/all_posts.php">All Posts</a></li>
                                <li class="nav-item"><a class="nav-link" href="/blog/view/portal/pages/post_comments.php">Posts Comments</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/pages/categories.php">
                            <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
                            <span class="menu-title">Blog Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/pages/sae_information.php">
                            <i class="menu-icon mdi mdi-human-male-female"></i>
                            <span class="menu-title">SAE Information</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/pages/add_posts.php">
                            <i class="menu-icon mdi mdi-plus-circle-outline"></i>
                            <span class="menu-title">Create post</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/pages/posts.php">
                            <i class="menu-icon mdi mdi-file-document-box"></i>
                            <span class="menu-title">Your posts</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/pages/comments.php">
                            <i class="menu-icon mdi mdi-comment-multiple-outline"></i>
                            <span class="menu-title">Your comments</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/shared/profile.php">
                            <i class="menu-icon mdi mdi-account-circle"></i>
                            <span class="menu-title">Your profile</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/view/portal/shared/settings/">
                            <i class="menu-icon mdi mdi-settings"></i>
                            <span class="menu-title">Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>