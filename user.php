<?php
header("Content-Type: application/json");
require_once 'db.php';

// Get HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // READ users
        $sql = "SELECT * FROM Users";
        $result = $conn->query($sql);

        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode($users);
        break;

    case 'POST':
        // CREATE user
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $dob = $data['dob'];

        $sql = "INSERT INTO Users (Name, email, password, DOB) VALUES ('$name', '$email', '$password', '$dob')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User created successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PUT':
        // UPDATE user
        $data = json_decode(file_get_contents("php://input"), true);

        $id = $data['UserId'];
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $dob = $data['dob'];

        $sql = "UPDATE Users SET Name='$name', email='$email', password='$password', DOB='$dob' WHERE UserId=$id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'DELETE':
        // DELETE user
        $data = json_decode(file_get_contents("php://input"), true);

        $id = $data['UserId'];

        $sql = "DELETE FROM Users WHERE UserId=$id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["message" => "Request method not allowed"]);
        break;
}

$conn->close();
?>
