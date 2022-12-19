<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/add_user_image.php'); ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload User Profile Pictures</h4>
                        <h3><?php echo $message ?></h3>
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control file-upload-info" name="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image title</label>
                                <input type="text" name="title" class="form-control">

                            </div>
                            <button type="submit" name="create" class="btn btn-primary me-2">Submit</button>
                            <a class="btn btn-light" href="./all_users.php">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Images users can choose from</h4>
                            <p class="card-description">
                                View all images available for users to choose as their profile picture
                            </p>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Picture
                                            </th>
                                            <th>
                                                Picture title
                                            </th>
                                            <th>
                                                Delete
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $images = User_photo::find_all();

                                        foreach ($images as $image) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $image->id ?>
                                                </td>
                                                <td>
                                                    <?php echo $image->user_image ?>
                                                </td>
                                                <td>
                                                    <img class="img-xs rounded-circle" src="/<?php echo $image->picture_path() ?>" alt="Profile image">

                                                </td>
                                                <td>
                                                    <a href="../../../controller/admin/delete_photo.php?id=<?php echo $image->id; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;
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
<!-- /#page-wrapper -->
<?php include("../partials/footer.php"); ?>