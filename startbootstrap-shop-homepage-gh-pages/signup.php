<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $email = $_POST['email'];
    //$password=$_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Create an array for the new user data
    $newUser = [
        'email' => $email,
        'password' => $password,
        'username' => $username,
        'firstname' => $firstname,
        'lastname' => $lastname,
    ];

    // Read existing user data from users.json (if it exists)
    $userData = [];
    if (file_exists('users.json')) {
        $userData = json_decode(file_get_contents('users.json'), true);
    }

    // Add the new user data to the array
    $userData[] = $newUser;

    // Save the updated user data back to users.json
    file_put_contents('users.json', json_encode($userData, JSON_PRETTY_PRINT));



    // Redirect to the main page after successful registration
    header("Location: index.php");
    exit; // Make sure to exit to prevent further script execution
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
        <input type="password" id="signup_password" name="password" required>

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
