<?php
require_once("../../modal/engine/init.php");
$reg =  new Register();
$completed = "";


if (isset($_POST['submit-register'])) {

    $errorCount = 0;
    $errors = "<div class='bg-danger p-2 text-white mb-4'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";

    //if empty
    if ($reg->issetCheck('first_name')) {
        $errors .= "<li>All fields are required and cannot be blank.</li>";
        $errorCount++;
    }

    //|| $reg->issetCheck('last_name') || $reg->issetCheck('user_dob') || $reg->issetCheck('user_gender') || $reg->issetCheck('course') || $reg->issetCheck('campus') || $reg->issetCheck('profession') || $reg->issetCheck('level_of_study') || $reg->issetCheck('username') || $reg->issetCheck('password') || $reg->issetCheck('confirm')

    //username
    if ($reg->validateUsername()) {
        $errors .= $reg->validateUsername();
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

    //email
    if ($reg->validateEmail()) {
        $errors .= $reg->validateEmail();
        $errorCount++;
    }




    //enter data
    if ($errorCount == 0) {
        unset($errorCount);
        $reg->insertRegister();
        $completed = "<h4 class='p-3 text-white bg-success'>Registration completed. Redirecting to login ....</h4>";
        header("Refresh:3; url=login.php");
    } else {
        $session->message($errors . "</ul></div>");
        unset($errorCount);
        header('Location:' . $_SERVER['PHP_SELF']);
        die();
    }
}
