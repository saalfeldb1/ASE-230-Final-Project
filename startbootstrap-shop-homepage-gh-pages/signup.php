<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $email = $_POST['email'];
    $rawPassword = $_POST['password'];
    $userPassword = password_hash($rawPassword, PASSWORD_DEFAULT); // Hash the password for security
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    try {
        // Create a PDO connection
        $host = 'localhost';
        $dbname = 'final_project';
        $user = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the username or email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo "Username or email already exists. Please choose a different username or email.";
        } else {
            // Prepare and execute the SQL query to insert a new user
            $stmt = $pdo->prepare("INSERT INTO users (email, password, username, firstname, lastname) VALUES (:email, :password, :username, :firstname, :lastname)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $userPassword);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->execute();

            // Check for errors
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                echo "Error: " . $errorInfo[2];
            }

            // Retrieve the newly inserted user ID
            $newUserID = $pdo->lastInsertId();

            // Start a session and set user details
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['userID'] = $newUserID;

            // Redirect to the main page after successful registration
            header("Location: index.php");
            exit; // Make sure to exit to prevent further script execution
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="custom.css" rel="stylesheet" />
</head>
<body>
    <h1>Sign Up</h1>
    <form action="signup.php" method="post">
        <label for="signup_email">Email:</label>
        <input type="email" id="signup_email" name="email" required>
        
        <label for="signup_password">Password:</label>
        <input type="text" id="signup_password" name="password" required>

        <label for="signup_username">Username:</label>
        <input type="text" id="signup_username" name="username" required>
        
        <label for="signup_firstname">First Name:</label>
        <input type="text" id="signup_firstname" name="firstname" required>
        
        <label for="signup_lastname">Last Name:</label>
        <input type="text" id="signup_lastname" name="lastname" required>

        <input type="submit" value="Sign Up">
    </form>
    <h2><a href="index.php" style="text-decoration: none; color: black">Go Back</a></h2>

</body>
</html>
