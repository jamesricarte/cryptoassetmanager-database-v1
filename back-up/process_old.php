<?php

$name = $_POST["name"];
$number = filter_input(INPUT_POST, "number", FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);

$host = "localhost";
$dbname = "crypto-asset-manager";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname: $host, 
                        username: $username, 
                        password: $password,
                        database: $dbname); 

if (mysqli_connect_errno()) {
    die ("Connection error: ". mysqli_connect_errno());
}

$sql = "INSERT INTO coins_table (name, number, price) 
        VALUES(? ,? ,? )";

$stmt = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sii", 
                        $name,
                        $number,
                        $price);

mysqli_stmt_execute($stmt);

mysqli_close($conn);

echo "Record saved.";

header('Location: index.php');
exit;
?>