<?php
// This starts a new session or resumes an existing one.
// Sessions are used to store login information across different pages for a user.
session_start();
include 'dbh.inc.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Check if the username exists
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // verifies the username and the hashed password
        if ($user && password_verify($password, $user['pwd'])) {
            // Login successful
            // Store the user's ID and username in the session to be used across different pages until the session is destroyed/logged out
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to a secure page
            header("Location: fetch_users.inc.php?login=successful");
            exit();
        } else {
            $e = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
