<?php
include_once "../db.php";

$sql = "SELECT crm.raw_materials_name, SUM(srm.Qty) as total_qty, crm.cost, SUM(srm.Qty * crm.cost) as total_cost
        FROM sets_raw_materials srm
        JOIN cost_raw_materials crm ON srm.cost_raw_materials_ID = crm.cost_raw_materials_ID
        GROUP BY crm.raw_materials_name, crm.cost";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sets Raw Materials Stock</title>
    
<style>
 

 body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
    background-image: url('../images/userbg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.container {
   max-width: 800px;
   margin: 50px auto;
   padding: 20px;
   background-color: #fff;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   border-radius: 8px;
}

h1 {
    text-align: center;
    color: #FFF3E2;
    margin-top: 30px;
    margin-bottom: 30px;
    text-shadow: 
        -1px -2px 0 #9A3B3B,  
         1px -2px 0 #9A3B3B,
        -1px  2px 0 #9A3B3B,
         1px  2px 0 #9A3B3B;
}

table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px auto; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    table-layout: fixed; 
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
    word-wrap: break-word; 
}

th {
    background-color: #9A3B3B;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f2f2f2; 
}

tr:nth-child(odd) {
    background-color: #fff; 
}

tr:hover {
    background-color: #ddd;
}

@media (max-width: 768px) {
    th, td {
    padding: 10px;
}
}
</style>

</head>
<body>
    <h1>Sets Raw Materials Stock</h1>
    <table>
        <thead>
            <tr>
                <th>Raw Materials Name</th>
                <th>Quantity</th>
                <th>Cost per Unit</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['raw_materials_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_qty']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cost']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_cost']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conn->close();
?>