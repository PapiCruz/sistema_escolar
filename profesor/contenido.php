<?php
if(!empty($_GET['curso'])){
    $curso = $_GET['curso'];
}else{
    header("Location: profesor");
}
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_contenido.php';

    $idProfesor = $_SESSION['profesor_id'];

    $sql = "SELECT * FROM contenidos as c INNER JOIN profesor_materia as pm ON c.pm_id WHERE pm.pm_id = $curso";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
    ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Contenidos a Evaluar</h1>
          <button class="btn btn-success" type="button" onclick="openModalContenido()">Nuevo Contenido</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Contenidos a Evaluar</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if($row > 0){
            while($data = $query->fetch()){
        ?>
        <div class="col-md-12">
          <div class="tile">
                <div class="title-title-w-btn">
                    <h3 class="title"><?= $data['titutlo']; ?></h3>
                    <p><button class="btn btn-info icon-btn" onclick="editarContenido(<?= $data['contenido_id']; ?>)"><i class="fa fa-edit"></i>Editar Contenido</button> <button class="btn btn-danger icon-btn" onclick="eliminarContenido(<?= $data['contenido_id<']; ?>)"><i class="fa fa-delet"></i>Eliminar Contenido</button> <a class="btn btn-warnig icon-btn" href="evaluacion.php?curso=<?= $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa fa-edit"></i>Asignar Evaluacion</a></p>
                </div>
                <div class="title-body">
                    <b><?= $data['descripcion']; ?></b>
                </div>
                <div class="title-footer-mt4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> <i class="fas fa-download"></i> </div>
                            </div>
                            <a class="btn btn-primary" href="profesor/profesor/<?= $data['materia']; ?>" target="_blank">Material de Descarga</a>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <?php } } ?>
      </div>

      <div class="row">
        <a href="index.php" class="btn btn-info"><< Volver Atras</a>
      </div>
    </main>

<?php
    require_once 'includes/footer.php';
?>