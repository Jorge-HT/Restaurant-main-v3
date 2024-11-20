<?php
// Get the item from the POST request
if (isset($_POST['item'])) {
    $item = $_POST['item'];

    // Define the path to the file where we want to save the items
    $file = 'plateItems.txt'; // This file will be saved in the same directory as the PHP script

    // Open the file in append mode (so new items are added at the end)
    $fileHandle = fopen($file, 'a');
    
    if ($fileHandle) {
        // Write the item to the file, followed by a newline character
        fwrite($fileHandle, $item . PHP_EOL);
        
        // Close the file
        fclose($fileHandle);

        // Success YIPPEEE
        echo "Item added to plate and saved to file.";
    } else {
        
        echo "Error: Unable to write to file.";
    }
} else {
    // If the 'item' parameter is not set, return an error message
    echo "Error: No item received.";
}