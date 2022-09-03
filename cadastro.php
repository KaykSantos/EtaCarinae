<?php 
session_start();
include('php/function.php');
if($_POST){
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['tell'])){
        header('Location: cadastro.php');
        exit();
    }else{
        CadastrarUsuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['tell']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body id="body-cad">
    <main id="main-cad">
        <section id="section-cad" style="flex-direction: column;">
            <div id="cadastro">
                <p>Eta Carinae</p>
                <form action="" method="POST" id="form-cad" autocomplete="off">
                    <label for="name">Digite seu nome:</label>
                    <input type="text" id="name" name="name" placeholder="Nome">
                    <label for="email">Digite seu email:</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <label for="senha">Digite sua senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <label for="tell">Digite seu telefone:</label>
                    <input type="tell" name="tell" id="tell" placeholder="(XX) XXXXX-XXXX">
                    <button type="submit" name="cadastrar" id="cadastrar">Cadastrar</button>
                    <p class="centralText">Já possui uma conta?</p>
                    <p class="centralText"><a href="index.php">Entrar!</a></p>
                </form>
            </div>
            <?php
            if(isset($_SESSION['status_cadastro'])):
            ?>
                <div id="cadastroEfetuado">
                    <p>Cadastro efetuado com sucesso! 
                        Faça login para continuar.</p>
                </div>
            <?php
            endif;
            unset($_SESSION['status_cadastro'])
            ?>

            <?php
            if(isset($_SESSION['usuario_existe'])):
            ?>
            <div id="usuarioExiste">
                <p>Email já utilizado! Insira outro email ou faça login.</p>
            </div>
            <?php
            endif;
            unset($_SESSION['usuario_existe']);
            ?>
        </section>
    </main>
</body>
</html>