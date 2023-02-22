<?php
// Set up database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "my_database";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user input from form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert user details into database
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>