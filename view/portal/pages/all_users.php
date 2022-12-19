<?php include("../partials/header.php"); ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ps-0 " href="all_users.php">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="all_users.php?view=admin">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="all_users.php?view=user">Blog Users</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <!-- <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-download"></i>Export</a>
                                <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a> -->
                                <a href="add_users.php" class="btn btn-primary text-white me-0"><i class="icon-plus"></i>Add user</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">



                        <div class="row">


                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">All Users</h4>
                                        <p class="card-description">
                                            <?php echo $message; ?>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            User
                                                        </th>
                                                        <th>
                                                            Username
                                                        </th>
                                                        <th>
                                                            Full name
                                                        </th>
                                                        <th>
                                                            Email address
                                                        </th>
                                                        <th>
                                                            User Role
                                                        </th>
                                                        <th>
                                                            Manage
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_GET['view'])) {
                                                        $_GET['view'] == 'user' ? $users = User::find_all_where('user_role', 'user') : $users = User::find_all_where('user_role', 'admin');
                                                    } else {
                                                        $users = User::find_all();
                                                    }

                                                    if (isset($_GET['highlight'])) {
                                                        $view = user::find_by_id($_GET['highlight']);
                                                        $highlight = $view->id;
                                                    ?>
                                                        <tr class="table-warning py-1">
                                                            <td>
                                                                <img src="../../../<?php echo $view->image_path_and_placeholder() ?>" alt="image" />
                                                            </td>
                                                            <td>
                                                                <?php echo $view->username ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->first_name . '' . $view->last_name ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->user_email ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->user_role ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit_user.php?id=<?php echo $view->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                <a href="delete_user.php?id=<?php echo $view->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                            </td>
                                                        </tr>

                                                        <?php   } else {
                                                        $highlight = 0;
                                                    }
                                                    foreach ($users as $user) :
                                                        if ($user->id !== $highlight) { ?>
                                                            <tr>
                                                                <td>
                                                                    <img src="../../../<?php echo $user->image_path_and_placeholder() ?>" alt="image" />
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->username ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->first_name . '' . $user->last_name ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->user_email ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->user_role ?>
                                                                </td>
                                                                <td>
                                                                    <a href="edit_user.php?id=<?php echo $user->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                    <a href="delete_user.php?id=<?php echo $user->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                                </td>
                                                            </tr>

                                                    <?php }
                                                    endforeach;
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- main-panel ends -->
<?php include("../partials/footer.php"); ?>