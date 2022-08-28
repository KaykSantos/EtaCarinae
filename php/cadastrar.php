<?php 
session_start();
include('conn.php');
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['tell'])){
    header('Location: ../cadastro.php');
    exit();
}   
$name = mysqli_real_escape_string($conexao, trim($_POST['name']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
$tell = mysqli_real_escape_string($conexao, trim(md5($_POST['tell'])));

$sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '{$email}'";
$res = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($res);

if($row['total'] == 1){
    $_SESSION['usuario_existe'] = true;
    header('Location: ../cadastro.php');
    exit;
}
$sql = "INSERT INTO usuario (nome, email, senha, telefone) VALUES ('$name', '$email', '$senha', '$tell')";
if($conexao->query($sql) === TRUE){
    $_SESSION['status_cadastro'] = true;
}
$conexao->close();
header('Location: ../cadastro.php');
exit;
?>
