<?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $db_name = "crypto-asset-manager";

    //$localhost = "sql305.infinityfree.com";
    //$username = "if0_34967347";
    //$password = "8p3iQVu1ii05x7";
    //$db_name = "if0_34967347_cryptoassetmanager";
    
    $conn = mysqli_connect($localhost,
                            $username, 
                            $password, 
                            $db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

?>