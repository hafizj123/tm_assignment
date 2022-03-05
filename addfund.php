<?php
    include "db.php";
    
    $amount2 = $_POST['amount2'];

    if(isset($_POST['addfunds'])){
        $sql = "INSERT INTO account_c_history (amount) VALUES ('$amount2')";
        $sql_invest_update = "UPDATE account SET acc_value=acc_value+$amount2 WHERE `acc_name` = 'Investment Account'";
        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql_invest_update)) {
            header("Location: ./");
            } 
    }
?>