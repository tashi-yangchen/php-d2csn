<?php
// Include the session authentication file
include 'session.inc.php';
// Include the database connection file
include 'dbh.inc.php';

// This checks if the id parameter exists in the query string
// (e.g., http://localhost/php-d2csn/includes/update_user.inc.php?id=1).
if (isset($_GET['id'])) {
// The intval() function converts the value of $_GET['id'] into an integer.
// If $_GET['id'] contains a string like "42abc", intval() will extract the numeric part (42).
    $id = intval($_GET['id']);

    // Fetch the user details
    try {
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("User not found.");
        }
    } catch (PDOException $e) {
        die("Error fetching user: " . $e->getMessage());
    }

    // Handle the update form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];

        try {
            $query = "UPDATE users SET username = :username, email = :email WHERE id = :id";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':id', $id);
            $statement->execute();

            header("Location: fetch_users.inc.php"); // Redirect back to users list
            exit();
        } catch (PDOException $e) {
            die("Error updating user: " . $e->getMessage());
        }
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/update_user.css">
</head>
<body>
    <h1>Edit User</h1>
    <div>
        <!-- you dont have to use action attribute here since you are submitting to the same file -->
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <br><br>
            <button class="update-btn" type="submit">Update</button>
            <button class="delete-btn"> <a href="fetch_users.inc.php">Cancel</a> </button>
        </form>
    </div>

</body>
</html>
