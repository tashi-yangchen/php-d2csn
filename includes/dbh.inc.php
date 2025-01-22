<!-- dbh: database handler -->
<?php

    // dsn: data source name
    $dsn = "mysql:host=localhost;dbname=php_d2csn";
    $dbusername = "root";
    $dbpassword = "root";

    try{
        // PDO: PHP Data Objects
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        // echo "Connected to database";
    }catch (PDOException $e){
        echo "Connection failed: ". $e->getMessage();
    }
?>
