<?php
include_once "php/actions.php";
global $user;
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Full height of the viewport */
      margin: 0; /* Remove default margin */
      background-color: #2c3e50; /* Dark background for contrast */
      font-family: Arial, sans-serif; /* Set a clean font */
      color: white; /* Default text color */
    }
    .verifyContainer {
      background-color: #34495e; /* Slightly lighter background for the container */
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Add shadow for depth */
      padding: 30px; /* Increased padding for better spacing */
      width: 300px; /* Fixed width for the container */
      text-align: center; /* Center text inside the container */
    }
    h1 {
      margin-bottom: 20px; /* Space below the heading */
      font-size: 24px; /* Larger font size for the heading */
    }
    p {
      margin-bottom: 15px; /* Space below the paragraph */
      font-size: 14px; /* Smaller font size for the paragraph */
    }
    input {
      padding: 10px; /* Increased padding for input */
      border: 1px solid #2980b9; /* Blue border */
      border-radius: 5px;
      margin-bottom: 15px; /* Space below the input */
      width: 100%; /* Full width of the container */
      box-sizing: border-box; /* Include padding and border in width */
      font-size: 16px; /* Font size for input */
    }
    input:focus {
      outline: none; /* Remove default outline */
      border: 1px solid #3498db; /* Lighter blue border on focus */
    }
    .success {
      color: #2ecc71; /* Green color for success messages */
      margin-bottom: 15px; /* Space below success message */
    }
    .flexVerify {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .flexVerify button {
      padding: 10px; /* Increased padding for button */
      border: none;
      background-color: #2980b9; /* Button background color */
      border-radius: 5px;
      color: whitesmoke;
      cursor: pointer; /* Pointer cursor on hover */
      transition: background-color 0.3s; /* Smooth transition for hover effect */
    }
    .flexVerify button:hover {
      background-color: #3498db; /* Lighter blue on hover */
    }
    .flexVerify a {
      text-decoration: none;
      color: #ecf0f1; /* Light color for links */
      font-size: 14px; /* Font size for links */
    }
    .flexVerify a:hover {
      text-decoration: underline; /* Underline on hover */
    }
  </style>
</head>
<body>
  <div class="verifyContainer">
    <form action="php/actions.php?verify_email" method="post">
      <h1>Verify Your Email</h1>
      <p>Enter the 6-Digit Code Sent to You (<?= htmlspecialchars($user["email"]) ?>)</p>
      <input type="text" name="code" placeholder="######" required>
      <?php
      if (isset($_GET['resended'])) {
          echo '<p class="success">Verification Code Resent</p>';
      }
      ?>
      <?= showError('email_verify') ?> <!-- Ensure this function is defined -->
      <div class="flexVerify">
        <button type="submit">Verify Email</button>
        <a href="php/actions.php?resend_code">Resend</a>
      </div>
    </form>
  </div>
</body>
</html>