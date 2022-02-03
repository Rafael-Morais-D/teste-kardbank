<?php

require_once('./config/conexao.php');

if (isset($_POST) && $_POST) {
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    
    $query = $db->prepare('insert into usuarios (cpf, nome, telefone, email) values (:cpf, :nome, :telefone, :email)');
    
    $cadastrou = $query->execute([
        ":cpf" => $cpf,
        ":nome" => $nome,
        ":telefone" => $telefone,
        ":email" => $email,
        ]);
    }
    
?>

<?php require_once("./inc/head.php") ?>
<?php require_once("./inc/header.php") ?>

<body>

    <main class="container">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="cadastroForm">
        <h3 class="col-12 text-center my-3">Cadastro de usuário</h3>
            <form action="index.php" method="POST" onsubmit="isValidCPF($_POST['cpf'])">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" id="cpf" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="nome">Nome completo</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control telefone" name="telefone" id="telefone" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary py-2 col-12 col-md-3" id="btnCadastrar">Cadastrar</button>
                    <div id="result" class="col-12 col-md-9"></div>
                </div>
                <div class="form-group col-md-12">
                    <?php
                        if(isset($_POST) && $_POST){
                            if($cadastrou){
                                echo '<div class=" col-md-12 mt-2 alert alert-success text-center">Usuário cadastrado com sucesso</div>';
                            } else {
                                echo '<div class="col-md-12 mt-2 alert alert-danger text-center">Falha ao processar requisiçãos</div>';
                            }
                        }
                    ?>
                </div>
            </form>
        </section>
    </main>

    <?php require_once("./inc/footer.php") ?>