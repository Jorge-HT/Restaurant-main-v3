<?php
// Include Composer's autoloader (correct path)
require '../vendor/autoload.php'; 

// Read the current contents of the plate (the user's order)
$file = 'plate.txt';

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
    $email = $_POST['email'];
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'T3estDumm3@gmail.com'; 
        $mail->Password = 'jvfpocsxhoujwrlz'; // Use your app-specific password here
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        // Enable debugging output
        $mail->SMTPDebug = 2; // Enable debugging
        $mail->Debugoutput = 'html'; // HTML output for easier reading
    
        // Recipients
        $mail->setFrom('T3estDumm3@gmail.com', 'Los Pollos Hermanos');
        $mail->addAddress($email);
    
        // Content
        $mail->isHTML(true);
        $mail->Subject = "Your Order from Los Pollos Hermanos";
        $mail->Body = "Thank you for your order! Here are your items:<br><br>" . $itemsHtml . "<br><br>" . "Total: $$total<br><br>We'll send you a confirmation soon.";
    
        // Send the email
        if ($mail->send()) {
            file_put_contents($file, '');
            header("Location: confirmation.php");
            exit;
        } else {
            echo "Error sending email. Please try again. <br>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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