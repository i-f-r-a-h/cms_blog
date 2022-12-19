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
                                        View posts published to the website
                                    </p>
                                    <?php echo $message; ?>
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
                                                        Title
                                                    </th>
                                                    <th>
                                                        Category
                                                    </th>
                                                    <th>
                                                        Date posted
                                                    </th>
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
                                                $posts = Post::find_all();


                                                if (isset($_GET['highlight'])) {
                                                    $view = Post::find_by_id($_GET['highlight']);
                                                    $highlight = $view->id;
                                                ?>
                                                    <tr class="table-warning">

                                                        <td>
                                                            <?php echo $view->id ?>
                                                        </td>



                                                        <td>
                                                            <?php $author = user::find_by_id($view->author);
                                                            echo  $author ?  $author->username : '[author removed]'; ?>
                                                        </td>
                                                        <td class="wrapping">
                                                            <?php echo $view->title ?>
                                                        </td>
                                                        <td>
                                                            <?php $category = Category::find_by_id($view->category_id);
                                                            echo  $category ?  $category->category_title : '[category removed]'; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $view->post_date ?>
                                                        </td>
                                                        <?php if (isset($_GET['id']) && $_GET['id'] == $view->id) {
                                                            //update
                                                            if (isset($_POST['update'])) {
                                                                $update = Post::find_by_id($_GET['id']);
                                                                if ($update) {
                                                                    if (!isset($_POST['post_status']) || empty($_POST['post_status'])) {
                                                                        header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                                                                        $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
                                                                    } else {

                                                                        $update->post_status = $_POST['post_status'];
                                                                        $title = strlen($update->title) > 80 ? substr($update->title, 0, 20) . "..." : substr($update->title, 0, 20);
                                                                        //notification
                                                                        if ($update->post_status == 'flagged') {
                                                                            $notification_message = "your post titled <b>$title</b> has been flagged and removed from view. The post violates the blog's terms and conditions. Please edit or remove the blog post.";
                                                                            $action = 'flagged your post';
                                                                        } else {
                                                                            $notification_message = "your post titled <b>$title</b> has been published for others to view by admin. If this is not what you requested.Please contact support for assistance.";
                                                                            $action = 'posted your post to';
                                                                        }
                                                                        $notify = new Notification();
                                                                        $notify->create_notification($session->user_id, $post->author, $notification_message, $action);
                                                                        $update->save();
                                                                        redirect("all_posts.php?source=level");
                                                                        $session->message("<h4 class='p-3 text-white bg-success'> Post $post->id status has been successfully updated</h4>");
                                                                    }
                                                                } else {
                                                                    $session->message("Something went wrong. Please try again. ");
                                                                    redirect("all_posts.php?source=level");
                                                                }
                                                            }

                                                            //delete
                                                            if (isset($_GET['del']) && $_GET['del'] == 'post') {
                                                                $post = Post::find_by_id($_GET['id']);
                                                                if ($post) {
                                                                    $notify = new Notification();
                                                                    $title = strlen($post->title) > 80 ? substr($post->title, 0, 20) . "..." : substr($post->title, 0, 20);
                                                                    $notification_message = "your post titled <b>$title</b> has been deleted due to violating the blog's terms and conditions. Please contact admin for further enquires.";
                                                                    $action = 'removed your post';
                                                                    $notify->create_notification($session->user_id, $post->author, $notification_message, $action);

                                                                    $post->delete();
                                                                    $session->message("<h3 class='bg-success p-2 text-white'>The post with id:{$post->id} has been deleted</h3>");
                                                                    redirect("all_posts.php");
                                                                } else {
                                                                    redirect("all_posts.php");
                                                                }
                                                            }

                                                        ?>
                                                            <form class="forms-sample" method="post" enctype="multipart/form-data">
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select class="form-select  mt-2" id="floatingSelect" name="post_status" aria-label="Floating label select example">
                                                                            <option value="<?php echo $post->post_status ?>"><?php echo $post->post_status ?></option>
                                                                            <option value='published'>published</option>
                                                                            <option value='flagged'>flagged</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="submit" name="update" class="btn btn-primary me-2 text-white">Update</button>
                                                                </td>
                                                            </form>



                                                        <?php } else { ?>
                                                            <td>
                                                                <?php echo $view->post_status ?>
                                                            </td>
                                                            <td>
                                                                <a href="all_posts.php?id=<?php echo $post->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                <a href="all_posts.php?id=<?php echo $post->id; ?>&del=post"><i class="fa-solid fa-trash-can"></i></a>
                                                            </td>
                                                        <?php } ?>

                                                    </tr>


                                                    <?php   } else {
                                                    $highlight = 0;
                                                }

                                                foreach ($posts as $post) :
                                                    if ($post->id !== $highlight) { ?>
                                                        <tr>

                                                            <td>
                                                                <?php echo $post->id ?>
                                                            </td>



                                                            <td>
                                                                <?php $author = user::find_by_id($post->author);
                                                                echo  $author ?  $author->username : '[author removed]'; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $post->title ?>
                                                            </td>
                                                            <td>
                                                                <?php $category = Category::find_by_id($post->category_id);
                                                                echo  $category ?  $category->category_title : '[category removed]'; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $post->post_date ?>
                                                            </td>
                                                            <?php if (isset($_GET['id']) && $_GET['id'] == $post->id) {
                                                                //update
                                                                if (isset($_POST['update'])) {
                                                                    $update = Post::find_by_id($_GET['id']);
                                                                    if ($update) {
                                                                        if (!isset($_POST['post_status']) || empty($_POST['post_status'])) {
                                                                            header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                                                                            $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
                                                                        } else {

                                                                            $update->post_status = $_POST['post_status'];
                                                                            $title = strlen($update->title) > 80 ? substr($update->title, 0, 20) . "..." : substr($update->title, 0, 20);
                                                                            //notification
                                                                            if ($update->post_status == 'flagged') {
                                                                                $notification_message = "your post titled <b>$title</b> has been flagged and removed from view. The post violates the blog's terms and conditions. Please edit or remove the blog post.";
                                                                                $action = 'flagged your post';
                                                                            } else {
                                                                                $notification_message = "your post titled <b>$title</b> has been published for others to view by admin. If this is not what you requested.Please contact support for assistance.";
                                                                                $action = 'posted your post to';
                                                                            }
                                                                            $notify = new Notification();
                                                                            $notify->create_notification($session->user_id, $post->author, $notification_message, $action);
                                                                            $update->save();
                                                                            redirect("all_posts.php?source=level");
                                                                            $session->message("<h4 class='p-3 text-white bg-success'> Post $post->id status has been successfully updated</h4>");
                                                                        }
                                                                    } else {
                                                                        $session->message("Something went wrong. Please try again. ");
                                                                        redirect("all_posts.php?source=level");
                                                                    }
                                                                }

                                                                //delete
                                                                if (isset($_GET['del']) && $_GET['del'] == 'post') {
                                                                    $post = Post::find_by_id($_GET['id']);
                                                                    if ($post) {
                                                                        $notify = new Notification();
                                                                        $title = strlen($post->title) > 80 ? substr($post->title, 0, 20) . "..." : substr($post->title, 0, 20);
                                                                        $notification_message = "your post titled <b>$title</b> has been deleted due to violating the blog's terms and conditions. Please contact admin for further enquires.";
                                                                        $action = 'removed your post';
                                                                        $notify->create_notification($session->user_id, $post->author, $notification_message, $action);

                                                                        $post->delete();
                                                                        $session->message("<h3 class='bg-success p-2 text-white'>The post with id:{$post->id} has been deleted</h3>");
                                                                        redirect("all_posts.php");
                                                                    } else {
                                                                        redirect("all_posts.php");
                                                                    }
                                                                }

                                                            ?>
                                                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <select class="form-select  mt-2" id="floatingSelect" name="post_status" aria-label="Floating label select example">
                                                                                <option value="<?php echo $post->post_status ?>"><?php echo $post->post_status ?></option>
                                                                                <option value='published'>published</option>
                                                                                <option value='flagged'>flagged</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" name="update" class="btn btn-primary me-2 text-white">Update</button>
                                                                    </td>
                                                                </form>



                                                            <?php } else { ?>
                                                                <td>
                                                                    <?php echo $post->post_status ?>
                                                                </td>
                                                                <td>
                                                                    <a href="all_posts.php?id=<?php echo $post->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                                                                    <a href="all_posts.php?id=<?php echo $post->id; ?>&del=post"><i class="fa-solid fa-trash-can"></i></a>
                                                                </td>
                                                            <?php } ?>

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