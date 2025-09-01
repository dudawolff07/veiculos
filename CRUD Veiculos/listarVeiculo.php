<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT v.*, m.nome as marca_nome FROM veiculos v JOIN marcas m ON v.marca_id = m.id";
$result = $conn->query($sql);
$veiculos = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include "header.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-car-front"></i> Veículos</h2>
    <a href="adicionarVeiculo.php" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Adicionar Veículo
    </a>
</div>

<div class="table-responsive">
    <table class="table table-custom table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Potência</th>
                <th>Ano</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($veiculos as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= htmlspecialchars($v['modelo']) ?></td>
                <td><?= htmlspecialchars($v['marca_nome']) ?></td>
                <td><?= htmlspecialchars($v['potencia']) ?></td>
                <td><?= $v['ano'] ?></td>
                <td>
                    <span class="badge bg-info"><?= htmlspecialchars($v['tipo']) ?></span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="editarVeiculo.php?id=<?= $v['id'] ?>" class="action-link action-edit">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="deletarVeiculo.php?id=<?= $v['id'] ?>" class="action-link action-delete" 
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