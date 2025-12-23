<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Validate and sanitize the data (you should perform more validation here)
    $username = htmlspecialchars($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Database connection (replace with your database credentials)
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "signup";

    // Create a connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into the database (replace 'users' with your table name)
    $sql = "INSERT INTO registration (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $successMessage = "User registered successfully!";
        // Redirect back to the signup page with the success message as a query parameter
        header("Location: signup.html?message=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
