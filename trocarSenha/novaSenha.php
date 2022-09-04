<?php 
session_start();
include('../php/function.php');
if($_POST){
    if(empty($_POST['codigo'])){
        header('Location: novaSenha.php');
        exit();
    }else{
        TrocarSenha($_POST['senha']);
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
<body id="body-senha">
    <main id="main-senha">
        <section id="section-senha" style="flex-direction: column;">
            <div id="div-senha">
                <p>Eta Carinae</p>
                <form action="" method="POST" id="form-senha" autocomplete="off">
                    <p class="centralText">Um código de verificação foi enviado para seu email. Não se esqueça de olhar a caixa de spam!</p>
                    <label for="senha">Código de verificação: </label>
                    <input type="text" id="senha" name="senha" placeholder="Codigo">
                    <button type="submit" name="entrar" id="entrar">Enviar</button>
                    <p class="centralText"><a href="index.php">Cancelar</a></p>
                </form>
            </div>
            <?php
                if(isset($_SESSION[''])):
            ?> 
                <div id="">
                    <p></p>
                </div>
            <?php
                endif;
                unset($_SESSION['']);
            ?>
        </section>
    </main>
</body>
</html>