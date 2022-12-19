<?php include("../partials/header.php"); ?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">All Your Comments</a>
                            </li>

                        </ul>

                    </div>
                    <div class="row">


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Your Comment</h4>
                                    <p class="card-description">
                                        View all your comments here
                                    </p>
                                    <?php echo $message;
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        post id
                                                    </th>
                                                    <th>
                                                        content
                                                    </th>
                                                    <th>
                                                        date posted
                                                    </th>
                                                    <th>
                                                        manage
                                                    </th>
                                                    <th>
                                                        status
                                                    </th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $comments = Comment::find_all_where('author', $session->user_id);

                                                foreach ($comments as $comment) : ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $comment->post_id ?>
                                                        </td>
                                                        <td class="wrapping">
                                                            <?php echo $comment->body ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $comment->comment_date ?>
                                                        </td>
                                                        <td>
                                                            <div class="badge  <?php echo $comment->comment_status == 'approved' ? 'badge-success text-white' : ($comment->comment_status == 'flagged' ? 'badge-warning text-black' : 'badge-danger text-white'); ?>">
                                                                <?php echo $comment->comment_status ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="edit_comment.php?id=<?php echo $comment->id; ?>"> <i class="fa-solid fa-pencil"></i></a>
                                                            <a href="../../../controller/admin/delete_comment.php?id=<?php echo $comment->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

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
                <!-- content-wrapper ends -->

            </div>
        </div>
    </div>
</div>


<!-- main-panel ends -->
<?php include("../partials/footer.php"); ?>