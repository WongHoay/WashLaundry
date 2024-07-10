<?php
header("Content-Type: application/json");

// Database configuration
$servername = "localhost";
$username = "root";  // Change this to your phpMyAdmin username
$password = "";  // Change this to your phpMyAdmin password
$dbname = "washlaundry_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet($conn);
        break;
    case 'POST':
        handlePost($conn);
        break;
    case 'PUT':
        handlePut($conn);
        break;
    case 'DELETE':
        handleDelete($conn);
        break;
    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}

$conn->close();

function handleGet($conn) {
    $userID = isset($_GET['userID']) ? intval($_GET['userID']) : 0;
    
    if ($userID > 0) {
        // Fetch a specific user
        $sql = "SELECT * FROM user WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
    } else {
        // Fetch all users
        $sql = "SELECT * FROM user";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $user = [];
    while ($row = $result->fetch_assoc()) {
        $user[] = $row;
    }

    echo json_encode($user);
}

function handlePost($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $contact = $data['contact'];
    $address = $data['address'];
    

    $sql = "INSERT INTO user (username, email, password, contact, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $password, $address,$contact);

    if ($stmt->execute()) {
        echo json_encode(["message" => "New user created successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function handlePut($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $userID = $data['userID'];
    $username = $data['username'];
    $email = $data['email'];
    $contact = $data['contact'];
    $password = $data['password'];
    $address = $data['address'];

    $sql = "UPDATE user SET username = ?, email = ?, password = ?, address=?, contact=? WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $email, $password, $userID,$address,$contact);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function handleDelete($conn) {
    // Get JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present
    if (!isset($data['userID'], $data['username'], $data['email'], $data['password'], $data['contact'], $data['address'])) {
        echo json_encode(["error" => "Missing required fields"]);
        return;
    }

    // Extract and sanitize the data
    $userID = intval($data['userID']);
    $username = $conn->real_escape_string($data['username']);
    $email = $conn->real_escape_string($data['email']);
    $contact = $conn->real_escape_string($data['contact']);
    $password = $conn->real_escape_string($data['password']);
    $address = $conn->real_escape_string($data['address']);

    // Construct the SQL query
    $sql = "DELETE FROM user WHERE userID = ? AND username = ? AND password = ? AND email = ? AND contact = ? AND address = ?";
    
    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $userID, $username, $email, $password, $contact, $address);
    
    if ($stmt->execute()) {
        $affected_rows = $stmt->affected_rows;
        if ($affected_rows > 0) {
            echo json_encode(["message" => "User deleted successfully", "affected_rows" => $affected_rows]);
        } else {
            echo json_encode(["message" => "No matching user found with the given details", "affected_rows" => 0]);
        }
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }

    $stmt->close();
}
?>
