<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "students database";

    // Create a database connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form data
    $username = sanitizeInput($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $gender = sanitizeInput($_POST['gender']);
    $age = sanitizeInput($_POST['age']);
    $city = sanitizeInput($_POST['city']);
    $category = sanitizeInput($_POST['category']);

    // Prepare the SQL query
    $sql = "INSERT INTO students (username, password, email, phone, gender, age, city, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssss", $username, $password, $email, $phone, $gender, $age, $city, $category);

    // Execute the query
    if ($stmt->execute()) {
        echo "<h2>Registration Successful:</h2>";
        echo "<p>Username: $username</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Phone Number: $phone</p>";
        echo "<p>Gender: $gender</p>";
        echo "<p>Age: $age</p>";
        echo "<p>City: $city</p>";
        echo "<p>Category: $category</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

function sanitizeInput($data) {
    // Sanitize user input to prevent SQL injection or XSS attacks
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
