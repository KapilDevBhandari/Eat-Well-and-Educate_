<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3308);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data is set
if (isset($_POST['email'], $_POST['password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query using prepared statement to check login credentials
    $stmt = $conn->prepare("SELECT email, password FROM create_account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($storedEmail, $storedPassword);
    $stmt->fetch();

    if ($password === $storedPassword) {
        echo "Login successful";
        // Redirect to a dashboard or another page after successful login
        header("Location: /index.html");
        exit(); // Ensure script stops execution after redirection
    } else {
        echo "Invalid email or password";
    }

    // Close the prepared statement
    $stmt->close();
} 

// Close the database connection
$conn->close();
?>
