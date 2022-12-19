
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php



if (empty($_GET['id'])) {
    redirect("posts.php");
}

$posts = Post::find_by_id($_GET['id']);


if (isset($_POST['create'])) {

    unset($errorCount);
    $errorCount = 0;
    $errorsValue = "<div class='bg-danger p-2 text-white mb-4'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";



    if ($_POST['user_role'] == 'choose') {
        $errorsValue .= "<p class='bg-danger p-2 text-white'>Choose the status of this post</p>";
        $errorCount++;
    }

    if (empty($_POST['title'])) {
        $errorsValue .= "<p class='bg-danger p-2 text-white'>Title cannot be blank</p>";
        $errorCount++;
    }

    if (empty($_POST['description'])) {
        $errorsValue .= "<p class='bg-danger p-2 text-white'>Main content of post cannot be blank</p>";
        $errorCount++;
    }


    try {
        if ($errorCount == 0) {
            if ($posts->post_status == 'flagged' && $_POST['user_role'] == 'published') {
                $title = strlen($posts->title) > 20 ? substr($posts->title, 0, 20) . "..." : substr($posts->title, 0, 20);
                $notification_message = "users article <b>$title</b> has been updated. <div><a class='btn btn-secondary' href='/blog/view/portal/pages/all_posts.php?highlight=$posts->id&id=$posts->id'>review post</a></div>";
                $action = 'updated flagged article';

                $admin = User::find_all_where('user_role', 'admin');
                foreach ($admin as $sendNotification) {
                    if ($sendNotification->user_role == 'admin') {
                        $notify = new Notification();
                        $notify->create_notification($session->user_id, $sendNotification->id, $notification_message, $action);
                    }
                }
            }
            if (!empty($_FILES['image'])) {
                $posts->set_file($_FILES['image']);
                $posts->upload_post();
            }
            $posts->title = $_POST['title'];
            $posts->content = $_POST['content'];
            $posts->description = $_POST['description'];
            $_POST['category_id'] !== 'choose' ?? $posts->category_id = $_POST['category_id'];
            $posts->save();
            $session->message("<h4 class='p-3 text-white bg-success'>The post has been updated</h4>");
            redirect("posts.php");
            unset($errorCount);
        } else {
            $session->message($errorsValue . "</ul></div>");
            unset($errorCount);
            header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
            die();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
