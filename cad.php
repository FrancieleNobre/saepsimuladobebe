<?php
include_once("./config/conexao.php");
include_once("./config/constantes.php");
include_once("./func/funcoes.php");

$conn = connection();

if (isset($_POST['turma'], $_POST['professor'])) {
    $turma = $_POST['turma'];
    $professor = $_POST['professor'];

    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO turma (nome) VALUES (?)");
        $stmt->bindParam(1, $turma);
        $stmt->execute();
        $ultimo_id = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO aula (idprofessor, idturma) VALUES (?, ?)");
        $stmt->bindParam(1, $professor);
        $stmt->bindParam(2, $ultimo_id);
        $stmt->execute();
        $conn->commit();


        header('Location: dashboard.php');
        exit();
    } catch (PDOException $e) {

        $conn->rollback();

        echo "Erro: " . $e->getMessage();
    }
}

if (isset($_POST['nameatv'])) {
    $name = $_POST['nameatv'];
    $turma = $_POST['turmaa'];
    $professor = $_POST['porofessor'];


    $stmt = $conn->prepare("INSERT INTO `saep`.`atividade` (`idturma`, `nome`) VALUES (?, ?)");
    $stmt->bindParam(1, $turma);
    $stmt->bindParam(2, $name);
    $conn->beginTransaction();
    $stmt->execute();
    $conn->commit();
    header('Location: dashboard.php');
    exit();
}
