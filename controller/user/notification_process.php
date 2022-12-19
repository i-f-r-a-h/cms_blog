<?php


if (isset($_GET['read']) && $_GET['read'] == true) {
    $update = Notification::notification(0, $session->user_id);
    foreach ($update as $read) {
        $read->status = 1;
        $read->save();
        echo "updated";
    }
    header('Location:' . $_SERVER['PHP_SELF']);
}
