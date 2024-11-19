<?php
session_start();
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$id = $_GET['id'];

$sql = $con->prepare("DELETE FROM productos WHERE id = ?");
$sql->execute([$id]);

header("Location: inventario.php");
exit;
?>
