<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userapi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["message" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

// Handle Preflight request (important for CORS)
if ($method == "OPTIONS") {
    http_response_code(200);
    exit();
}

// 1. Create User
if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $dob = $data['dob'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $dob);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }
    $stmt->close();
}

// 2. Get All Users
if ($method == 'GET') {
    $sql = "SELECT id, name, email, dob FROM users";  // Note: Don't send passwords!
    $result = $conn->query($sql);
    $users = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    echo json_encode($users);
}

// 3. Update User
if ($method == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = intval($data['id']);
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $dob = $data['dob'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=?, dob=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $password, $dob, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }
    $stmt->close();
}

// 4. Delete User
if ($method == 'DELETE') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["message" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["message" => "No ID provided for delete"]);
    }
}

$conn->close();
?>
