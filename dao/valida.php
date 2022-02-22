<?php
session_start();
//Incluindo a conexão com banco de dados
include_once("conexao.php");
//O campo usuário e senha preenchido entra no if para validar
if ((isset($_POST['email'])) && (isset($_POST['senha']))) {
    $usuario = mysqli_real_escape_string($conexao, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    //$senha = md5($senha);

    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_usuario = "SELECT * FROM usuario WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
    $resultado_usuario = mysqli_query($conexao, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);

    //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if (isset($resultado)) {
        $_SESSION['usuarioId'] = $resultado['idusuario'];
        $_SESSION['usuarioNome'] = $resultado['nome_usuario'];
        $_SESSION['usuarioNiveisAcessoId'] = $resultado['nivel_acesso'];
        $_SESSION['usuarioEmail'] = $resultado['email'];
        $_SESSION['enderecoUser'] = $resultado['endereco'];
        $_SESSION['fotoPerfil'] = $resultado['foto'];

        if ($_SESSION['usuarioNiveisAcessoId'] == "1") {
            $sqlprestador = "SELECT * FROM prestador WHERE usuario_idusuario = '". $_SESSION['usuarioId'] ."' LIMIT 1";
            $resultprestador = mysqli_query($conexao, $sqlprestador);
            $result = mysqli_fetch_assoc($resultprestador);
            $_SESSION['idPrestador'] = $result['idprestador'];

            header("Location: ../admin/solicitacoes");

        } elseif ($_SESSION['usuarioNiveisAcessoId'] == "0") {
            $sqlcontratante = "SELECT  * FROM `contratante` WHERE usuario_idusuario = '" . $_SESSION['usuarioId'] . "' LIMIT 1";
            $resultado_contratante = mysqli_query($conexao, $sqlcontratante);
            $resultadoFinalContrantate = mysqli_fetch_assoc($resultado_contratante);
            $_SESSION['idContratante'] = $resultadoFinalContrantate['idcontratante'];

            header("Location: ../solicitacoes");
        }
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        //redireciona o usuario para a página de login
    } else {
        //Váriavel global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "Usuário ou senha Inválido";
        header("Location: ../login");
    }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
} else {
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header("Location: ../login");
}
