<?php
    require_once("database.php");

    $name = $_POST["name"];
    //$number = $_POST["number"];
    //$price = $_POST["price"];
    $number = filter_input(INPUT_POST, "number", FILTER_VALIDATE_FLOAT);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);

    $total_value =  $number*$price;

    if (trim($name) !== "" && $price !== "") {
        try {
            $sql = "INSERT INTO coins_table (name, number, price, main_investment)
                    VALUES('$name','$number','$price', '$total_value')";

           mysqli_query($conn, $sql);

           $sql = "INSERT INTO logs (name, number, price, main_investment)
            VALUES('$name','$number','$price', '$total_value')";

            mysqli_query($conn, $sql);
        
           // Reset auto-increment value coins_table
            $resetQuery = "ALTER TABLE coins_table AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            // Update existing rows coins_table
            $updateQuery = "SET @new_id = 0; UPDATE coins_table SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);

            } 
             catch(Exception $e) {
                echo "error connecting database";
            }
    }  

    // Reset auto-increment value logs
    $resetQuerylogs = "ALTER TABLE logs AUTO_INCREMENT = 1";
    $conn->query($resetQuerylogs);

    // Update existing rows logs
    $updateQuerylogs = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
    $conn->multi_query($updateQuerylogs);


    mysqli_close($conn);
    header("Location: index.php");
    exit;
?>