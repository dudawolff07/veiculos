<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: listarMarca.php');
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM marcas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$marca = $result->fetch_assoc();

if (!$marca) {
    header('Location: listarMarca.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaMarca = $_POST['nome'];
    
    $stmt = $conn->prepare("UPDATE marcas SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $novaMarca, $id);
    $stmt->execute();

    header('Location: listarMarca.php');
    exit;
}
?>

<?php include "header.php"; ?>

<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h3 class="card-title mb-0"><i class="bi bi-tag"></i> Editar Marca</h3>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Marca</label>
                <input type="text" class="form-control" id="nome" name="nome" 
                       value="<?= htmlspecialchars($marca['nome']) ?>" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Salvar
                </button>
                <a href="listarMarca.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>