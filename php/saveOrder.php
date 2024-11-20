<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $plate = $data['plate'];
    $email = $data['email'];

    // Save order to file
    $orderFile = fopen("orders.txt", "a");
    $orderDetails = "Order at " . date("Y-m-d H:i:s") . "\n";
    $totalPrice = 0;

    foreach ($plate as $item) {
        $orderDetails .= $item['name'] . " - $" . number_format($item['price'], 2) . "\n";
        $totalPrice += $item['price'];
    }
    $orderDetails .= "Total: $" . number_format($totalPrice, 2) . "\n\n";
    fwrite($orderFile, $orderDetails);
    fclose($orderFile);

    // Send receipt via email
    $subject = "Your Los Pollos Hermanos Receipt";
    $message = $orderDetails;
    $headers = "From: no-reply@lospolloshermanos.com";
    mail($email, $subject, $message, $headers);

    echo json_encode(["success" => true]);
}
?>