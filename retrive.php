<?php
include "db.php";
$sql = "SELECT * FROM account";
$result = mysqli_query($conn, $sql);

$sql_invest = "SELECT acc_name FROM account
WHERE acc_name='Investment Account'";
$result_invest = mysqli_query($conn, $sql_invest);

$sql_invest_balance = "SELECT acc_value FROM account
WHERE acc_name='Investment Account'";
$result_invest_balance = mysqli_query($conn, $sql_invest_balance);
$row_invest_balance  = mysqli_fetch_assoc($result_invest_balance );

$sql_invest_history = "SELECT * FROM account_c_history ORDER BY datetime DESC";
$result_invest_history = mysqli_query($conn, $sql_invest_history);

?>