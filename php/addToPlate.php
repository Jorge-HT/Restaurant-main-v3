<?php
// Set the response header for JSON content
header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Read the incoming JSON data
$input = json_decode(file_get_contents('php://input'), true);

// Check if the 'item' key exists in the received data
if (isset($input['item'])) {
    $item = $input['item'];

    // Specify the file to update (or create if it doesn't exist)
    $file = 'plate.txt';

    // Debug: Log received data
    error_log("Received item: " . $item);

    // Read the current contents of the plate (if it exists)
    $currentPlate = file_exists($file) ? file_get_contents($file) : '';

    // Append the new item to the plate (you can modify the formatting as needed)
    $currentPlate .= "\n" . $item;

    // Debug: Log current plate before writing
    error_log("Current plate contents:\n" . $currentPlate);

    // Write the updated contents back to the file
    $result = file_put_contents($file, $currentPlate);

    // Check if writing was successful
    if ($result === false) {
        // Log error if writing to the file failed
        error_log("Error writing to plate.txt.");
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update plate file.'
        ]);
    } else {
        // Respond with the updated plate content
        echo json_encode([
            'status' => 'success',
            'message' => 'Item added to plate.',
            'updatedPlate' => nl2br($currentPlate) // Format the plate as HTML line breaks
        ]);
    }
} else {
    // If no 'item' key was received, return an error
    echo json_encode([
        'status' => 'error',
        'message' => 'No item received.'
    ]);
}
?>