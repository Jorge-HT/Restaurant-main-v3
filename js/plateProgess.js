// Function to add an item to the plate
function addToPlate(item) {
    console.log("Adding item:", item); // Debugging: Log the item being added

    // Send the item data to the PHP script via a POST request
    fetch('php/addToPlate.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ item: item }) // Send the item as JSON
    })
    .then(response => response.json()) // Parse the JSON response from PHP
    .then(data => {
        console.log("Response from PHP:", data); // Debugging: Log the PHP response

        if (data.status === 'success') {
            // If the item was successfully added, update the plate section
            document.getElementById('plate-progress').innerHTML = data.updatedPlate;
        } else {
            // Log an error if something went wrong
            console.error("Error:", data.message);
        }
    })
    .catch(error => console.error("Fetch error:", error)); // Log any fetch-related errors
}

// This function is called when an item is added to the plate
function addItemToPlate(item) {
    addToPlate(item);
}