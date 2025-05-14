<?php
include 'connection.php';

$id = intval($_GET['id']);

$sql = "DELETE FROM products WHERE id = $id";

$conn->query($sql);

header("Location: dashboard.php");
?>
