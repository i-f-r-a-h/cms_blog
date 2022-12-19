<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php


if (isset($_FILES['file'])) {

    $photo = new User_photo();
    $photo->user_image = $_POST['title'];
    $photo->set_file($_FILES['file']);

    if ($photo->save()) {
        $message = "Photo {$photo->filename} uploaded successfully";
    } else {
        $message = join("<br>", $photo->errors);
    }
}
