<?php
if (isset($_POST['user_image'])) {
    $user->ajax_save_user_image($_POST['user_image'], $_POST['user_id']);
}

$user = User::find_by_id($session->user_id);
$reg =  new Register();

if (isset($_POST['general'])) {
    $errorCount = 0;
    $errors = "<div class='bg-danger p-2 text-white mb-4'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";
    if ($user) {
        //email
        if (!$user->user_email == $_POST['user_email']) {
            if ($reg->validateEmail()) {
                $errors .= $reg->validateEmail();
                $errorCount++;
            }
        }
        //username
        if ($user->username == $_POST['username']) {
            $user->username = $_POST['username'];
            $user->user_email = $_POST['user_email'];
        } else {
            if ($reg->validateUsername()) {
                $errors .= $reg->validateUsername();
                $errorCount++;
            }
        }


        if ($errorCount == 0) {
            if (!empty($_FILES['user_image'])) {
                $user->set_file($_FILES['user_image']);
                $user->upload_photo();
            }
            $user->save();
            redirect($_SERVER['PHP_SELF']);

            $session->message("<h4 class='p-3 text-white bg-success'>Profile has been updated. Refresh page if changes do not display automatically</h4>");
        } else {
            $session->message($errors . "</ul></div>");
            unset($errorCount);
            header('Location:' . $_SERVER['PHP_SELF']);
            die();
        }
    }
}








if (isset($_POST['user_details'])) {
    $errorCount = 0;
    $errors = "<div class='bg-danger p-2 text-white mb-4'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";

    //if empty
    if ($reg->issetCheck('first_name')) {
        $errors .= "<li>All fields are required and cannot be blank.</li>";
        $errorCount++;
    }

    //age
    if (time() < strtotime('+17 years', strtotime($_POST['user_dob']))) {
        $errors .= "<li>You have to be 17+ to create join.</li>";
        $errorCount++;
    }

    //phone number
    if ($reg->validateTel()) {
        $errors .= $reg->validateTel();
        $errorCount++;
    }

    //enter data
    if ($errorCount == 0) {
        unset($errorCount);
        $reg->updateRegister($session->user_id);
        $session->message("<h4 class='p-3 text-white bg-success'>Profile has been updated. Refresh page if changes do not display automatically</h4>");
    } else {
        $session->message($errors . "</ul></div>");
        unset($errorCount);
        header('Location:' . $_SERVER['PHP_SELF']);
        die();
    }
}
