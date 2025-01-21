<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_POST);

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    // echo "<br>$username, $pwd, $email";

    if (empty($username) || empty($pwd) || empty($email)){
        echo "All fields are required!!!";
    } else {
        echo "<h1>Form well received</h1>";
    };

} else {
    echo "Invalid request";
}


