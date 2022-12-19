<?php include("../partials/header.php"); ?>
<?php include('../../../controller/user/display_profile.php'); ?>
<div class="main-panel">
    <!-- heading -->
    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <img class="rounded-circle profile-img" src="../../../<?php echo $user->image_path_and_placeholder() ?>" alt="">
                                    <div class=" ml-4 d-flex justify-content-center flex-column">

                                        <h2><?php echo $user->first_name . " " . $user->last_name ?></h2>
                                        <h4 class="mb-3">@<?php echo $user->username ?></h4>
                                        <p><?php echo $campus->campus_name ?></p>
                                        <?php if (isset($_GET['profile'])) {
                                            if ($session->user_id == $_GET['profile']) {
                                                echo "<a class='' href='./settings/index.php'>edit profile</a>";
                                            }
                                        } else {
                                            echo "<a class='' href='./settings/index.php'>edit profile</a>";
                                        } ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- sidebar -->
                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin ">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="card-title card-title-dash"><?php echo $session->username ?>'s Stats</h4>
                                                </div>
                                                <div class="list-wrapper">
                                                    <ul class="todo-list todo-list-rounded">
                                                        <!-- posts -->
                                                        <li class="d-block align-items-center my-3 pb-2">
                                                            <div class="d-flex">
                                                                <i class="fs-5 fa-solid fa-newspaper"></i>
                                                                <p class="fs-5 ml-3"><?php echo $post_count
                                                                                        ?> posts published </p>
                                                            </div>
                                                        </li>
                                                        <!-- comments -->
                                                        <li class="d-block align-items-center my-3 pb-2">
                                                            <div class="d-flex">
                                                                <i class="fs-5 fa-solid fa-comment"></i>
                                                                <p class="fs-5 ml-3"><?php echo $comment_count
                                                                                        ?> comments written </p>
                                                            </div>
                                                        </li>
                                                        <!-- tags -->
                                                        <li class="d-block align-items-center my-3 pb-2">
                                                            <div class="d-flex">
                                                                <i class="fs-5 fa-solid fa-hashtag"></i>
                                                                <p class="fs-5 ml-3"><?php echo count(Like::find_all_where('user_id', $session->user_id));
                                                                                        ?> posts liked </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main content -->
                    <div class="col-lg-8 d-flex flex-column">
                        <!-- comments -->
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">

                                        <div>
                                            <h4 class="card-title card-title-dash">Recent Comments</h4>
                                        </div>

                                        <?php if (count($comments) > 0) {

                                            foreach ($comments as $comment) { ?>
                                                <div class="d-flex flex-column my-4 border-bottom">

                                                    <h5 class="fw-bold"><?php $comment_post = Post::find_by_id($comment->post_id);
                                                                        echo substr($comment_post->title, 0, 20);
                                                                        ?></h5>
                                                    <div>
                                                        <p><?php echo  strlen($comment->body) > 80 ? substr($comment->body, 0, 80) . "..." : substr($comment->body, 0, 80); ?> <span class="float-right"><?php echo substr($comment->comment_date, 0, 10)   ?></span></p>

                                                    </div>
                                                </div>
                                        <?php }
                                        } else {
                                            echo "No comments yet";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-grow">
                            <h2 class="mb-3 mt-5"><?php echo $session->username ?>'s posts</h2>
                            <?php if (count($posts) > 0) {
                                foreach ($posts as $post) { ?>
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <a class="text-decoration-none text-black" href="/blog/view/public/post.php?id=<?php echo $post->id; ?>">
                                                    <p>Posted on <?php echo substr($post->post_date, 0, 10); ?></p>

                                                    <h3 class="mb-3"><?php echo strlen($post->title) > 60 ? substr($post->title, 0, 60) . "..." : substr($post->title, 0, 60); ?></h3>


                                                    <!-- reactions -->
                                                    <div class="d-flex gap-3">
                                                        <div class="date"><i class="fa-solid fa-thumbs-up"></i><?php echo $post->likes == null ? 0 : $post->likes; ?> likes</div>
                                                        <div class="comments meta-last"> <i class="fa-solid fa-comment"></i>
                                                            <?php
                                                            $comments = Comment::find_the_comments($post->id);
                                                            echo count($comments);
                                                            ?> comments</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                            <?php }
                            } else {
                                echo "<div class='col-12 grid-margin card card-rounded card-body'>No posts yet</div>";
                            } ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- profile section -->

<?php include("../partials/footer.php"); ?>