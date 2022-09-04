<?php 
session_start();
include('../php/function.php');
if($_POST){
    if(empty($_POST['email'])){
        header('Location: veriEmail.php');
        exit();
    }else{
        EnviarCodigo($_POST['email']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar senha</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>
<body id="body-email">
    <main id="main-email">
        <section id="section-email" style="flex-direction: column;">
            <div id="div-email">
                <p>Eta Carinae</p>
                <form action="" method="POST" id="form-email" autocomplete="off">
                    <label for="email">Email de verificação: </label>
                    <input type="email" id="email" name="email" placeholder="Email">
                    <button type="submit" name="entrar" id="entrar">Enviar</button>
                    <p class="centralText"><a href="../index.php">Cancelar</a></p>
                </form>
            </div>
            <?php
                if(isset($_SESSION['email-inexistente'])):
            ?> 
                <div id="emailNaoExiste">
                    <p>O email de verificação não está cadastrado! Tente novamente.</p>
                </div>
            <?php
                endif;
                unset($_SESSION['email-inexistente']);
            ?>
        </section>
        <!--- 
        <p class="centralText">Um código de verificação foi enviado para seu email. Não se esqueça de olhar a caixa de spam!</p>
            <label for="codigo">Código de verificação: </label>
            <input type="text" id="codigo" name="codigo" placeholder="Codigo">
            <button type="submit" name="entrar" id="entrar">Enviar</button>
        <p class="centralText"><a href="index.php">Cancelar</a></p>
        -->
    </main>
</body>
</html>