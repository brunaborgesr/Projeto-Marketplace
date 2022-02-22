<?php
include_once("conexao.php");

$id = $_GET['id'];
$deletar = mysqli_query($conexao,"DELETE FROM solicitacao WHERE idsolicitacao='$id'");

if($deletar ){
    mysqli_close($conexao);
    header("Location: ../solicitacoes.php");
    exit;
}else{
    echo "Não foi possível deletar solicitação";
}

?>