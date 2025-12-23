<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the posted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection settings (modify these with your own credentials)
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "signup";

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to retrieve the hashed password for the provided username
    $stmt = $conn->prepare("SELECT id, username, password FROM registration WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, display a "Login Successful" message
        echo json_encode(["success" => true, "message" => "Login Successful! Welcome, " . htmlspecialchars($dbUsername) . "!"]);
    } else {
        // Password is incorrect, display an error message
        echo json_encode(["success" => false, "message" => "Login Failed. Please check your credentials."]);
    }

    // Close database connection
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    exit;
}
?>

