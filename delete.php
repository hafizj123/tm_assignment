<?php
    include "db.php";

    if(isset($_POST['delete'])){
        $sql_delete_acc_c = "DELETE FROM account WHERE acc_name='Investment Account'";
        $sql_delete_all_row_c = "TRUNCATE TABLE account_c_history";
        $sql_invest_balance = "SELECT acc_value FROM account
        WHERE acc_name='Investment Account'";
        $result_invest_balance = mysqli_query($conn, $sql_invest_balance);
        $row_invest_balance = mysqli_fetch_assoc($result_invest_balance );
        $new_invest_balance = $row_invest_balance['acc_value']; 
        $sql_saving = "UPDATE `account` SET `acc_value`=acc_value+$new_invest_balance  WHERE `acc_name` = 'Savings Account'";
        if (mysqli_query($conn, $sql_delete_acc_c) && mysqli_query($conn, $sql_delete_all_row_c) && mysqli_query($conn, $sql_saving)) {
            header("Location: ./");
            } 
    }
?>