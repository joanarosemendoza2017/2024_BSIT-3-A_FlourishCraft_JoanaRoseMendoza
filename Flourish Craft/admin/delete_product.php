<?php
session_start();
include_once "../db.php";

if (!isset($_SESSION['customers_username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['set_id'])) {
        $setId = $_POST['set_id'];

        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("DELETE FROM `sets_raw_materials` WHERE Set_ID = ?");
            if ($stmt) {
                $stmt->bind_param("i", $setId);
                if (!$stmt->execute()) {
                    throw new Exception("Error deleting raw materials: " . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception("Error preparing statement for raw materials: " . $conn->error);
            }

            $stmt = $conn->prepare("DELETE FROM `set` WHERE Set_ID = ?");
            if ($stmt) {
                $stmt->bind_param("i", $setId);
                if (!$stmt->execute()) {
                    throw new Exception("Error deleting set: " . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception("Error preparing statement for set: " . $conn->error);
            }

            $conn->commit();
            $_SESSION['delete_message'] = "Product deleted successfully.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['delete_message'] = "Error deleting product: " . $e->getMessage();
        }
    } else {
        $_SESSION['delete_message'] = "Invalid request.";
    }
    header("Location: admin_index.php");
    exit;
} else {
    header("Location: admin_index.php");
    exit;
}
?>