<?php
// =========================
// PHP de backend: deletar marca
// =========================

session_start();
require_once "db.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Verifica se o ID da marca foi fornecido
if (!isset($_GET['id'])) {
    header('Location: listarMarca.php');
    exit;
}

$id = $_GET['id'];

// Verifica se a marca existe antes de deletar
$stmt = $conn->prepare("SELECT id FROM marcas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $stmt = $conn->prepare("DELETE FROM marcas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Redireciona de volta para a lista de marcas
header('Location: listarMarca.php');
exit;
?>
