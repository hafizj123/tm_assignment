<?php
include "db.php";

if(isset($_POST['update']))
  {
    $acc_1 = $_POST['acc_1'];
    $acc_2 = $_POST['acc_2'];
    $amount = $_POST['amount'];

    $old_ammount_saving_sql = "SELECT * FROM account WHERE `acc_name` = '".$acc_1."'" ;
    $old_ammount_saving_result = mysqli_query($conn, $old_ammount_saving_sql);
    $old_ammount_saving_row = mysqli_fetch_assoc($old_ammount_saving_result);

    $old_ammount_goal_sql = "SELECT * FROM account WHERE `acc_name` = '".$acc_2."'" ;
    $old_ammount_goal_result = mysqli_query($conn, $old_ammount_goal_sql);
    $old_ammount_goal_row = mysqli_fetch_assoc($old_ammount_goal_result);

    $new_ammount_saving = $old_ammount_saving_row['acc_value'] - $amount;
    $new_ammount_goal = $old_ammount_goal_row['acc_value'] + $amount;

    $sql_saving = "UPDATE `account` SET `acc_value`='$new_ammount_saving'  WHERE `acc_name` = '".$acc_1."'";
    $sql_goal = "UPDATE `account` SET `acc_value`='$new_ammount_goal'  WHERE `acc_name` = '".$acc_2."'";
    if (mysqli_query($conn, $sql_saving) && mysqli_query($conn, $sql_goal)) {
    header("Location: ./");
        }   
  }
?>