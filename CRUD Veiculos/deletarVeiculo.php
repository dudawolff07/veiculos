<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: listarVeiculo.php');
    exit;
}

$id = $_GET['id'];

// Verifica se o veículo existe antes de deletar
$stmt = $conn->prepare("SELECT id FROM veiculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $stmt = $conn->prepare("DELETE FROM veiculos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header('Location: listarVeiculo.php');
exit;
?>