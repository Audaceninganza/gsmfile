<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../../php/functions.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userdata']) || !isset($_SESSION['userdata']['user_id'])) {
    header("Location: https://aiinfogsm.com/?login");
    exit();
}

$user_id = (int)$_SESSION['userdata']['user_id'];

// Validate required parameters
if (!isset($_GET['file_id']) || !isset($_GET['folder']) || !isset($_GET['file'])) {
    die("Missing required parameters.");
}

$file_id = (int)$_GET['file_id'];
$folder = htmlspecialchars($_GET['folder'], ENT_QUOTES, 'UTF-8');
$file_encoded = $_GET['file'];
$file_link = base64_decode($file_encoded);

// Validate file URL
if (!filter_var($file_link, FILTER_VALIDATE_URL)) {
    die("Invalid file URL.");
}

header('Location: ' . $file_link);


// Check if the user has paid for this file
// $query = $db->prepare("SELECT payment_status FROM payments WHERE user_id = ?");
// $query->bind_param("i", $user_id);
// $query->execute();
// $result = $query->get_result();

// if ($result->num_rows === 0) {
//     // No payment record found, create one with 'pending' status
//     $insertQuery = $db->prepare("INSERT INTO payments (user_id, file_id, payment_status) VALUES (?, ?, 'pending')");
//     $insertQuery->bind_param("ii", $user_id, $file_id);
//     if (!$insertQuery->execute()) {
//         die("Failed to create payment record: " . $db->error);
//     }
//     $payment_status = 'pending';
// } else {
//     $payment = $result->fetch_assoc();
//     $payment_status = trim($payment['payment_status']);
// }

// if ($payment_status === 'completed') {
//     // Check if the file has already been downloaded
//     $fileQuery = $db->prepare("SELECT file_id FROM downloads WHERE user_id = ? AND file_id = ?");
//     $fileQuery->bind_param("ii", $user_id, $file_id);
//     $fileQuery->execute();
//     $fileResult = $fileQuery->get_result();

    // if ($fileResult->num_rows === 0) {
    //     // Check if the user has reached the new download limit (excluding previously downloaded files)
    //     $limit = 2;
    //     $checkDownloads = $db->prepare("SELECT COUNT(*) as new_downloads FROM downloads WHERE user_id = ?");
    //     $checkDownloads->bind_param("i", $user_id);
    //     $checkDownloads->execute();
    //     $downloadResult = $checkDownloads->get_result()->fetch_assoc();
    //     $new_downloads = (int) $downloadResult['new_downloads'];

    // if ($new_downloads >= $limit) {
    //     header("Location: ../package.php");
    //     exit();
    // } else {
    //     // Insert new file download
    //     $insertDownload = $db->prepare("INSERT INTO downloads(user_id, file_id, downloaded) VALUES (?, ?, 1)");
    //     $insertDownload->bind_param("ii", $user_id, $file_id);
    //     if (!$insertDownload->execute()) {
    //         die("Failed to download: " . $db->error);
    //     }
    // }
    // }

    // Redirect to file link (user can download paid files anytime)
    // header('Location: ' . $file_link);
//     exit();
// } else {
//     // Show payment pending page
//     echo '
//     <!DOCTYPE html>
//     <html lang="en">
//     <head>
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <title>Payment Pending</title>
//         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
//         <style>
//             body {
//                 font-family: Arial, sans-serif;
//                 display: flex;
//                 justify-content: center;
//                 align-items: center;
//                 height: 100vh;
//                 background-color: #f9f9f9;
//             }
//             .payment-container {
//                 text-align: center;
//                 background-color: #fff;
//                 padding: 20px;
//                 border-radius: 10px;
//                 box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
//                 max-width: 600px;
//                 width: 100%;
//             }
//             .payment-container img {
//                 max-width: 100%;
//                 height: 40%;
//                 border: 3px solid #4CAF50;
//                 border-radius: 10px;
//                 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
//                 margin-bottom: 20px;
//             }
//             .payment-container h1 {
//                 color: #333;
//                 margin: 10px 0;
//             }
//             .choose-plan-btn {
//                 display: inline-block;
//                 background-color: #4CAF50;
//                 color: white;
//                 padding: 10px 20px;
//                 font-size: 18px;
//                 border-radius: 5px;
//                 text-decoration: none;
//                 text-align: center;
//                 box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
//                 transition: background-color 0.3s ease;
//                 margin-top: 20px;
//             }
//             .choose-plan-btn:hover {
//                 background-color: #45a049;
//             }
//         </style>
//     </head>
//     <body>
//         <!-- Payment Pending Modal -->
//         <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
//             <div class="modal-dialog">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h5 class="modal-title" id="paymentModalLabel">Payment Pending</h5>
//                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                     </div>
//                     <div class="modal-body">
//                         <h1>Your payment is pending</h1>
//                         <p>Please complete your payment to access the file.</p>
//                     </div>
//                     <div class="modal-footer">
//                         <a href="../package.php" class="btn btn-primary">Choose a Plan</a>
//                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                     </div>
//                 </div>
//             </div>
//         </div>

//         <!-- Payment Content After Modal -->
//         <div class="payment-container">
//             <img src="payment.jpg" alt="Payment">
//             <h1>Pay to download this file</h1>
//             <a href="../package.php" class="choose-plan-btn">Choose Plan</a>
//         </div>

//         <!-- Bootstrap JS -->
//         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

//         <!-- Auto-trigger the modal -->
//         <script>
//             document.addEventListener("DOMContentLoaded", function() {
//                 var paymentModal = new bootstrap.Modal(document.getElementById("paymentModal"));
//                 paymentModal.show();
//             });
//         </script>
//     </body>
//     </html>';
//     exit();
// }
