<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}
$the_message = "";
$likes = LIKE::find_all_where('user_id', $session->user_id);
$user = USER::find_by_id($session->user_id);
if (isset($_POST['delete_account'])) {
    if ($user) {
        foreach ($likes as $like) {
            $like->delete();
        }

        $user->delete();
        $session->logout();
        header("Refresh:5; url=../../../../view/public/index.php");
        $the_message = '<h5 class="bg-success p-2 text-white"> Your account has been deleted. Redirecting to blog...</h5>';
    }
}
