<?php
if(isset($_GET["id"])) {
$id = $_GET["id"];

require_once('database.php');

$query = "SELECT * FROM logs WHERE id=$id";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

$name = $row["name"];
$number = $row["number"];
$price = $row["price"];

$target_value = $name;

$queryDelete = "DELETE FROM logs WHERE id=$id";
$conn->query($queryDelete);

$queryselects = "SELECT * FROM coins_table WHERE name = '$target_value'";
$resultselects = mysqli_query($conn, $queryselects);
$rowselects = $resultselects->fetch_assoc();

$idselects = $rowselects["id"];

}


// Reset auto-increment value
$resetQuery = "ALTER TABLE coins_table AUTO_INCREMENT = 1";
$conn->query($resetQuery);

// Update existing rows
$updateQuery = "SET @new_id = 0; UPDATE coins_table SET id = @new_id:=@new_id+1";
$conn->multi_query($updateQuery);

// Close the connection
$conn->close();



header("location: edit-page.php?id=$idselects");
exit;
?>