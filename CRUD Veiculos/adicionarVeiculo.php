<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$result = $conn->query("SELECT * FROM marcas");
$marcas = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $marca_id = $_POST['marca_id'];
    $potencia = $_POST['potencia'];
    $ano = $_POST['ano'];
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("INSERT INTO veiculos (modelo, marca_id, potencia, ano, tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisis", $modelo, $marca_id, $potencia, $ano, $tipo);
    $stmt->execute();
    
    header('Location: listarVeiculo.php');
    exit;
}
?>

<?php include "header.php"; ?>

<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h3 class="card-title mb-0"><i class="bi bi-car-front"></i> Adicionar Veículo</h3>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="marca_id" class="form-label">Marca:</label>
                    <select class="form-select" id="marca_id" name="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        <?php foreach($marcas as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="potencia" class="form-label">Potência:</label>
                    <input type="text" class="form-control" id="potencia" name="potencia">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="ano" class="form-label">Ano:</label>
                    <input type="number" class="form-control" id="ano" name="ano">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Tipo:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="tipoCarro" value="Carro" required>
                            <label class="form-check-label" for="tipoCarro">Carro</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="tipoMoto" value="Moto">
                            <label class="form-check-label" for="tipoMoto">Moto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="tipoCaminhao" value="Caminhão">
                            <label class="form-check-label" for="tipoCaminhao">Caminhão</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Salvar
                </button>
                <a href="listarVeiculo.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>