<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the Composer autoloader
require '../vendor/autoload.php';

// Read the current contents of the plate (the user's order)
$file = __DIR__ . '/plate.txt'; // Ensure the correct path

// Check if the file exists and read it
$orderItems = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

// Initialize the total
$total = 0;
$itemsHtml = '';

// Process each item to display and calculate the total
foreach ($orderItems as $item) {
    // Extract the price from each item (assuming the format is Item ($price))
    if (preg_match('/\$(\d+\.\d{2})/', $item, $matches)) {
        $price = floatval($matches[1]);
        $total += $price;
        $itemsHtml .= "<p>$item</p>";
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    // Sanitize email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address. Please try again.";
    } else {
        // Create PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 't3stdumm3@gmail.com'; // Your email address
            $mail->Password = 'gkkgkwekqjbcynin'; // Your app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set sender and recipient
            $mail->setFrom('t3stdumm3@gmail.com', 'Los Pollos Hermanos');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your Order from Los Pollos Hermanos';
            $mail->Body    = "
                <h1>Thank you for your order!</h1>
                <p>Here are your items:</p>
                $itemsHtml
                <h2>Total: $" . number_format($total, 2) . "</h2>
                <p>We'll send you a confirmation soon.</p>
            ";

            // Send the email
            $mail->send();

            // Clear the plate file after successful email
            file_put_contents($file, '');

            // Redirect to confirmation page
            header("Location: confirmation.php");
            exit;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
    <body>
        <h1>Your Order</h1>

        <!-- Display the order items -->
        <div id="order-items">
            <?php echo $itemsHtml; ?>
        </div>

        <h2>Total: $<?php echo number_format($total, 2); ?></h2>

        <!-- Email form -->
        <h3>Enter Your Email for Confirmation:</h3>
        <form action="checkout.php" method="POST">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" required><br><br>

            <button type="submit" name="confirm_order">Confirm Order</button>
        </form>
    </body>
</html>
