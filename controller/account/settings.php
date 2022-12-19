
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php

$user = User::find_by_id($session->user_id);
