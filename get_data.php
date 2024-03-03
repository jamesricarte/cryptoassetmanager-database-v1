<?php
    require_once('database.php');

    session_start();
    $receivedData = $_SESSION['name'];

    $querylogs = "SELECT * FROM logs WHERE name = '$receivedData' ORDER BY id DESC ";
                    $resultlogs = mysqli_query($conn, $querylogs);
            
    if(!$resultlogs) {
        die("Invalid query: " . $conn->error);
    } 


    while ($rowlogs = $resultlogs->fetch_assoc()) {
        $logsData[] = array (
        'idlogs' => $rowlogs["id"],
        'namelogs' => $rowlogs["name"],
        'numberlogs' => $rowlogs["number"],
        'pricelogs' => $rowlogs["price"],
        'deducted_valuelogs' => $rowlogs["deducted_value"],
        'dateTimelogs' => $rowlogs["timestamp"],
        'main_investmentlogs' => $rowlogs["main_investment"]
        );
    };

    $jsonData = json_encode($logsData);

    echo $jsonData;

?>