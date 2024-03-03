<?php
        if($add_amount){
            $new_value = ($add_amount/$price) + $number;
        }

        if($deduct_amount){
            $new_value =  $number - ($deduct_amount/$price);
        }

        if($new_value < 0){
            $new_value = 0;
        }
        
        if($new_value && $current_price) {
 
            //REFRESH SELECTION FOR LOGS
            $querylogs = "SELECT * FROM coins_table WHERE id=$id";
            $resultlogs = mysqli_query($conn, $querylogs);
            $rowlogs = $resultlogs->fetch_assoc();
    
            if(!$row) {
                echo "Invalid query" . $conn->error;
            }
            
            $name2 = $rowlogs["name"];
            $number2 = $rowlogs["number"];
            $price2 = $rowlogs["price"];

            $update_sql = "UPDATE coins_table SET number = '$new_value', price = '$current_price' WHERE id = $id";
            $conn->query($update_sql);

            $sql = "INSERT INTO logs (name, number, price, deducted_value)
                    VALUES('$name2','$new_value','$price2', ' $deduct_amount')";
        
           mysqli_query($conn, $sql);

           // Reset auto-increment value
           $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
           $conn->query($resetQuery);
       
           // Update existing rows
           $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
           $conn->multi_query($updateQuery);
          
        }

        if ($update_price){

            //REFRESH SELECTION FOR LOGS
            $querylogs = "SELECT * FROM coins_table WHERE id=$id";
            $resultlogs = mysqli_query($conn, $querylogs);
            $rowlogs = $resultlogs->fetch_assoc();
    
            if(!$row) {
                echo "Invalid query" . $conn->error;
            }
            
            $name2 = $rowlogs["name"];
            $number2 = $rowlogs["number"];
            $price2 = $rowlogs["price"];

            $update_sql = "UPDATE coins_table SET price = '$update_price' WHERE id = $id";
            $conn->query($update_sql);

          
            $price_difference =  $update_price - $price;
            

            $sql = "INSERT INTO logs (name, number, price, deducted_value)
            VALUES('$name2','$number2','$update_price', ' $deduct_amount')";

            mysqli_query($conn, $sql);

            // Reset auto-increment value
            $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            // Update existing rows
            $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);
        }

        if ($update_number_coin && $current_price){

            //REFRESH SELECTION FOR LOGS
            $querylogs = "SELECT * FROM coins_table WHERE id=$id";
            $resultlogs = mysqli_query($conn, $querylogs);
            $rowlogs = $resultlogs->fetch_assoc();
    
            if(!$row) {
                echo "Invalid query" . $conn->error;
            }
            
            $name2 = $rowlogs["name"];
            $number2 = $rowlogs["number"];
            $price2 = $rowlogs["price"];

            $update_sql = "UPDATE coins_table SET number = '$update_number_coin', price = ' $current_price' WHERE id = $id";
            $conn->query($update_sql);

            if ($update_number_coin > $number2) {
                $number_add_amount = ($update_number_coin - $number2) * $price2;
            } 
            
            else if ($update_number_coin < $number2) {
                $number_deduct_amount = ($update_number_coin - $number2) * $price2;
            }

            $sql = "INSERT INTO logs (name, number, price, deducted_value)
            VALUES('$name2','$update_number_coin','$current_price', ' $number_deduct_amount')";

            mysqli_query($conn, $sql);

            // Reset auto-increment value
            $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            // Update existing rows
            $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);
      }
        

        $conn->close();

?>