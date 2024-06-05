<?php
include_once "../db.php";

if(isset($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    
    // Prepare SQL statement to search for sets matching the keywords
    $stmt = $conn->prepare("SELECT s.Set_ID, s.Set_Name, s.set_img, p.Price 
                            FROM `set` s 
                            INNER JOIN `price` p ON s.Price_ID = p.Price_ID 
                            WHERE s.Set_Name LIKE ? OR s.description LIKE ? OR p.Price LIKE ?
                            ORDER BY s.Set_ID ASC");
    
    if ($stmt) {
        // Bind the keywords to the prepared statement
        $searchTerm = "%" . $keywords . "%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Display the search results
        while ($product = $result->fetch_assoc()) {
            // Display each matching set
            $setId = $product['Set_ID'];
            $setName = $product['Set_Name'];
            $setImage = $product['set_img'];
            $price = $product['Price'];
?>
            <div class="product product-<?php echo str_replace(" ", "-", strtolower($setName)); ?>">
                <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                <div class="img-frame">
                    <a href="product.php?set_id=<?php echo urlencode($setId); ?>">
                        <img src="../images/<?php echo $setImage; ?>" alt="<?php echo $setName; ?>">
                    </a>
                </div>
                <span><?php echo htmlspecialchars($setName); ?></span>
                <span class="price-span">₱ <?php echo $price; ?></span>
            </div>
<?php
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Redirect back to the main page if no keywords are provided
    header("Location: user_index.php");
    exit;
}
?>
