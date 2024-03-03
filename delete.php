<?php
if(isset($_GET["id"])) {
$id = $_GET["id"];

require_once('database.php');

$query = "SELECT * FROM coins_table WHERE id=$id";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

$name = $row["name"];
$number = $row["number"];
$price = $row["price"];

$target_value = $name;

$queryDelete = "DELETE FROM coins_table WHERE id=$id";
$conn->query($queryDelete);

$queryDeleteLogs = "DELETE FROM logs WHERE name= '$target_value' ";
$resultDeleteLogs = $conn->query($queryDeleteLogs);

}


// Reset auto-increment value
$resetQuery = "ALTER TABLE coins_table AUTO_INCREMENT = 1";
$conn->query($resetQuery);

// Update existing rows
$updateQuery = "SET @new_id = 0; UPDATE coins_table SET id = @new_id:=@new_id+1";
$conn->multi_query($updateQuery);

// Close the connection
$conn->close();

header("Location: index.php");
exit;

?>