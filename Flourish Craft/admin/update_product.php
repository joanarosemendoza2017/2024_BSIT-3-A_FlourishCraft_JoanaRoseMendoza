<?php
include_once "../db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $set_id = $_POST["set_id"];
    $set_name = $_POST["set_name"];
    $description = $_POST["description"];
    $variation = $_POST["variation"];
    $cost = $_POST["cost"];
    $price_id = $_POST["price_id"];
    $new_price = $_POST["price"];

    if (isset($_FILES["set_img"]) && $_FILES["set_img"]["error"] == 0) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/FlourishCraft/images/";
        $original_filename = basename($_FILES["set_img"]["name"]);
        $imageFileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $img_path = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $img_path;
        $uploadOk = 1;

        $check = getimagesize($_FILES["set_img"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["set_img"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["set_img"]["tmp_name"], $target_file)) {
                
                $stmt_update = $conn->prepare("UPDATE `set` SET Set_Name=?, Description=?, Variation=?, Cost=?, Set_Img=? WHERE Set_ID=?");
                $stmt_update->bind_param("sssdsi", $set_name, $description, $variation, $cost, $img_path, $set_id);

                if ($stmt_update->execute()) {
                    
                    $stmt_update_price = $conn->prepare("UPDATE price SET Price = ? WHERE Price_ID = ?");
                    $stmt_update_price->bind_param("di", $new_price, $price_id);
                    if ($stmt_update_price->execute()) {
                       
                        header("Location: admin_index.php");
                        exit;
                    } else {
                        echo "Error updating price: " . $conn->error;
                    }
                    $stmt_update_price->close();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $stmt_update = $conn->prepare("UPDATE `set` SET Set_Name=?, Description=?, Variation=?, Cost=? WHERE Set_ID=?");
        $stmt_update->bind_param("ssssi", $set_name, $description, $variation, $cost, $set_id);

        if ($stmt_update->execute()) {
            $stmt_update_price = $conn->prepare("UPDATE price SET Price = ? WHERE Price_ID = ?");
            $stmt_update_price->bind_param("di", $new_price, $price_id);
            if ($stmt_update_price->execute()) {
                header("Location: admin_index.php");
                exit;
            } else {
                echo "Error updating price: " . $conn->error;
            }
            $stmt_update_price->close();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $stmt_update->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>