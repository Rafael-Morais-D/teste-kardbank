<?php

    require_once("./config/conexao.php");

    if(isset($_GET) && $_GET){
        $id = $_GET["id"];

        $query = $db->prepare('select * from usuarios where id = :id');

        $query->execute([
            ":id" => $id
        ]);

        $usuarioEncontrado = $query->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST) && $_POST){
        
        $id = $_POST["id"];
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        $query = $db->prepare('update usuarios set cpf = :cpf, nome = :nome, telefone = :telefone, email = :email where id = :id');

        $alterou = $query->execute([
            ":cpf" => $cpf,
            ":nome" => $nome,
            ":telefone" => $telefone,
            ":email" => $email,
            ":id" => $id
        ]);
    }
?>

<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>
    <main class="container">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="cadastroForm">
        <h3 class="col-12 text-center my-3">Formulário de Alteração de Cadastro</h3>
            <form action="edita-usuario.php" method="POST" onsubmit="validarCPF(<?= $_POST['cpf'] ?>)">
                <input type="hidden" class="form-control" id="id" name="id" 
                value="<?= isset($_GET["id"]) ? $_GET["id"] : $_POST["id"]  ?>" required>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?= isset($_GET["id"]) ? $usuarioEncontrado["cpf"] : $_POST["cpf"] ?>" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="nome">Nome completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($_GET["id"]) ? $usuarioEncontrado["nome"] : $_POST["nome"] ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="<?= isset($_GET["id"]) ? $usuarioEncontrado["telefone"] : $_POST["telefone"] ?>" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= isset($_GET["id"]) ? $usuarioEncontrado["email"] : $_POST["email"] ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="btnEditar">Editar</button>
                <div class="form-group">
                    <?php
                        if(isset($_POST) && $_POST){
                            if($alterou){
                                echo '<div class=" col-md-12 mt-2 alert alert-success text-center">Usuário alterado com sucesso</div>';
                            } else {
                                echo '<div class="col-md-12 mt-2 alert alert-danger text-center">Falha ao processar requisição</div>';
                            }
                        }
                    ?>
                </div>
            </form>
        </section>
    </main>

    <?php require_once("./inc/footer.php"); ?>