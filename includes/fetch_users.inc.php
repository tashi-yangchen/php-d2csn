<?php
// Include the session authentication file
include 'session.inc.php';
// Include the database connection file
include 'dbh.inc.php';
// declare an empty array
$users = [];
echo "Thank you, " . $_SESSION['username'];
try {
    // SQL query to fetch all users
    $query = "SELECT * FROM users";

    // Prepare and execute the query
    $statement = $pdo->prepare($query);
    $statement->execute();

    // Fetch all users
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../css/fetch_users.css">
    <link rel="stylesheet" href="../css/nav_bar.css">
</head>
<body>
    <ul>
        <li><a class="active" href="#">Users</a></li>
        <li><a href="logout.inc.php">Log out</a></li>
    </ul>
    <div class="container">
        <h1>List of Users</h1>
        <!-- check if there is any user fetched from the database in $users array-->
        <?php if (!empty($users)): ?>
            <!-- list the users in rows of a table if the $users array is not empty-->
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    <!-- loop through each user in the $users array and print the details -->
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="actions">
                                <!--
                                The <a> tag attaches the id of the user in the URL and sends it to the update_user.inc.php page
                                For example, if $user['id'] is 42, the output HTML will be:
                                <a href="update_user.inc.php?id=42">
                                -->
                                <button class="update-btn"><a href="update_user.inc.php?id=<?php echo $user['id']; ?>">Edit </a></button>

                                <!--
                                The <a> tag attaches the id of the user in the URL and sends it to the delete_user.inc.php page
                                For example, if $user['id'] is 42, the output HTML will be:
                                <a href="delete_user.inc.php?id=42">
                                -->
                                <button class="delete-btn"><a href="delete_user.inc.php?id=<?php echo $user['id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!--display the message below id $users array is empty -->
        <?php else: ?>
            <h1>No users found in the database.</h1>
        <?php endif; ?>
    </div>
</body>
</html>
