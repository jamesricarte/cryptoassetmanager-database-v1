<?php
    require_once('database.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(!isset($_GET["id"])) {
            header("Location: index.php");
            exit;
        }

        $id = $_GET["id"];

        $query = "SELECT * FROM coins_table WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();

        if(!$row) {
            header("Location: index.php");
            exit;
        }

        $name = $row["name"];
        $number = $row["number"];
        $price = $row["price"];
        $main_investment = $row["main_investment"];
        $deducted_value = $row["deducted_value"];

        $querylogs = "SELECT * FROM logs";
        $resultlogs = mysqli_query($conn, $querylogs);
        $rowlogs = $resultlogs->fetch_assoc();
        
        if ($rowlogs) {
            $logsId = $rowlogs["id"];
        } 

    }

    $sql = "SELECT SUM(deducted_value) AS total_sum FROM coins_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_sum = $row['total_sum'];
    } else {
    echo "No rows found.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Edit Page</title>
    <link rel="icon" type="image/x-icon" href="images/title-logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <a href="index.php">
    <h2>Crypto Asset Manager</h2>
    </a>
         
    <div class="center-selected-coin">
        <div class="selected-coin-container">
            <div class="coin-info-1">
                <p class="title coin-name"><?php echo$name;?></p>
                <p class="value">₱<?php echo number_format(round($number*$price, 2), 2, '.', ',') ;?></p>
            </div>

            <div class="coin-info-2">
                <div class="coin-info-2-sub-1">
                    <p class="title">Main Investment</p>
                    <p class="value">₱<?php echo number_format(round($main_investment, 2), 2, '.', ',') ;?></p>
                </div>

                <div class="coin-info-2-sub-2">
                    <p class="title">Current Value</p>
                    <p class="value">₱<?php echo number_format(round($number*$price, 2), 2, '.', ',') ;?></p>
                </div>
            </div>
        </div>

        <div class="seperate-coin-divs">
            <div class="standby-funds-container">
                <p class="title">Standby Funds</p>
                <p class="value">₱<?php echo number_format(round($deducted_value, 2), 2, '.', ',') ;?></p>
            </div>

            <div class="total-funds-container">
                <p class="title">Total Funds</p>
                <p class="value">₱<?php echo number_format(round($total_sum, 2), 2, '.', ',') ;?></p>
            </div>
        </div>
        
    </div>

    <div class="center-logs">
        <div class="logs-row">

        <table>
            <tr>
                <td class='table-buttons'>
                    <button class='add-button'>Add</button>
                    <button class='deduct-button'>Deduct</button>
                    <button class='update-price-button'>Update Price</button>
                    <button class="update-main_investment-button">Set New Base</button>

                </td>    
            </tr>
        </table>
            
            <?php 
                    $querylogs = "SELECT * FROM logs WHERE name = '$name' ORDER BY id DESC ";
                    $resultlogs = mysqli_query($conn, $querylogs);
            
                    if(!$resultlogs) {
                        die("Invalid query: " . $conn->error);
                    } 
            
                    while ($rowlogs = $resultlogs->fetch_assoc()) {
                        $namelogs = $rowlogs["name"];
                        $numberlogs = $rowlogs["number"];
                        $pricelogs = $rowlogs["price"];
                        $deducted_valuelogs = $rowlogs["deducted_value"];
                        $dateTimeLogs = $rowlogs["timestamp"];
                        $main_investmentlogs = $rowlogs["main_investment"];

                        echo "<table>
                        <thead>
                        <tr>
                            <td>Coin Name</td>
                            <td>Number of Coin</td>
                            <td>Main Investment</td>
                            <td>Deducted Value</td>
                            <td>Current Price</td>
                            <td>Current Value</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>". $namelogs ."</td>
                            <td>". $numberlogs ."</td>
                            <td><p class='main-investment'>₱". number_format(round($main_investmentlogs, 2), 2, '.', ',') ."</p></td>
                            <td><p class='deducted-value'>₱". number_format(round($deducted_valuelogs, 2), 2, '.', ',') ."</p></td>
                            <td>₱". number_format(round($pricelogs, 2), 2, '.', ',') ."</td>
                            <td><p class='current-value'>₱". number_format(round($numberlogs*$pricelogs, 2), 2, '.', ',')  ."</p></td>
                            <td><a href='delete_edit-page.php?id=$rowlogs[id]'>
                            <button class='logs-delete-button'>Delete</button></a></td>
                        </tr>
                    </tbody>
                    </table>";
                    }
                ?>
                
            
        </div>
    </div>

    <div class="popup">
        <div class="close-button"><img src="images/x-button.png"></div>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="add_amount">Add Amount</label>
            <input type="text" id="add_amount" name="add_amount">
            <label for="current-price">Enter the Current Price</label>
            <input type="text" id="current-price" name="current-price-value" value="<?php echo $price; ?>">
            <input type="submit" name="submit" value="Add Amount" class="add-amount-button">
        </form>  
    </div>

    <div class="deduct">
        <div class="close-button"><img src="images/x-button.png"></div>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="deduct_amount">Deduct Amount</label>
            <input type="text" id="deduct_amount" name="deduct_amount">
            <label for="current-price">Enter the Current Price</label>
            <input type="text" id="current-price" name="current-price-value" value="<?php echo $price; ?>">
            <input type="submit" name="submit" value="Deduct Amount" class="deduct-amount-button">
        </form>
    </div>

    <div class="update-price">
        <div class="close-button"><img src="images/x-button.png"></div>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="update-price">Enter the new price:</label>
            <input type="text" id="update-price" name="update-price-value" value="<?php echo $price; ?>">
            <input type="submit" name="submit" value="Update Price" class="update-base-button">
        </form>
    </div>

    <div class="update-main_investment">
        <div class="close-button"><img src="images/x-button.png"></div>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="update-base">Enter the new base:</label>
            <input type="text" id="update-base" name="update-main_investment-value" value="<?php echo $main_investment; ?>">
            <input type="submit" name="submit" value="Update Base" class="update-main_investment-submit-button">
        </form>
    </div>

<script src="scripts/script.js"></script>

</body>
</html>