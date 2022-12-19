<?php include("../partials/header.php"); ?>
<?php include("photo_library_modal.php"); ?>
<?php include('../../../controller/admin/edit_user.php'); ?>
<div class="main-panel">

    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-8 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit user</h4>
                        <p class="card-description">
                            Edit user information here
                        </p>

                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <img class="img-responsive w-100" src="../../../<?php echo $user->image_path_and_placeholder(); ?>" alt="">
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control file-upload-info" name="user_image" placeholder="Upload Image">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputName1" value="<?php echo $user->username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail3" value="<?php echo $user->user_email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword4">Password (user will see this password)</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword4">
                            </div>


                            <div class="form-group">
                                <label>User Role</label>
                                <select class="js-example-basic-single w-100" name="user_role">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" name="create" class="btn btn-primary me-2">Submit</button>
                            <a class="btn btn-light" href="./all_users.php">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<?php include("../partials/footer.php"); ?>