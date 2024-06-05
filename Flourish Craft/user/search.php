<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <style>
        .img-frame {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .img-frame img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .fa-heart-o {
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .fa-heart-o:hover {
            color: #dc3545 !important;
        }

        .btn-primary {
            background-color: #ff69b4 !important;
            border-color: #ff69b4 !important;
        }

        .btn-primary:hover {
            background-color: #ff1493 !important;
            border-color: #ff1493 !important;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row">
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
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <a href="#" class="float-right text-danger"><i class="fas fa-heart-o" aria-hidden="true"></i></a>
                                    <div class="img-frame mb-3">
                                        <a href="product.php?set_id=<?php echo urlencode($setId); ?>">
                                            <img class="card-img-top img-fluid" src="../images/<?php echo $setImage; ?>" alt="<?php echo $setName; ?>">
                                        </a>
                                    </div>
                                    <h5 class="card-title mb-2"><a href="product.php?set_id=<?php echo urlencode($setId); ?>" class="text-dark"><?php echo htmlspecialchars($setName); ?></a></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">₱ <?php echo $price; ?></h6>
                                    <a href="product.php?set_id=<?php echo urlencode($setId); ?>" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
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
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
