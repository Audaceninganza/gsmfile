<?php
$url = 'https://payid19.com/api/v1/create_invoice';  // API endpoint for creating an invoice

$post = [
    'public_key' => '8XpPdl1m8riBltYMeQg7Lvm9l',  // Your public API key
    'private_key' => 'BZK4VUjhka82EvLRqvP3gLdayeqA1GE85QIiBW6N',  // Your private API key
    'email' => 'audacephilo@email.com',  // Customer email
    'price_amount' => 1000,  // Amount for the invoice
    'price_currency' => 'USD',  // Currency
    'test' => 1, // Customer ID
    // Test mode flag
    'title' => 'Package 1',  // Title of the invoice
    'description' => 'payment for only 3 days',  // Description of the invoice
    'cancel_url' => 'http://localhost/GSM/parts/package.php',  // Cancel URL
    'success_url' => 'http://localhost/GSM',  // Success URL
    'callback_url' => 'http://localhost/GSM/parts/payment_callback.php',  // Webhook callback URL
    'expiration_date' => 1,  // Expiration time (hours)

];

$ch = curl_init();  // Initialize cURL session
curl_setopt($ch, CURLOPT_URL, $url);  // Set API URL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);  // Verify SSL certificate
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return the response
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));  // Attach POST data
$result = curl_exec($ch);  // Execute cURL request
curl_close($ch);  // Close cURL session


$response = json_decode($result);


if ($response && $response->status != 'error') {
    // Success: Redirect the user to the invoice URL
    $invoiceUrl = str_replace('\/', '/', $response->message);  // Convert escaped slashes
    header('Location: ' . $invoiceUrl);
    exit();  // Terminate script execution
} else {
    // Error: Handle the error response
    echo 'Error creating invoice: ' . ($response->message[0] ?? 'Unknown error');
}
