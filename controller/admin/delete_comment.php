<?php
include('../../modal/engine/init.php');
if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['id'])) {
    if ($session->user_role == 'admin') {
        redirect("../../view/portal/pages/post_comments.php");
    } else {
        redirect("../../view/portal/pages/comments.php");
    }
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {

    $comment->delete();
    $session->message("<h3 class='bg-success p-2 text-white'>The comment with id:{$comment->id} has been deleted</h3>");
    if ($session->user_role == 'admin') {
        redirect("../../view/portal/pages/post_comments.php");
    } else {
        redirect("../../view/portal/pages/comments.php");
    }
} else {
    if ($session->user_role == 'admin') {
        redirect("../../view/portal/pages/post_comments.php");
    } else {
        redirect("../../view/portal/pages/comments.php");
    }
}
