<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
include 'header.php'; 
?>

<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h3 class="card-title mb-0"><i class="bi bi-speedometer2"></i> Dashboard</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <h4 class="alert-heading">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_nome']); ?>!</h4>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-tag display-4 mb-3"></i>
                        <h5>Gerenciar Marcas</h5>
                        <p>Adicione, edite ou remova marcas de veículos</p>
                        <a href="listarMarca.php" class="btn btn-outline-light">Acessar Marcas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-car-front display-4 mb-3"></i>
                        <h5>Gerenciar Veículos</h5>
                        <p>Adicione, edite ou remova veículos</p>
                        <a href="listarVeiculo.php" class="btn btn-outline-light">Acessar Veículos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>