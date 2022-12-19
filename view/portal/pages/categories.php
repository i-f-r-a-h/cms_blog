<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/add_category.php'); ?>

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
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Blog Categories</a>
                            </li>

                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="categories.php?add=new" class="btn btn-primary text-white me-0"><i class="icon-plus"></i>Add Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        <?php if (isset($_GET['add'])) { ?>
                            <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" method="post" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>Enter new category </label>
                                                    <input type="text" name="title" class="form-control">

                                                </div>
                                                <button type="submit" name="add_cat" class="btn btn-primary me-2 text-white">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        <div class="row">


                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">All Categories</h4>
                                        <p class="card-description">
                                            <?php echo $message;
                                            ?>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Category Id
                                                        </th>
                                                        <th>
                                                            Category Name
                                                        </th>
                                                        <th>
                                                            Actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $categories = Category::find_all();

                                                    foreach ($categories as $category) : ?>
                                                        <?php include('../../../controller/admin/edit_category.php'); ?>

                                                        <tr>


                                                            <td>
                                                                <?php echo $category->id ?>
                                                            </td>
                                                            <td>
                                                                <?php if (isset($_GET['id']) && $_GET['id'] == $category->id) { ?>

                                                                    <form class="forms-sample" method="post" enctype="multipart/form-data">

                                                                        <div class="form-group">
                                                                            <input type="text" name="cat-title" class="form-control" value="<?php echo $category->category_title; ?>">
                                                                        </div>
                                                                        <button type="submit" name="update-cat" class="btn btn-primary me-2 text-white">Update</button>
                                                                    </form>

                                                                <?php } else {
                                                                    echo $category->category_title;
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <a href="categories.php?id=<?php echo $category->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                <a href="delete_category.php?id=<?php echo $category->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                            </td>
                                                        </tr>
                                                    <?php
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