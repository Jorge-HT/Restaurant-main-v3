<?php
// Read the contents
$file = 'plate.txt';

// Check if the file exists and get the contents
$orderItems = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

// Return the count of items in the plate
echo json_encode(['itemsCount' => count($orderItems)]);
?>