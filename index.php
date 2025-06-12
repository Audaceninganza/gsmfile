<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "php/functions.php";
// Make sure session is started

// If already logged in and trying to access ?login, redirect to homepage
if (isset($_SESSION['Auth']) && isset($_GET['login'])) {
    header("Location: ./");
    exit();
}

// Check if the user is logged in and fetch user data
if (isset($_SESSION['Auth'])) {
    $user = getUser($_SESSION['userdata']['user_id']);
}

// If logged in and email is verified
if (isset($_SESSION['Auth']) && $user['mail_verify'] == 1) {
    if (isset($_GET['frpbypass'])) {
        showPage('header', ['page_title' => 'Aiinfogsm - FRP Bypass']);
        showPage('frpbypass');
    } elseif (isset($_GET['redirect'])) {
        header("Location: parts/redirect.php?file=" . urlencode($_GET['file']) . "&file_id=" . urlencode($_GET['file_id']));
        exit();
    } else {
        showPage('header', ['page_title' => 'Aiinfogsm - Home page']);
        showPage('wall');
    }
}

// If logged in but email not verified
elseif (isset($_SESSION['Auth']) && $user['mail_verify'] == 0) {
    showPage('verify_email');
}

// Not logged in
elseif (!isset($_SESSION['Auth'])) {
    if (isset($_GET['signup'])) {
        showPage('signup', ['page_title' => 'Aiinfogsm - SignUp']);
    } elseif (isset($_GET['login'])) {
        showPage('login', ['page_title' => 'Aiinfogsm - Login']);
    } else {
        // Default to login if nothing specified
        header("Location: ?login");
        exit();
    }
}

// Clear error messages after processing
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
