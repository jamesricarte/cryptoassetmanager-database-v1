<?php
    require_once('database.php');

    $query = "SELECT * FROM coins_table";
                    $result = mysqli_query($conn, $query);
            
    if(!$result) {
        die("Invalid query: " . $conn->error);
    } 


    while ($row = $result->fetch_assoc()) {
        $logsData[] = array (
        'id' => $row["id"],
        'name' => $row["name"],
        'number' => $row["number"],
        'price' => $row["price"],
        'deducted_value' => $row["deducted_value"],
        'dateTime' => $row["timestamp"],
        'main_investment' => $row["main_investment"]
        );
    };

    $jsonData = json_encode($logsData);

    echo $jsonData;

?>