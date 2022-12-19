
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php



if (empty($_GET['id'])) {

    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);


if (isset($_POST['create'])) {


    if ($user) {


        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->user_role = $_POST['user_role'];
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
        }
        if (empty($_FILES['user_image'])) {
            $user->save();
            redirect("users.php");
            $session->message("<h4 class='p-3 text-white bg-success'>The user has been updated</h4>");
        } else {
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            $session->message("<h4 class='p-3 text-white bg-success'>The user has been updated</h4>");
            redirect("all_users.php");
        }
    }
}
