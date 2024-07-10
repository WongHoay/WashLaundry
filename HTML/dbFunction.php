<?php
//$servername = "localhost";
//$username = "root"; // Your database username
//$password = ""; // Your database password
//$dbname = "washlaundry_db"; // Your database name
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

function dbConnect() {
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

    return $conn;
}

//$servername = "localhost";
//$username = "root"; // Your database username
//$password = ""; // Your database password
//$dbname = "washlaundry_db"; // Your database name
//
//// Create connection
//function dbConnect() {
//    global $servername, $username, $password, $dbname;
//    $conn = new mysqli($servername, $username, $password, $dbname);
//
//    // Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//    return $conn;
//}
?>

<!--
//$db_host = "localhost";
//$db_user = "root";
//$db_pass = "";
//$db_name = "movie_review";
//$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or
//    die(mysqli_connect_error());
//-->