<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between" style="font-size: 30px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                <span>Cliente</span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="bi bi-bag"></i> Nome </th>
                            <th scope="col"><i class="bi bi-cash"></i> Email </th>
                            <th scope="col"><i class="bi bi-gear"></i> Opções </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once 'config/conexao.php';
                        include_once 'config/constantes.php';

                        $conn = connection();

                        $select = $conn->prepare("SELECT * FROM adm WHERE tipo = 'cliente'");
                        $conn->beginTransaction();
                        $select->execute();
                        $conn->commit();


                        if ($select->rowCount() > 0) {
                            foreach ($select as $table) {
                                $idcliente = $table['idadm'];
                                $nomecli = $table['nome'];
                                $emailcli = $table['email'];
                                $ativocli = $table['ativo'];


                        ?>
                                <tr>
                                    <th scope="row"><?php echo $idcliente ?></th>
                                    <td><?php echo $nomecli ?></td>
                                    <td><?php echo $emailcli ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#vercli<?php echo $idcliente ?>">Ver <i class="bi bi-plus-circle"></i></button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delcli<?php echo $idcliente ?>">Delete <i class="bi bi-ban"></i></button>
                                        </div>
                                    </td>
                                </tr>








                                <!-- Modal Ver mais -->
                                <div class="modal fade" id="vercli<?php echo $idcliente ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h1 class="modal-title fs-5 text-white " id="h1prodcad">Ver Cliente</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                </div>
                                                <div class="col-md-7">
                                                    <p><b>Nome: </b><?php echo $nomecli ?></p>
                                                    <p><b>Email: </b><?php echo $emailcli ?></p>
                                                    <p><b>Ativo: </b><?php echo $ativocli ?></p>
                                                </div>
                                                <center><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            </div>

            <!-- Modal Delete -->
            <div class="modal fade" id="delcli<?php echo $idcliente ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="delete.php" method="get">
                                <h5 class="text-danger">VOCÊ TEM CERTEZA QUE DESEJA EXCLUIR O CLIENTE "<?php echo $nomecli ?>"??!!</h5>

                                <center><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Não</button>
                                    <a href="delete.php?idcliente=<?php echo $idcliente ?>" class="btn btn-outline-danger">Sim <i class="bi bi-ban"></i></a>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal update -->
            <div class="modal fade" id="update<?php echo $idproduto ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h1 class="modal-title fs-5 text-white " id="h1prodcad">Atualizar Produto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="update.php" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="idprodup" name="idprodup" aria-describedby="emailHelp" hidden value="<?php echo $idproduto ?>">
                                    <label for="nomeprodup" class="form-label text-dark">Nome</label>
                                    <input type="text" class="form-control" id="nomeprodup" name="nomeprodup" aria-describedby="emailHelp" placeholder="Informe o nome do produto" value="<?php echo $nomeprod ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="fotoprodup" class="form-label text-dark">Foto</label>
                                    <input class="form-control" type="file" id="fotoprodup" name="fotoprodup">
                                </div>
                                <div class="mb-3">
                                    <label for="valorprodup" class="form-label text-dark">Valor</label>
                                    <input type="text" class="form-control" id="valorprodup" name="valorprodup" aria-describedby="emailHelp" placeholder="Informe o valor do produto" value="<?php echo $valorprod ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="descprodup" class="form-label text-dark">Descrição</label>
                                    <input type="text" class="form-control" id="descprodup" name="descprodup" aria-describedby="emailHelp" placeholder="Informe a descrição do produto" value="<?php echo $descricaoprod ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="ativoupprod" class="form-label text-dark">Ativo</label>
                                    <select class="form-select" aria-label="Default select example" id="ativoupprod" name="ativoupprod">
                                        <option value="A">Ativado</option>
                                        <option value="D">Desativado</option>
                                    </select>
                                </div>
                                <center><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-warning">Atualizar <i class="bi bi-upload"></i></button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <?php
                            }
                        } else {
                            echo 'Nenhum produto encontrado.';
                        }
    ?>
    </tbody>
    </table>
        </div>
    </div>
</div>
</div>


<!-- Modal cadastro-->
<div class="modal fade" id="cadprod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white " id="h1prodcad">Cadastrar Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="cad.php" method="post">
                    <div class="mb-3">
                        <label for="nomeprod" class="form-label text-dark">Nome</label>
                        <input type="text" class="form-control" id="nomeprod" name="nomeprod" aria-describedby="emailHelp" placeholder="Informe o nome do produto">
                    </div>
                    <div class="mb-3">
                        <label for="fotoprod" class="form-label text-dark">Foto</label>
                        <input class="form-control" type="file" id="fotoprod" name="fotoprod">
                    </div>
                    <div class="mb-3">
                        <label for="valorprod" class="form-label text-dark">Valor</label>
                        <input type="text" class="form-control" id="valorprod" name="valorprod" aria-describedby="emailHelp" placeholder="Informe o valor do produto">
                    </div>
                    <div class="mb-3">
                        <label for="descprod" class="form-label text-dark">Descrição</label>
                        <input type="text" class="form-control" id="descprod" name="descprod" aria-describedby="emailHelp" placeholder="Informe a descrição do produto">
                    </div>
                    <center><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>