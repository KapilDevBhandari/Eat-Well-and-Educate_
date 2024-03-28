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

    // SQL query using prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO create_account (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location:index.html "); 
    } else {
        echo "Error: Unable to execute the query";
        // Log the actual error for debugging purposes
        error_log("MySQL Error: " . $conn->error);
    }

    // Close the prepared statement
    $stmt->close();
} 

// Close the database connection
$conn->close();
?>
