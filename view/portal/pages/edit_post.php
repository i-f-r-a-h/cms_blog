<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/edit_post.php'); ?>
<div class="main-panel">

    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-12 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Edit Post</h2>
                        <p class="card-description pb-2 border-bottom">
                            Edit your post here
                        </p>
                        <?php echo $message; ?>
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Article image</label>
                                <img class="img-responsive img-fluid w-100" src=" /blog/view/<?php echo $posts->picture_path(); ?> " alt="">
                                <div class="form-group">
                                    <div class="input-group col-xs-12">
                                        <input type="file" class="form-control file-upload-info" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Post title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputName1" value="<?php echo $posts->title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Post Subheading</label>

                                <textarea class="form-control textarea-h" name="content" id="" rows="8"><?php echo $posts->content; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="caption">Post content</label>
                                <textarea class="form-control  textarea-h" name="description" id="textarea" cols="30" rows="14"><?php echo $posts->description; ?></textarea>

                            </div>
                            <div class="form-group">
                                <label>Post Category</label>
                                <select class="js-example-basic-single w-100" name="category_id">
                                    <option value="choose">Currently <?php $cat = Category::find_by_id($posts->category_id);
                                                                        if ($cat) {
                                                                            echo $cat->category_title;
                                                                        } else {
                                                                            echo 'no category for this post';
                                                                        } ?> </option>
                                    <?php foreach ($category = Category::find_all() as $cat) { ?>
                                        <option value="<?php echo $cat->id ?>"><?php echo $cat->category_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Post status (select published if you want your post to display for everyone)</label>
                                <select class="js-example-basic-single w-100" name="user_role">
                                    <option value="choose">Choose...</option>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                            <button type="submit" name="create" class="btn btn-primary me-2">Submit</button>
                            <a class="btn btn-light" href="posts.php">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<?php include("../partials/footer.php"); ?>