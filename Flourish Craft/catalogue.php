<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalogue</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>     
        body {
            font-family: Arial, sans-serif;
            margin: 0;        
            padding: 0;
            background-image: url('userbg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        h1 {
            text-align: center;
            color: #FFE5CA;
            margin-top: 30px;
            margin-bottom: 30px;
            text-shadow: 
                -1px -1px 0 #9A3B3B,  
                 1px -1px 0 #9A3B3B,
                -1px  1px 0 #9A3B3B,
                 1px  1px 0 #9A3B3B;
        }

        .product {
            background-color: #fff; 
            border: 1px solid #ddd;
            border-radius: 10px; 
            padding: 20px;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s ease; 
        }

        .product:hover {
            box-shadow: 0px 0px 50px 50px rgba(0,0,0,0.1); 
        }

        .product h2 {
            color: #333; 
            margin-bottom: 15px; 
            font-size: 1.5rem; 
        }

        .product p {
            color: #555; 
            margin-bottom: 10px;
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 10px; 
            margin-bottom: 15px; 
            transition: transform 0.3s ease; 
        }

        .product img:hover {
            transform: scale(1.05); 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Catalogue</h1>
        <div class="row">
            <?php
            include_once "db.php";

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $imageFolder = "images/"; 

            $sql = "SELECT s.Set_Name, s.Description, s.set_img, s.variation, p.Price 
                    FROM `set` s
                    JOIN `price` p ON s.Price_ID = p.Price_ID";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='product'>";
                    echo "<h2>" . $row["Set_Name"] . "</h2>";
                    echo "<p class='mb-3'>Description: " . $row["Description"] . "</p>"; 
                    echo "<p class='mb-3'>Variation: " . $row["variation"] . "</p>"; 
                    echo "<p class='mb-3'>Price: ₱" . $row["Price"] . "</p>"; 
                    echo "<img src='" . $imageFolder . $row["set_img"] . "' alt='" . $row["Set_Name"] . "' class='img-fluid' />";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
