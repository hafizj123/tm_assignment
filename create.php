<?php
    include "db.php";

    if(isset($_POST['create'])){
        $sql = "INSERT INTO account (acc_name, acc_value)
        VALUES ('Investment Account', '0')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ./");
            } 
    }
?>