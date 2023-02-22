<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form submission
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Validate the email and password inputs

    // Connect to the database
    $servername = "localhost";
    $username = "your_username";
    $password_db = "your_password";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User exists, check if the password is correct
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Password is correct, log the user in
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: dashboard.php');
            exit();
        } else {
            // Password is incorrect
            $error_message = "Invalid email or password.";
        }
    } else {
        // User doesn't exist
        $error_message = "Invalid email or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login and Sign-in Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container login-container">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if(isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>
    <p>Don't have an account? <a href="sign-in.php">Sign up</a></p>
</div>

</body>
</html>