<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "washlaundry_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

//<?php
//$db_host = "localhost";
//$db_user = "root";
//$db_pass = "";
//$db_name = "movie_review";
//$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or
//    die(mysqli_connect_error());
//?>