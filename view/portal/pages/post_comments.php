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
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">All Posts Comments</a>
                            </li>

                        </ul>

                    </div>
                    <div class="row">


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Comment</h4>
                                    <p class="card-description">
                                        View all comments posted on the website
                                    </p>
                                    <?php echo $message;
                                    ?>


                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Id
                                                    </th>
                                                    <th>
                                                        Author
                                                    </th>
                                                    <th>
                                                        content
                                                    </th>
                                                    <th>
                                                        status
                                                    </th>
                                                    <th>
                                                        date posted
                                                    </th>
                                                    <th>
                                                        manage
                                                    </th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['highlight'])) {
                                                    $view = comment::find_by_id($_GET['highlight']);
                                                    if ($view) {
                                                        $highlight = $view->id;
                                                ?>
                                                        <tr class="table-warning py-1">
                                                            <td>
                                                                <?php echo $view->id ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->author ?>
                                                            </td>
                                                            <td class="wrapping">
                                                                <?php echo Comment::shortenString($view->body) ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->comment_status ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $view->comment_date ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit_comment.php?id=<?php echo $view->id; ?>"> <i class="fa-solid fa-pencil"></i></a>
                                                                <a href="../../../controller/admin/delete_comment.php?id=<?php echo $view->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                            </td>
                                                        </tr>

                                                    <?php
                                                    } else {
                                                        $highlight = 0;
                                                    }
                                                } else {
                                                    $highlight = 0;
                                                }

                                                $comments = Comment::find_all();

                                                foreach ($comments as $comment) :

                                                    if ($comment->id !== $highlight) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $comment->id ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $comment->author ?>
                                                            </td>
                                                            <td>
                                                                <?php echo Comment::shortenString($comment->body) ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $comment->comment_status ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $comment->comment_date ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit_comment.php?id=<?php echo $comment->id; ?>"> <i class="fa-solid fa-pencil"></i></a>
                                                                <a href="../../../controller/admin/delete_comment.php?id=<?php echo $comment->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                            </td>
                                                        </tr>

                                                <?php
                                                    }
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
                <!-- content-wrapper ends -->

            </div>
        </div>
    </div>
</div>


<!-- main-panel ends -->
<?php include("../partials/footer.php"); ?>