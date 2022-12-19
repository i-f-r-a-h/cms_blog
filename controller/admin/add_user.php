<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php



$user = new User();

if (isset($_POST['create'])) {


    if ($user) {


        $user->username = $_POST['username'];
        $user->user_email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->user_role = $_POST['user_role'];

        $user->user_dob = "0000-00-00";
        $user->set_file($_FILES['user_image']);
        $user->upload_photo();
        $session->message("The user {$user->username} has been added");
        $user->save();
        redirect("all_users.php");
    }
}
