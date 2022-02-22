<?php

$endereco = "localhost";
$usuario = "USERDB";
$senha  = "SENHADB";
$banco  = "NOMEBD";
$conexao = mysqli_connect($endereco, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Ocorreu um erro de conexão" . $conexao->connect_error);
}
