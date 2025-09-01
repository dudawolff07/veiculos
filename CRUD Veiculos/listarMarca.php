<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$result = $conn->query("SELECT * FROM marcas");
$marcas = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include "header.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-tag"></i> Marcas</h2>
    <a href="adicionarMarca.php" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Adicionar Marca
    </a>
</div>

<div class="table-responsive">
    <table class="table table-custom table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($marcas as $m): ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= htmlspecialchars($m['nome']) ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="editarMarca.php?id=<?= $m['id'] ?>" class="action-link action-edit">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="deletarMarca.php?id=<?= $m['id'] ?>" class="action-link action-delete" 
                           onclick="return confirm('Deseja excluir?')">
                            <i class="bi bi-trash"></i> Excluir
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>