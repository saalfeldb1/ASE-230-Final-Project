<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users = [];
    if (file_exists("users.json")) {
        $users = json_decode(file_get_contents("users.json"), true);
    }

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        echo "Sign In successful!";
        header("Location: index.php");

    } else {
        echo "Invalid username or password.";
        header("Location: signin.php");
    }

    exit; // Make sure to exit to prevent further script execution
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="custom.css" rel="stylesheet" />
</head>
<h1>Sign Up</h1>
<form action="signin.php" method="post">
    <label for="signin_username">Username:</label>
    <input type="text" id="signin_username" name="username" required><br>
    
    <label for="signin_password">Password:</label>
    <input type="password" id="signin_password" name="password" required><br>

    <input type="submit" value="Sign In">
</form>
<h2><a href="index.php" style="text-decoration: none; color: black">Go Back</a></h2>
