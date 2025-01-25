<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/update_user.css">
</head>
<body>
    <h1>Login</h1>
    <div>
        <form action="includes/login.inc.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br> <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br> <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
