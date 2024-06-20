<?php
session_start();

if (isset($_SESSION["nome"]) && isset($_SESSION['email']) && isset($_SESSION["idprofessor"])) {
    $nome = htmlspecialchars($_SESSION["nome"]);
    $email = htmlspecialchars($_SESSION["email"]);
    $id = htmlspecialchars($_SESSION["idprofessor"]);
} else {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php echo $nome; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex" role="search">
                    <a href="logout.php" class="btn btn-outline-light">Sair</a>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-light" style="margin-top: 60px;">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                            <th scope="col">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadastro">Cadastrar</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once 'config/conexao.php';
                        include_once 'config/constantes.php';

                        $conn = connection();

                        $select = $conn->prepare("SELECT p.*, t.*, a.* FROM professor p
                        INNER JOIN aula a ON a.idprofessor = p.idprofessor
                        INNER JOIN turma t ON t.idturma = a.idturma
                        WHERE p.idprofessor = $id");
                        $conn->beginTransaction();
                        $select->execute();
                        $conn->commit();


                        if ($select->rowCount() > 0) {
                            foreach ($select as $table) {
                                $idturma = htmlspecialchars($table['idturma']);
                                $nome_turma = htmlspecialchars($table['nome']);
                                $ativo = htmlspecialchars($table['ativo']);
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $idturma; ?></th>
                                    <td><?php echo $nome_turma; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#visu<?php echo $idturma; ?>">Visualizar</button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#excluir<?php echo $idturma; ?>">Excluir</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal excluir -->
                                <div class="modal fade" id="excluir<?php echo $idturma; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-light">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Turma</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-danger">
                                                <h5>VOCÊ TEM CERTEZA QUE DESEJA EXCLUIR A TURMA "<?php echo $nome_turma; ?>"??</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Não</button>
                                                <a href="delete.php?idturma=<?php echo $idturma; ?>" class="btn btn-outline-danger">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal cadastrar atividade -->
                                <div class="modal fade" id="cadastroatv<?php echo $idturma ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-light">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Atividade</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="cad.php" method="post">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" hidden id="porofessor" name="porofessor" value="<?php echo $id ?>">
                                                        <input type="text" class="form-control" hidden id="turmaa" name="turmaa" value="<?php echo $idturma ?>">
                                                        <label for="nameatv" class="form-label">Nome da atividade</label>
                                                        <input type="text" class="form-control" id="nameatv" name="nameatv" placeholder="Informe o nome da atividade">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal visualizar -->
                                <div class="modal fade" id="visu<?php echo $idturma; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-light">
                                                <h5 class="modal-title" id="exampleModalLabel">Visualizar Atividades</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Número </b></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p><b>Atividade</b></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadastroatv<?php echo $idturma; ?>">Cadastrar atividade</button>
                                                    </div>
                                                </div>
                                                <hr style="width:100%;">
                                                <?php
                                                try {
                                                    $conn->beginTransaction();

                                                    $selectAtividades = $conn->prepare("
                                                        SELECT at.* FROM atividade at
                                                        WHERE at.idturma = :idturma
                                                    ");
                                                    $selectAtividades->bindParam(':idturma', $idturma, PDO::PARAM_INT);
                                                    $selectAtividades->execute();
                                                    $atividades = $selectAtividades->fetchAll(PDO::FETCH_ASSOC);
                                                    $conn->commit();

                                                    if (count($atividades) > 0) {
                                                        foreach ($atividades as $atividade) {
                                                            $idatividade = htmlspecialchars($atividade['idatividade']);
                                                            $nomeat = htmlspecialchars($atividade['nome']);
                                                ?>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <p><?php echo $idatividade; ?></p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p><?php echo $nomeat; ?></p>
                                                                </div>
                                                            </div>
                                                            <hr style="width:100%; color:black;">
                                                <?php
                                                        }
                                                    } else {
                                                        echo '<p>Não existem atividades para essa turma!</p>';
                                                    }
                                                } catch (Exception $e) {
                                                    $conn->rollBack();
                                                    echo "Erro: " . $e->getMessage();
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo 'Não existem turmas cadastradas!';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal cadastro -->
    <div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Turma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="cad.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                        <input type="text" class="form-control" hidden id="professor" name="professor" value="<?php echo $id ?>">
                            <input type="text" class="form-control" hidden id="professor" name="professor" value="<?php echo $id ?>">
                            <label for="turma" class="form-label">Nome da turma</label>
                            <input type="text" class="form-control" style="border-color: black;" id="turma" name="turma" required placeholder="Informe o nome da turma">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>