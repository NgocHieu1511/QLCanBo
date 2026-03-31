<?php
include "connect.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tblCanBo WHERE macb=$id");

header("Location: index.php");
?>