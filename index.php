<?php
    require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Asset Manager</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="images/title-logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <a href="">
        <h2>Crypto Asset Manager</h2>
    </a>

    <div class="center-input">
        <div class="input-container">
            <form action="insert.php" method="post">
            <label for="name">Coin Name</label>
            <input type="text" id="name" name="name">
            <label for="number">No. of Coin</label>
            <input type="text" id="number" name="number">
            <label for="price">Price of Coin</label>
            <input type="text" id="price" name="price">
            <input type="submit" name="submit" value="Add Coin" class="add-coin-button">
            </form>
        </div>
    </div>
    
    <div class="center-table">
        <div class="table-container">
                <?php
                    $query = "SELECT * FROM coins_table";
                    $result = mysqli_query($conn, $query);

                    if(!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()){
                        $rowNameCoins = $row["name"];
                        $rowNumberCoins = $row["number"];
                        $rowPriceCoins = $row["price"];
                        echo"<table>
                                <thead>
                                    <tr>
                                        <td>Coin Name</td>
                                        <td>Number of Coin</td>
                                        <td>Coin Price</td>
                                        <td>Current Value</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>". $rowNameCoins."</td>
                                        <td>". $rowNumberCoins ."</td>
                                        <td>₱". number_format(round($rowPriceCoins, 2), 2, '.', ',')  ."</td>
                                        <td>₱". number_format(round($rowNumberCoins * $rowPriceCoins, 2), 2, '.', ',') . "</td>
                                        
                                        <td class='table-buttons'>
                                            <a href='edit-page.php?id=$row[id]'>
                                                <button>Edit</button>
                                            </a>

                                            <a href='delete.php?id=$row[id]'>
                                                <button>Delete</button>
                                            </a>  
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                </tbody>
                            </table>";
                    }  
                ?>  
        </div>
    </div>

    <script src="scripts/index-script.js"></script>

</body>
</html>