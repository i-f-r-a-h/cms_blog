<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php




$message = "";
if (isset($_FILES['file'])) {

    $photo = new Post();
    $photo->title = $_POST['title'];
    $photo->post_date;
    $photo->set_file($_FILES['file']);
    $photo->upload_photo();
    $photo->save();



    if ($photo->save()) {
        $message = "Photo {$photo->filename} uploaded successfully";
    } else {

        $message = join("<br>", $photo->errors);
    }
}
