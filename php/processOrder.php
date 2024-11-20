<?php
// Check if the form was submitted
if (isset($_POST['confirm_order'])) {
    // Get the email from the form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Read the plate.txt file to get the order
    $file = 'plate.txt';
    $orderItems = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
    
    // Calculate the total
    $total = 0;
    $itemsHtml = '';
    foreach ($orderItems as $item) {
        if (preg_match('/\$(\d+\.\d{2})/', $item, $matches)) {
            $price = floatval($matches[1]);
            $total += $price;
            $itemsHtml .= "$item<br>";
        }
    }

    // Prepare the email content
    $subject = "Your Order Confirmation - Los Pollos Hermanos";
    $message = "<h3>Thank you for your order!</h3>
                <h4>Your order details:</h4>
                <p>$itemsHtml</p>
                <h4>Total: $" . number_format($total, 2) . "</h4>
                <p>We will prepare your order and send a confirmation once it's ready.</p>";

    // Set headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: orders@lospolloshermanos.com" . "\r\n";

    // Send the email
    if (mail($email, $subject, $message, $headers)) {
        echo "<h2>Order Confirmed!</h2>";
        echo "<p>Your order has been placed successfully. A confirmation email has been sent to $email.</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>There was an issue sending your confirmation email. Please try again.</p>";
    }
} else {
    echo "<p>No order submitted.</p>";
}
file_put_contents($file, ''); // Clear the plate.txt file
?>