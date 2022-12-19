<?php

if (isset($_POST['complete'])) {
    // reset password
    $errorCount = 0;
    $validation = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/';
    $errors = "<div class='p-3 text-white bg-danger'>Please fix the following error(s) <ul class='ml-3'>";
    //empty field
    if (empty($_POST['password']) || empty($_POST['confirmPassword']) || !isset($_POST['confirmPassword'], $_POST['password'])) {
        $errors .= "<li>Password cannot be blank.</li>";
        $errorCount++;
    }

    if ($_POST['password'] !== $_POST['confirmPassword']) {
        $errors .= "<li>Passwords do not match.</li>";
        $errorCount++;
    }


    //regex expression
    if (preg_match($validation, $_POST['password']) === 0) {
        $errors .= "<li>Invalid password.</li>";
        $errorCount++;
    }

    if ($errorCount == 0) {
        $currentInfo = User::find_by_id($session->user_id);
        $currentInfo->password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
        $currentInfo->user_code = bin2hex(openssl_random_pseudo_bytes(50));
        $currentInfo->save();
        $session->message("<h4 class='p-3 text-white bg-success'>{$currentInfo->first_name}, Your password has been updated.</h4>");
        header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
    } else {
        $session->message($errors . '</ul>
</div>');
        header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
    }
}
