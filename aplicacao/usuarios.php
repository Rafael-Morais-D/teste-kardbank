<?php

    require_once('./config/conexao.php');

    //Excluindo usuarios
    if(isset($_GET) && $_GET){
        $query = $db->prepare('delete from usuarios where id = :id');
        
        $excluiu = $query->execute([
            ":id"=>$_GET["id"]
        ]);
    }

    //Listando usuários
    $query = $db->query('select * from usuarios');
    
    $arrayUsuarios = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once("./inc/head.php") ?>
<?php require_once("./inc/header.php") ?>

    <main class="container">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuariosTb">

            <h3 class="col-12 text-center my-3">Usuários</h3>
            <table class="table my-5">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome completo</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col" colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arrayUsuarios as $usuario): ?>
                        <tr>
                            <th scope="row"><?= $usuario["cpf"]; ?></th>
                            <td><?= $usuario["nome"] ?></td>
                            <td><?= $usuario["telefone"]; ?></td>
                            <td><?= $usuario["email"]; ?></td>
                            <td>
                                <a href="edita-usuario.php?id=<?= $usuario["id"] ?>">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal<?= $usuario["id"] ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="modal<?= $usuario["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Deseja realmente excluir?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Usuário: <?= $usuario["nome"] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <a href="usuarios.php?id=<?= $usuario["id"] ?>">
                                                    <button type="button" class="btn btn-danger">Excluir</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <div class="col-md-12">
            <?php
                if(isset($_GET) && $_GET){
                    if($excluiu){
                        echo '<div class=" col-md-12 mt-2 alert alert-success text-center">Usuário excluído com sucesso</div>';
                    }else{
                        echo '<div class="col-md-12 mt-2 alert alert-danger text-center">Falha ao processar requisição</div>';
                    }
                }
            ?>
        </div>
    </main>

<?php require_once("./inc/footer.php") ?>