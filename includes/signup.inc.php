<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_POST);
    // making access to dbh.inc.php which then connects to the database
    // ensures that the file dbh.inc.php is included in the script only once.
    // If the file is included more than once, PHP will raise a fatal error.
    require_once "dbh.inc.php";

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];
    // hash the password for security and for session management
    $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

    try{

        // SQL query to be run in the database
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

        // Prepares the query for execution, protecting against SQL injection. this is basically a security measure.
        $statement = $pdo->prepare($query);

        // Associates the placeholders(:username, :pwd, :email) in the query statement with actual values.
        $statement->bindParam(":username", $username);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":pwd", $hashedPassword);
        // INSERT INTO users (username, pwd, email) VALUES ('sonam', 's001(hashed)', 'soom@gmail.com');
        // Executes the prepared statement, inserting the data into the database.
        $statement->execute();

        // Closes the connection to the database.
        $pdo = null;
        $statement = null;

        // Redirects to success.php file with a creation=success query string, indicating the operation was successful.
        // header("Location: ../success.php?creation=success");
        header("Location: fetch_users.inc.php?creation=success");

        // Ensures no further script execution after the redirect.
        //  Terminates the script or closes this file.
        die();
    }
    catch (PDOException $e){
        // Catches and handles database-related exceptions displaying the error message if the query fails.
        die ("Query failed: ". $e->getMessage());
    }
}else {
    // If the request method is not POST, the user is redirected to the homepage.
    header("Location: ../index.php");
}


