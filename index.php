<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>index</title>
</head>
<body>
    <?php echo "Current Date and Time: " . date("Y-m-d H:i:s") ?>

    <div id="main">
        <h3>Sign Up</h3>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="username" placeholder="Username" required> <br><br>
            <input type="password" name="pwd" placeholder="Password" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <button type="submit" name="submit" id="submit">Sign Up</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
