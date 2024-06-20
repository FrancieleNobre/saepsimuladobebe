<?php
include_once("./config/conexao.php");
include_once("./config/constantes.php");
include_once("./func/funcoes.php");
$conn = connection();

if (isset($_POST['idprodup'])) {
    $id = $_POST['idprodup'];
    $nome = $_POST['nomeprodup'];
    $foto = $_POST['fotoprodup'];
    $valor = $_POST['valorprodup'];
    $descricao = $_POST['descprodup'];
    $ativo = $_POST['ativoupprod'];
    $update = "UPDATE produto SET idproduto = :idproduto, nome = :nome, foto = :foto, valor = :valor, descricao = :descricao, ativo = :ativo WHERE idproduto = :idproduto";
    $update = $conn->prepare($update);
    $update->bindParam(':idproduto', $id);
    $update->bindParam(':nome', $nome);
    $update->bindParam(':foto', $foto);
    $update->bindParam(':valor', $valor);
    $update->bindParam(':descricao', $descricao);  
    $update->bindParam(':ativo', $ativo); 
    $conn->beginTransaction();
    $update->execute();
    $conn->commit();
    header('location:dashboard.php?page=produto');
  }

  

  


  
