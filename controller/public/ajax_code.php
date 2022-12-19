<?php include('../../modal/engine/init.php');

$user = new User();



if (isset($_POST['image_name'])) {
    $user->ajax_save_user_image($_POST['image_name'], $session->user_id);
}
