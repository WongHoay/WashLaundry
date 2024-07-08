
<?php
//include 'db.php';

$sql = "SELECT orders.id, users.username, orders.order_date, orders.total 
        FROM orders 
        JOIN users ON orders.user_id = users.id 
        ORDER BY orders.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - User Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>User Orders</h1>

<table>
    <tr>
        <th>Order ID</th>
        <th>Username</th>
        <th>Order Date</th>
        <th>Total</th>
        <th>Details</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["order_date"] . "</td>";
            echo "<td>$" . $row["total"] . "</td>";
            echo "<td><a href='order_details.php?order_id=" . $row["id"] . "'>View Details</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No orders found</td></tr>";
    }
    $conn->close();
    ?>

</table>

</body>
</html>


