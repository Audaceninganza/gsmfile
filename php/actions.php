<?php
require_once "functions.php";
require_once 'send_code.php';


//for managaing signup
if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        if (createUser($_POST)) {
            header("location:../?login");
        } else {
            echo "<script>alert('somethihng is wrong')</script>";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../?signup");
    }
}

//for managing login
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);

    if ($response['status']) {
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $response['user'];

        if ($response['user']['mail_verify'] == 0) {
            $_SESSION['code'] = $code = rand(111111, 999999);
            sendCode($response['user']['email'], 'Verify Your Email', $code);
        }
        header("location:../");
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../?login");
    }
}


//     // Handle redirect if ?redirect is set
// if (isset($_GET['redirect'])) {
//     // If not authenticated, go to login
//     if (!isset($_SESSION['Auth'])) {
//         header("Location: ../?login");
//     } else {
//         // If authenticated, go to download (redirect.php)
//         header("Location: ../parts/redirect.php?file=" . urlencode($_GET['file']) . "&file_id=" . urlencode($_GET['file_id']));
//     }
// }

if (isset($_GET['redirect'])) {
    // If not authenticated, go to login
    if (!isset($_SESSION['Auth'])) {
        header("Location: ../?login");
    } else {
        // If authenticated, go to download (redirect.php)
        $file = urlencode($_GET['file']);
        $file_id = urlencode($_GET['file_id']);
        $folder = isset($_GET['folder']) ? urlencode($_GET['folder']) : 'default';  // Default folder if not passed

        // Redirect to redirect.php with file, file_id, and folder parameters
        header("Location: ../parts/redirect.php?file=$file&file_id=$file_id&folder=$folder");
    }
}

if (isset($_GET['frpbypass'])) {
    // If not authenticated, go to login
    if (!isset($_SESSION['Auth'])) {
        header("Location: ../?login");
        exit(); // Stop script
    } else {
        include("parts/frpbypass.php");
        exit(); // Stop script
    }
}


if (isset($_GET['resend_code'])) {

    $_SESSION['code'] = $code = rand(111111, 999999);
    sendCode($_SESSION['userdata']['email'], 'Verify Your Email', $code);
    header('location:../?resended');
}

//for verifying email

if (isset($_GET['verify_email'])) {
    $user_code = isset($_POST['code']) ? $_POST['code'] : '';
    $code = $_SESSION['code'] ?? '';

    if ($code == $user_code) {
        if (verifyEmail($_SESSION['userdata']['email'])) {
            header('location:../');
            exit();
        } else {
            echo "Something is wrong with the email verification.";
        }
    } else {
        $response['msg'] = 'Incorrect verification code!';
        if (empty($user_code)) {
            $response['msg'] = 'Enter 6 digit code!';
        }
        $response['field'] = 'email_verify';
        $_SESSION['error'] = $response;
        header('location:../');
        exit();
    }
}
