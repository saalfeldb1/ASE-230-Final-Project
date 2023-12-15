<?php

$host = 'localhost';
$dbname = 'final_project';
$user = 'root';
$password = '';

session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $enteredPassword = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || empty($row["usertype"])) {
            ?>
            <script>
                alert("Credentials are incorrect. Please try again");
                window.location.href = "signin.php";
            </script>
            <?php
        }

        $storedPassword = $row["password"];

        if (password_verify($enteredPassword, $storedPassword)) {
            // Passwords match
            $_SESSION["username"] = $username;
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["userID"] = $row["ID"];
            

            if ($row["usertype"] == "user") {
                header("location:index.php");
            } elseif ($row["usertype"] == "admin") {
                $_SESSION['usertype'] = $row['usertype'];
                header("location:admin.php");
            }
        } else {
            echo "Username or password incorrect";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link href="custom.css" rel="stylesheet" />
</head>
<h1>Sign In</h1>
<form action="#" method="POST">
    <label for="signin_username">Username:</label>
    <input type="text" id="signin_username" name="username" required><br>
    
    <label for="signin_password">Password:</label>
    <input type="password" id="signin_password" name="password" required><br>

    <input type="submit" value="Sign In">
</form>
<h2><a href="index.php" style="text-decoration: none; color: black">Go Back</a></h2>
