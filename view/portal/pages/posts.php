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
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">All Blog Posts</a>
                            </li>

                        </ul>

                    </div>

                    <div class="row">


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Posts</h4>
                                    <p class="card-description">
                                        View all your posts here
                                    </p>
                                    <?php echo $message; ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>


                                                    <th>Post content</th>
                                                    <th>Post engagement</th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Manage
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $posts =  post::find_all_where("author", $session->user_id, ' ORDER BY id DESC');



                                                if (isset($_GET['highlight'])) {
                                                    $view = Post::find_by_id($_GET['highlight']);
                                                    $highlight = $view->id;
                                                ?>
                                                    <tr class="table-warning py-1">


                                                        <td class="wrapping ">
                                                            <h4><a href="/blog/view/public/post.php?id=<?php echo $view->id; ?>" class="fw-bolder text-black"><?php echo $view->title;  ?></a></h4>
                                                            <div class=" d-flex flex-row gap-3 mt-2">
                                                                <p><b>Published on:</b> <?php echo substr($view->post_date, 0, 10);  ?></p>
                                                                <p><b>Category:</b> <?php
                                                                                    $cat = Category::find_by_id($view->category_id);
                                                                                    echo $cat ? $cat->category_title : '[category removed]'; ?></p>

                                                            </div>

                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-row gap-3 mt-2">
                                                                <p><i class="fa-solid fa-heart mr-1"></i><?php echo $view->likes == null ? 0 : $view->likes; ?> likes</p>
                                                                <p><i class="fa-solid fa-comment mr-1"></i><?php
                                                                                                            $comments = Comment::find_the_comments($view->id);
                                                                                                            echo count($comments); ?> comments</p>
                                                                <p><i class="fa-solid fa-eye mr-1"></i><?php
                                                                                                        echo $view->view_count == null ? 0 : $view->view_count;  ?> views</p>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="badge  <?php echo $view->post_status == 'approved' ? 'badge-success text-white' : ($view->post_status == 'flagged' ? 'badge-warning text-black' : 'badge-secondary text-white'); ?>">
                                                                <?php echo $view->post_status ?>
                                                            </div>
                                                        </td>
                                                        <?php if (isset($_GET['id']) && $_GET['id'] == $view->id) {

                                                            //delete
                                                            if (isset($_GET['del']) && $_GET['del'] == 'post') {
                                                                $post = Post::find_by_id($_GET['id']);
                                                                if ($post) {
                                                                    $post->delete();
                                                                    $session->message("<h3 class='bg-success p-2 text-white'>The post with id:{$post->id} has been deleted</h3>");
                                                                    redirect("posts.php");
                                                                } else {
                                                                    redirect("posts.php");
                                                                }
                                                            }
                                                        }
                                                        ?>



                                                        <td>
                                                            <a href="edit_post.php?id=<?php echo $view->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                            <a href="posts.php?id=<?php echo $view->id; ?>&del=post"><i class="fa-solid fa-trash-can"></i></a>
                                                        </td>


                                                    </tr>

                                                    <?php   } else {
                                                    $highlight = 0;
                                                }

                                                foreach ($posts as $posts) :
                                                    if ($posts->id !== $highlight) { ?>
                                                        <tr>


                                                            <td class="wrapping ">
                                                                <h4><a href="/blog/view/public/post.php?id=<?php echo $posts->id; ?>" class="fw-bolder text-black"><?php echo $posts->title;  ?></a></h4>
                                                                <div class=" d-flex flex-row gap-3 mt-2">
                                                                    <p><b>Published on:</b> <?php echo substr($posts->post_date, 0, 10);  ?></p>
                                                                    <p><b>Category:</b> <?php
                                                                                        $cat = Category::find_by_id($posts->category_id);
                                                                                        echo $cat ? $cat->category_title : '[category removed]'; ?></p>

                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-row gap-3 mt-2">
                                                                    <p><i class="fa-solid fa-heart mr-1"></i><?php echo $posts->likes == null ? 0 : $posts->likes; ?> likes</p>
                                                                    <p><i class="fa-solid fa-comment mr-1"></i><?php
                                                                                                                $comments = Comment::find_the_comments($posts->id);
                                                                                                                echo count($comments); ?> comments</p>
                                                                    <p><i class="fa-solid fa-eye mr-1"></i><?php
                                                                                                            echo $posts->view_count == null ? 0 : $posts->view_count;  ?> views</p>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="badge  <?php echo $posts->post_status == 'published' ? 'badge-success text-white' : ($posts->post_status == 'flagged' ? 'badge-warning text-black' : 'badge-secondary text-white'); ?>">
                                                                    <?php echo $posts->post_status ?>
                                                                </div>
                                                            </td>
                                                            <?php if (isset($_GET['id']) && $_GET['id'] == $posts->id) {

                                                                //delete
                                                                if (isset($_GET['del']) && $_GET['del'] == 'post') {
                                                                    $post = Post::find_by_id($_GET['id']);
                                                                    if ($post) {
                                                                        $post->delete();
                                                                        $session->message("<h3 class='bg-success p-2 text-white'>The post with id:{$post->id} has been deleted</h3>");
                                                                        redirect("posts.php");
                                                                    } else {
                                                                        redirect("posts.php");
                                                                    }
                                                                }
                                                            }
                                                            ?>



                                                            <td>
                                                                <a href="edit_post.php?id=<?php echo $posts->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                <a href="posts.php?id=<?php echo $posts->id; ?>&del=post"><i class="fa-solid fa-trash-can"></i></a>
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
                <!-- content-wrapper ends -->

            </div>
        </div>
    </div>
</div>

<!-- main-panel ends -->
<?php include("../partials/footer.php"); ?>