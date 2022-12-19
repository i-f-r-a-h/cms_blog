<?php
include('../../modal/engine/init.php');
if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['id'])) {

    redirect("../../view/portal/pages/add_users_image.php");
}

$image = User_photo::find_by_id($_GET['id']);

if ($image) {
    $image->delete();
    $session->message("<h3 class='bg-success p-2 text-white'>The image with id:{$image->id} has been deleted</h3>");
    redirect("../../view/portal/pages/add_users_image.php");
} else {
    redirect("../../view/portal/pages/add_users_image.php");
}
