<?php
// Include the session authentication file
include 'auth.inc.php';
// Include the database connection file
include 'dbh.inc.php';

if (isset($_GET['id'])) {
    $delete_id = intval($_GET['id']);

    try {
        // Delete the user from the database
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $delete_id);
        $statement->execute();

        // Redirect back to the users list
        header("Location: fetch_users.inc.php");
        exit();
    } catch (PDOException $e) {
        die("Error deleting user: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}
