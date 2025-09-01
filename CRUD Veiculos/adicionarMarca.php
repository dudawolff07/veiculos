<?php 
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['nome'];

    $stmt = $conn->prepare("INSERT INTO marcas (nome) VALUES (?)");
    $stmt->bind_param("s", $marca);
    $stmt->execute();

    header('Location: listarMarca.php');
    exit;
}
?>

<?php include "header.php"; ?>

<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h3 class="card-title mb-0"><i class="bi bi-tag"></i> Adicionar Marca</h3>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Marca</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Salvar
            </button>
            <a href="listarMarca.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>