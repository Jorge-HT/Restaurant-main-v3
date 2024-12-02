<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Kimberle Ramirez">
        <title>Search List</title>
        <style>
            /* Add CSS to control the size of the images */
            .menu-item {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                border-bottom: 1px solid #ddd;
                padding-bottom: 10px;
            }

            .imgside img {
                width: 150px; /* Set the width of the image */
                height: auto; /* Maintain aspect ratio */
                object-fit: cover; /* Ensure the image is properly cropped if it's too large */
            }

            .imgtext {
                margin-left: 20px;
            }

            .arrow-button {
                margin-left: auto;
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .arrow-button:hover {
                background-color: #0056b3;
            }

            .return-button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                text-align: center;
            }

            .return-button:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <!-- Return to Main Page Button -->
        <a href="../index.html" class="return-button">Return to Main Page</a>

        <?php
        // Array of menu items, each item is an associative array with name, description, and image
        $menuItems = [
            ['name' => 'Huevos Rancheros ($5.49) (Breakfast)', 'description' => 'pan fried potatoes, flour tortilla, cheese, pinto beans, chile, two eggs', 'image' => 'bf1.jpeg'],
            ['name' => 'Carne Adovada Rancheros ($5.99) (Breakfast)', 'description' => 'home adovada, pan fried potatoes, flour tortilla, cheese, pinto beans, chile, two eggs', 'image' => 'bf2.jpeg'],
            ['name' => 'Pollo Classic Biscuit($2.99) (Breakfast)', 'description' => 'Chicken, bread crumbs, biscuit, pickles.', 'image' => 'pollobis.jpeg'],
            ['name' => 'Pollo Classic Breakfast ($2.99)', 'description' => 'Chicken, bread crumbs, eggs, potato.', 'image' => 'bf4.jpeg'],
            ['name' => 'Taco Rancheros ($5.99) (Breakfast)', 'description' => 'chile, black beans, steak, lettuce, cheese sauce, rice, salsa, green onions, flour tortilla.', 'image' => 'bf3.jpeg'],
            ['name' => 'Enchilada Platter ($5.99)', 'description' => 'Beef, sour cream, corn tortilla, cheese, black beans, spinach, jalapeno peppers.', 'image' => 'enchilada.jpeg'],
            ['name' => 'Burrito Platter ($5.99)', 'description' => 'chile, black beans, steak, lettuce, cheese sauce, rice, salsa, green onions, flour tortilla', 'image' => 'birritoplatter.jpeg'],
            ['name' => 'Birria Burrito Platter ($5.99)', 'description' => 'Birria, cilantro, flour tortilla, onions, chile, rice, beans.', 'image' => 'birriaburro.jpeg'],
            ['name' => 'Birria Tacos Platter ($5.99)', 'description' => 'Birria, cilantro, corn tortilla, onions, chile.', 'image' => 'birria.jpeg'],
            ['name' => 'Indian Taco Platter ($5.69)', 'description' => 'Indian fry bread, beef, green chile, lettuce, cheese, tomato, salsa.', 'image' => 'IndianTaco.jpeg'],
            ['name' => 'Taco Salad Platter ($5.69)', 'description' => 'Flour tortilla, beef, green chile, lettuce, cheese, tomato, salsa, beans, sour cream, guacamole.', 'image' => 'tacosalad.webp'],
            ['name' => 'Kiddie Chicken Tenders & Fries ($4.99)', 'description' => 'chicken tenders(breaded), potato fries', 'image' => 'kids1.jpeg'],
            ['name' => 'Kiddie Macaroni & Cheese ($4.59)', 'description' => 'macaroni, cheese, noodles', 'image' => 'mac&c.jpeg'],
            ['name' => 'Kiddie Pizza & Apple Slices ($4.99)', 'description' => 'pepperoni, apples, cheese, tomato sauce', 'image' => 'pizza.jpeg'],
            ['name' => 'Kiddie Spaghetti & Broccoli ($6.59)', 'description' => 'beef, noodles, tomato sauce, cheese, broccoli', 'image' => 'sphagetbroc.jpeg'],
            ['name' => 'Kiddie Grilled Cheese ($3.99)', 'description' => 'bread, cheese', 'image' => 'grillC.jpeg'],
            ['name' => 'Kiddie Dino Nuggets ($2.99)', 'description' => 'breaded chicken nuggets', 'image' => 'dino.jpeg'],
            ['name' => 'Kiddie Coca Cola ($1.00)', 'description' => 'small sized soda', 'image' => 'smallsizesoda.jpeg'],
            ['name' => 'Kiddie Diet Coke ($1.00)', 'description' => 'small sized soda', 'image' => 'dietcoke.jpeg'],
            ['name' => 'Kiddie Dr. Pepper ($1.00)', 'description' => 'small sized soda', 'image' => 'drpepper.jpeg'],
            ['name' => 'Kiddie Barqs Root Beer ($1.00)', 'description' => 'small sized soda', 'image' => 'barqsrootbeer.jpeg'],
            ['name' => 'Kiddie Sprite ($1.00)', 'description' => 'small sized soda', 'image' => 'sprite.jpeg'],
            ['name' => 'Dr. Pepper ($1.99)', 'description' => 'Large sized soda', 'image' => 'drpepper.jpeg'],
            ['name' => 'Coca Cola($1.99)', 'description' => 'Large sized soda', 'image'=> 'smallsizesoda.jpeg'],
            ['name' => 'Sprite ($1.99)', 'description' => 'Large sized soda', 'image' => 'sprite.jpeg'], 
            ['name' => 'Barqs Root Beer ($1.99)', 'description' => 'Large sized soda', 'image' => 'barqsrootbeer.jpeg'],
            ['name' => 'Diet Coke ($1.99)', 'description' => 'Large sized soda', 'image' => 'dietcoke.jpeg'],
            ['name' => 'Barqs Root Beer ($1.79)', 'description' => 'Medium sized soda','image' => 'barqsrootbeer.jpeg'],
            ['name' => 'Dr. Pepper ($1.79)', 'description' => 'Medium sized soda', 'image' => 'drpepper.jpeg'],
            ['name' => 'Sprite ($1.79)', 'description' => 'Medium sized soda', 'image' => 'sprite.jpeg'],
            ['name' => 'Coca Cola ($1.79)', 'description' => 'Medium sized soda', 'image' => 'smallsizesoda.jpeg'],
            ['name' => 'Diet Coke ($1.79)', 'description' => 'Medium sized soda', 'image' => 'dietcoke.jpeg'],
            ['name' => 'Barqs Root Beer ($1.39)', 'description' => 'Small sized soda', 'image' => 'barqsrootbeer.jpeg'],
            ['name' => 'Dr. Pepper ($1.39)', 'description' => 'Small sized soda','image' => 'drpepper.jpeg'],
            ['name' => 'Sprite ($1.39)', 'description' => 'Small sized soda', 'image' => 'sprite.jpeg'],
            ['name' => 'Coca Cola ($1.39)', 'description' => 'Small sized soda', 'image' => 'smallsizesoda.jpeg'],
            ['name' => 'Diet Coke ($1.39)', 'description' => 'Small sized soda', 'image' => 'dietcoke.jpeg'],
            ['name' => 'Apple Bites Dessert ($1.09)', 'description' => 'sugary apple flavored bite-sized donuts', 'image' => 'applebitesdessert.jpeg'],
            ['name' => 'Churros Dessert ($1.39)', 'description' => 'flour made dough fried and coated with cinnamon sugar', 'image' => 'churros.jpeg'],
            ['name' => 'Ice Cream Cone Dessert ($2.45)', 'description' => 'one big scoop of flavored ice cream on a waffle cone', 'image' => 'icecream.jpeg'],
            ['name' => 'Chocolate Shake Dessert ($1.65)', 'description' => 'chocolate milkshake', 'image' => 'chocolateshake.jpeg'],
        ];

        // Search functionality
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = strtolower($_GET['search']);
            $filteredItems = array_filter($menuItems, function($item) use ($searchTerm) {
                return strpos(strtolower($item['name']), $searchTerm) !== false || strpos(strtolower($item['description']), $searchTerm) !== false;
            });

            if (count($filteredItems) > 0) {
                foreach ($filteredItems as $item) {
                    echo "<div class='menu-item'>";
                    echo "<div class='imgside'><img src='../images/" . $item['image'] . "' alt='" . $item['name'] . "' /></div>";
                    echo "<div class='imgtext'>";
                    echo "<p><strong>" . $item['name'] . "</strong><br>" . $item['description'] . "</p>";
                    echo "</div>";
                    // Add the button with the item name as a parameter for the JavaScript function
                    echo "<button class='arrow-button' onclick=\"addToPlate('" . addslashes($item['name']) . "')\">Add to Plate</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No matching menu items found.</p>";
            }
        } else {
            echo "<p>Please enter a search term to find menu items.</p>";
        }
        ?>

        <script>
            // Function to add an item to the plate
            function addToPlate(item) {
                const data = { item: item };

                // Use the fetch API to send the data to the server
                fetch('AddToPlate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Send the data as a JSON string
                })
                .then(response => response.json()) // Parse the JSON response from the server
                .then(data => {
                    if (data.status === 'success') {
                        alert(item + " added to your plate.");
                    } else {
                        alert(data.message); // Show error message if any
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding to plate.');
                });
            }
        </script>
    </body>
</html>