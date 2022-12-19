<?php
include('../../modal/engine/init.php');
if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['id'])) {
    redirect("../../view/portal/shared/notifications.php");
} else {
    if ($_GET['id'] == 'all') {
        $update = Notification::find_all();
        foreach ($update as $delete) {
            $delete->delete();
        }
        $session->message("<h3 class='bg-success p-2 text-white'>All notification(s) have been deleted</h3>");
        redirect("../../view/portal/shared/notifications.php");
    } else {
        $notify = Notification::find_by_id($_GET['id']);

        if ($notify) {
            $notify->delete();
            $session->message("<h3 class='bg-success p-2 text-white'>The notification have been deleted</h3>");
            redirect("../../view/portal/shared/notifications.php");
        } else {
            redirect("../../view/portal/shared/notifications.php");
        }
    }
}
