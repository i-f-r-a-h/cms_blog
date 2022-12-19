<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/add_post.php'); ?>
<div class="main-panel">

    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-12 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create a new post</h2>
                        <?php echo $message; ?>
                        <div class="row">
                            <div class="col-md-6">

                                <?php echo $message; ?>
                                <form method="post" enctype="multipart/form-data">

                                    <div class="form-group">

                                        <input type="text" name="title" class="form-control">

                                    </div>

                                    <div class="form-group">

                                        <input type="file" name="file">

                                    </div>

                                    <input type="submit" name="submit">

                                </form>

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