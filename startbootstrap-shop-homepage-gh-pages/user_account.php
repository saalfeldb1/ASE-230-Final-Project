<!-- user_account.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: signin.php");
    exit;
}

// Load the user's profile from the database or JSON file
$user_id = $_SESSION['user_id'];
$user_profile = loadUserProfile($user_id); // Implement this function

// Load the user's listings from the database or JSON file
$user_listings = loadUserListings($user_id); // Implement this function
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Account</title>
</head>
<body>
    <h1>Welcome, <?php echo $user_profile['username']; ?></h1>

    <h2>Profile Information</h2>
    <form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user_profile['username']; ?>">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_profile['email']; ?>">
        
        <!-- Other profile fields (e.g., password) can be added here -->

        <input type="submit" value="Update Profile">
    </form>

    <h2>Your Listings</h2>
    <ul>
        <?php foreach ($user_listings as $listing): ?>
            <li>
                <?php echo $listing['title']; ?>
                <!-- Add Edit and Delete buttons for each listing -->
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>