<?php
include_once("./config/conexao.php");
include_once("./config/constantes.php");
include_once("./func/funcoes.php");
$conn = connection();
if (isset($_GET['idturma'])) {
  $id = $_GET['idturma'];

  $select = $conn->prepare("SELECT * FROM atividade WHERE idturma = :id");
  $select->bindParam(':id', $id);
  $select->execute();
  $atividades = $select->fetchAll();

  if (count($atividades) > 0) {
    echo '<script>alert("Não foi possível excluir, sua turma possui atividades");</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';
    exit;
  } else {
    $delete = $conn->prepare("DELETE FROM turma WHERE idturma = :id");
    $delete->bindParam(':id', $id);
    $delete->execute();
    echo '<script>alert("Exclusão efetuada com sucesso");</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';
    exit;
  }
} else {
  echo '<script>alert("Parâmetro idturma não especificado");</script>';
  echo '<script>window.location.href = "dashboard.php";</script>';
}