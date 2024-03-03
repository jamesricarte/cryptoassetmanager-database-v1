<?php
    require_once('database.php');

        $id = $_POST["id"];

        $query = "SELECT * FROM coins_table WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();

        if(!$row) {
            echo "Invalid query" . $conn->error;
        }
        
        $name = $row["name"];
        $number = $row["number"];
        $price = $row["price"];
        $deducted_value = $row["deducted_value"];
        $main_investment = $row["main_investment"];

        $update_number_coin = isset($_POST['update-no-coin-value']) ? $_POST['update-no-coin-value'] : '';
        $update_price = isset($_POST['update-price-value']) ? $_POST['update-price-value'] : '';
        $current_price = isset($_POST['current-price-value']) ? $_POST['current-price-value'] : '';
        $input_main_investment = isset($_POST['update-main_investment-value']) ? $_POST['update-main_investment-value'] : '';
        $add_amount = isset($_POST['add_amount']) ? $_POST['add_amount'] : '';
        $deduct_amount = isset($_POST['deduct_amount']) ? $_POST['deduct_amount'] : '';
        $new_value = "";
        $price_difference = "";

        if($deduct_amount && $current_price){
            $new_value =  $number - ($deduct_amount/$current_price);
            echo$new_value;

            $total_deducted_value =  $deducted_value + $deduct_amount;

            $update_sql = "UPDATE coins_table SET number = '$new_value', price = '$current_price', deducted_value = '$total_deducted_value' WHERE id = $id";

            $conn->query($update_sql);
            
            $sql = "INSERT INTO logs (name, number, price, deducted_value, main_investment)
                    VALUES('$name','$new_value','$current_price', '$total_deducted_value', '$main_investment')";
        
           mysqli_query($conn, $sql);

            $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);
        }

        if($add_amount && $current_price){
            $new_value = ($add_amount/$current_price) + $number;
            echo$new_value;

            $total_deducted_value = $deducted_value - $add_amount;

            if ($total_deducted_value < 0) {
                $total_deducted_value = 0;
            }

            $update_sql = "UPDATE coins_table SET number = '$new_value', price = '$current_price', deducted_value = '$total_deducted_value' WHERE id = $id";
            
            $conn->query($update_sql);

            $sql = "INSERT INTO logs (name, number, price, deducted_value, main_investment)
                    VALUES('$name','$new_value','$current_price', '$total_deducted_value', '$main_investment')";
        
           mysqli_query($conn, $sql);

           $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
           $conn->query($resetQuery);
       
           $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
           $conn->multi_query($updateQuery);

        }

        if($update_price) {
            echo$update_price;

            $update_sql = "UPDATE coins_table SET price = '$update_price' WHERE id = $id";
            $conn->query($update_sql);            

            $sql = "INSERT INTO logs (name, number, price, deducted_value, main_investment)
            VALUES('$name','$number','$update_price', '$deducted_value', '$main_investment')";
            $conn->query($sql); 

            $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);
        }

        if ($input_main_investment) {

            $update_sql = "UPDATE coins_table SET main_investment = '$input_main_investment' WHERE id = $id";
            $conn->query($update_sql);            

            $sql = "INSERT INTO logs (name, number, price, deducted_value, main_investment)
            VALUES('$name','$number','$price', '$deducted_value', '$input_main_investment')";
            $conn->query($sql); 

            $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
            $conn->query($resetQuery);
        
            $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);
        }

        header("Location: edit-page.php?id=$row[id]");
        exit;
?>