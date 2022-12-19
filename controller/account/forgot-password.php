<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


$complete = "";
if (isset($_GET['id'])) {
    $user = User::find_by_id($_GET['id']);
}

if (isset($_POST['recover-submit'])) {

    $errorCount = 0;
    $email = trim($_POST['email']);

    $length = 50;

    $token = bin2hex(openssl_random_pseudo_bytes($length));
    $email_found = User::email_exists($email);

    if ($email_found) {
        $email_found->user_code = $token;
        $email_found->save();


        require '/Applications/XAMPP/xamppfiles/htdocs/blog/view/assets/vendor/autoload.php';

        $mailMessage =
            '<p>Please click to reset your password

                    <a href="localhost/BLOG/view/account/forgot-password.php?id=' . $email_found->id . '&token=' . $token . ' ">localhost/gallery/admin/forgot.php?email=' . $email . '&token=' . $token . '</a>



                    </p>';;

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'ifrahabdi@gmail.com';
        $mail->Password = '';
        $mail->setFrom('ifrahabdi@gmail.com', 'SAE Support');
        $mail->addReplyTo('ifrahabdi@gmail.com', 'Ifrah Abdi');
        $mail->addAddress("$email_found->user_email", "$email_found->username");
        $mail->Subject = 'SAE SHARE';
        $mail->msgHTML("$mailMessage");
        $mail->AltBody = 'This is a plain-text message body';
        $mail->addAttachment('');
        if ($mail->send()) {
            $emailSent = true;
        }
        $session->message("<h4 class='p-3 text-white bg-success'>{$email_found->username}, an email will be sent with instructions to reset your password.</h4>");
        header('Location:' . $_SERVER['PHP_SELF']);
    } else {
        $errorCount++;
        $session->message("<h4 class='p-3 text-white bg-danger'>Email not found. contact your instructor to register or the support team for help.</h4>");
        header('Location:' . $_SERVER['PHP_SELF']);
        die();
    }
}

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
        $currentInfo = User::find_by_id($_GET['id']);
        $currentInfo->password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
        $currentInfo->user_code = bin2hex(openssl_random_pseudo_bytes(50));
        $currentInfo->save();
        $session->message("<h4 class='p-3 text-white bg-success'>{$currentInfo->username}, Your registration is completed. Login below.</h4>");
        redirect("login.php");
    } else {
        $session->message($errors . '</ul></div>');
        header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
    }
}
