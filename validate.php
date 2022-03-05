<?php
include "db.php";
$val = $_GET['val'];

$sql = "SELECT * FROM account
WHERE acc_name='$val'";
$result = mysqli_query($conn, $sql);
$row_validate  = mysqli_fetch_assoc($result);
echo $row_validate['acc_value'];
?>