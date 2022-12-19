
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php



if (empty($_GET['id'])) {
    if ($session->user_role == 'admin') {
        redirect("post_comments.php");
    } else {
        redirect("comments.php");
    }
}

$comment = Comment::find_by_id($_GET['id']);


if (isset($_POST['update'])) {
    if ($comment) {
        $title = strlen($comment->body) > 20 ? substr($comment->body, 0, 20) . "..." : substr($comment->body, 0, 20);
        if ($session->user_role == 'admin') {
            if (!isset($_POST['comment_status']) || empty($_POST['comment_status']) || $_POST['comment_status'] == 'Choose...') {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Comment status needs to be selected</h3>");
            } else {
                $comment->comment_status = $_POST['comment_status'];
                //notification
                if ($_POST['comment_status'] == 'flagged') {
                    $notification_message = "your comment <b>$title</b> has been flagged and removed from view. The comment violates the blog's terms and conditions. Please edit or remove the comment post.";
                    $action = 'flagged your comment';
                } else {
                    $notification_message = "your comment <b>$title</b> has been approved for others to view by admin. If this is not what you requested.Please contact support for assistance.";
                    $action = 'posted your comment';
                }
                $notify = new Notification();
                $notify->create_notification($session->user_id, $comment->author, $notification_message, $action);
            }
        } else {
            if (!isset($_POST['body']) || empty($_POST['body'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Comment cannot be blank</h3>");
            } else {
                $comment->body = $_POST['body'];
            }

            if ($comment->comment_status == 'flagged') {
                $notification_message = "users comment <b>$title</b> has been updated. <div><a class='btn btn-secondary' href='/blog/view/portal/pages/post_comments.php?highlight=$comment->id'>review comment</a></div>";
                $action = 'updated flagged comment';

                $admin = User::find_all_where('user_role', 'admin');
                foreach ($admin as $sendNotification) {
                    if ($sendNotification->user_role == 'admin') {
                        $notify = new Notification();
                        $notify->create_notification($session->user_id, $sendNotification->id, $notification_message, $action);
                    }
                }
            }
        }
        $comment->save();
        if ($session->user_role == 'admin') {
            redirect("post_comments.php");
            $update = $comment->comment_status;
        } else {
            redirect("comments.php");
            $update = $comment->body;
        }

        $session->message("<h3 class='bg-success p-2 text-white'>Comment with id: $comment->id has been updated to: $update </h3");
    } else {
        $session->message("Something went wrong. Please try again. ");
        if ($session->user_role == 'admin') {
            redirect("post_comments.php");
        } else {
            redirect("comments.php");
        }
    }
}
