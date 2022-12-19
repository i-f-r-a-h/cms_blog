<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/edit_comment.php'); ?>
<div class="main-panel">

    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-8 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3> <?php echo $session->user_role == 'admin' ? 'Edit comment status here' : 'Update your comment here' ?></h3>
                        <ul class="card-description">
                            <?php if ($session->user_role == 'admin') { ?>
                                <li>Approved - comment will display on blog post</li>
                                <li>Flagged - User will receive notification to edit their comment</li>
                            <?php } ?>
                        </ul>
                        <?php echo $message ?>
                        <form class="forms-sample" method="post">
                            <?php if ($session->user_role == 'admin') { ?>
                                <div class="form-group">
                                    <label for="exampleInputName1">Author</label>
                                    <input disabled type="text" name="username" class="form-control" id="exampleInputName1" value="<?php echo $comment->author; ?>">
                                </div>
                            <?php } else { ?>
                                <p>Article that has the comment:</p>
                                <p class="h5 fw-bolder"> <?php $article = Post::find_by_id($comment->post_id);
                                                            echo $article->title;
                                                            ?> </p>


                            <?php } ?>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Comment</label>
                                <textarea <?php if ($session->user_role == 'admin') {
                                                echo 'disabled';
                                            } ?> name="body" class="form-control h-50" id="exampleFormControlTextarea1" rows="10"><?php echo $comment->body; ?></textarea>
                            </div>
                            <?php if ($session->user_role == 'admin') { ?>
                                <div class="form-group">
                                    <label>Comment status</label>
                                    <select class="form-control" name="comment_status">
                                        <option selected>Choose...</option>
                                        <option value="approved">Approved</option>
                                        <option value="flagged">Flagged</option>
                                    </select>
                                </div>
                            <?php } ?>
                            <button type="submit" name="update" class="btn btn-primary me-2">Update</button>
                            <a class="btn btn-light" href="./post_comments.php">Back to comments</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#page-wrapper -->
<?php include("../partials/footer.php"); ?>