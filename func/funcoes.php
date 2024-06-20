<?php
function listarTabela($campos, $tabela, $campoOrdem)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela ORDER BY $campoOrdem ");
        //        $sqlLista->bindValue(1, $campoParametro, PDO::PARAM_INT);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOExecption $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function globalinsert7($tabela, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6, $campo7)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("INSERT FROM $tabela($campo1,$campo2,$campo3,$campo4,$campo5,$campo6,$campo7) VALUES (?,?,?,?,?,?,?)");
        $sqlLista->bindValue(1, $campo1, PDO::PARAM_INT);
        $sqlLista->bindValue(2, $campo2, PDO::PARAM_INT);
        $sqlLista->bindValue(3, $campo3, PDO::PARAM_INT);
        $sqlLista->bindValue(4, $campo4, PDO::PARAM_INT);
        $sqlLista->bindValue(5, $campo5, PDO::PARAM_INT);
        $sqlLista->bindValue(6, $campo6, PDO::PARAM_INT);
        $sqlLista->bindValue(7, $campo7, PDO::PARAM_INT);
        $sqlLista->execute();
        $conn->commit();
    } catch (PDOExecption $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function addusuario($nome, $email, $senhaHash)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("INSERT INTO usuario(nome, email, senha) VALUES (?,?,?)");
        $sqlLista->bindValue(1, $nome, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $email, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $senhaHash, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function adicionarfilme($idgenerofilme, $filme, $ativo)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("INSERT INTO filme(idgenerofilme, filme, ativo) VALUES (?,?,?)");
        $sqlLista->bindValue(1, $idgenerofilme, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $filme, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $ativo, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function deletar($tabela, $idex, $id)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("DELETE FROM $tabela WHERE $idex='$id'");

        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function alterarGlobal($tabela, $campo1, $campo2, $campo3, $valor1, $valor2, $valor3, $identificador, $id)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("UPDATE $tabela SET $campo1 = $valor1 , $campo2 = $valor2, $campo3 = $valor3 WHERE $identificador = $id");

        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function validarSenha($campos, $tabela, $campoBdString, $campoBdString2, $campoParametro, $campoParametro2, $campoBdAtivo, $valorAtivo)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos "
            . "FROM $tabela "
            . "WHERE $campoBdString = ? AND  $campoBdString2 = ? AND $campoBdAtivo = ? ");
        $sqlLista->bindValue(1, $campoParametro, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $campoParametro2, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $valorAtivo, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();

        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return "Vazio";
        }
    } catch (Throwable $e) {
        $error_message = 'Throwable:' . $e->getMessage() . PHP_EOL;
        $error_message = 'File:' . $e->getFile() . PHP_EOL;
        $error_message = 'Line:' . $e->getLine() . PHP_EOL;
        error_log($error_message, 3, 'log/arquivo_log.txt');
        $conn->rollBack();
        throw $e;
    };
}
function validarSenhaCriptografia($campos, $tabela, $campoBdString, $campoBdString2, $campoParametro, $campoParametro2, $campoBdAtivo, $valorAtivo)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos " . "FROM $tabela ". "WHERE $campoBdString = ? AND $campoBdAtivo = ? ");
        $sqlLista->bindValue(1, $campoParametro, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $valorAtivo, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            $retornoSql = $sqlLista->fetch(PDO::FETCH_OBJ);
            $senhaHash = $retornoSql->$campoBdString2;
            if (password_verify($campoParametro2,$senhaHash)) {
                return $retornoSql;
            }
         return 'senha';
        } else {
        return 'usuario';
        }
        return null;
    } catch (Throwable $e) {
        $error_message = 'Throwable:' . $e->getMessage() . PHP_EOL;
        $error_message = 'File:' . $e->getFile() . PHP_EOL;
        $error_message = 'Line:' . $e->getLine() . PHP_EOL;
        error_log($error_message, 3, 'log/arquivo_log.txt');
        $conn->rollBack();
        throw $e;
    };
}

// function globalinsert6($campos, $tabela,$campo1, $campo2, $campo3,$campo4,$campo5,$campo6,$valorAtivo)
// {
//     $conn = conectar();
//     try {
//         $conn->beginTransaction();
//         $sqlLista = $conn->prepare("INSERT FROM $tabela($campos) VALUES (?,?,?,?,?,?) ");
//         $sqlLista->bindValue(1, $campo1, PDO::PARAM_STR);
//         $sqlLista->bindValue(2, $campo2, PDO::PARAM_STR);
//         $sqlLista->bindValue(3, $campo3, PDO::PARAM_STR);
//         $sqlLista->bindValue(4, $campo4, PDO::PARAM_STR);
//         $sqlLista->bindValue(5, $campo5, PDO::PARAM_STR);
//         $sqlLista->bindValue(6, $campo6, PDO::PARAM_STR);
//         $sqlLista->bindValue(7, $valorAtivo, PDO::PARAM_STR);
//         $sqlLista->execute();
//         $conn->commit();

//         if ($sqlLista->rowCount() > 0) {
//             return $sqlLista->fetchAll(PDO::FETCH_OBJ);
//         } else {
//             return "Vazio";
//         }
//     } catch (Throwable $e) {
//         $error_message = 'Throwable:' . $e->getMessage() . PHP_EOL;
//         $error_message = 'File:' . $e->getFile() . PHP_EOL;
//         $error_message = 'Line:' . $e->getFile() . PHP_EOL;
//         error_log($error_message, 3, 'log/arquivo_log.txt');
//         $conn->rollBack();
//         throw $e;
//     };
// }
// function alterarGlobal($tabela,$campo,$valor,$identificador,$id)
// {
//     $conn = conectar();
//     try {
//         $conn->beginTransaction();
//         $sqlLista = $conn->prepare("UPDATE $tabela SET $campo = '$valor' WHERE $identificador = $id");

//         $sqlLista->execute();
//         $conn->commit();
//         if ($sqlLista->rowCount() > 0) {
//             return $sqlLista->fetchAll(PDO::FETCH_OBJ);
//         } else {
//             return 'Vazio';
//         };
//     } catch (PDOException $e) {
//         echo 'Exception -> ';
//         return ($e->getMessage());
//         $conn->rollback();
//     };
//     $conn = null;
// }