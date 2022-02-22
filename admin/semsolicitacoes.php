<?php
session_start();

if (!isset($_SESSION['usuarioId']) or ($_SESSION['usuarioNiveisAcessoId'] != 1)) {
    session_destroy();

    header("Location: ../login");
    exit;
}

include_once("../dao/conexao.php");

$query_final = "SELECT nome_usuario, foto, email, idsolicitacao, status FROM solicitacao
    INNER JOIN contratante on contratante.idcontratante = solicitacao.contratante_idcontratante
    INNER JOIN servicos on servicos.idservicos = solicitacao.servicos_idservicos
    INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador
    INNER JOIN usuario on usuario.idusuario = contratante.usuario_idusuario
    WHERE prestador_idprestador =  '" . $_SESSION['idPrestador']  . "' LIMIT 1";

$result = mysqli_query($conexao, $query_final);
$total = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="../css/semsolicitacoesP.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.maskedinput.js"></script>
    <link rel="shortcut icon" href="../images/favicon.ico"/>
    <title>EmpresaX | Sem Solicitações</title>
</head>

<body class="d-flex flex-column">
    <!--CONTAINER PRINCIPAL-->
    <div class="container-fluid">
        <!--NAVBAR-->
        <nav class="d-flex navbar navbar-expand-lg align-items-center justify-content-between">
            <span class="navbar-brand text-white">EmpresaX</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="d-flex justify-content-center align-items-center  navbar-toggler-icon">
                    <a class="fa fa-bars"></a>
                </span>
            </button>
            <!--BOTAO OCULTO PARA MOBILE-->
            <div class="collapse navbar-collapse align-items-center justify-content-between" id="navbarNavDropdown">
                <!--PRIMEIRA LISTA DE LINKS-->
                <ul class="navbar-nav linksnav align-items-center justify-content-center w-100">
                    <div class="links d-flex justify-content-center justify-content-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="solicitacoes">Minhas Solicitações<span class="sr-only">(current)</span></a>
                        </li>
                    </div>
                </ul>
                <!--SEGUNDA LISTA DE LINKS-->
                <ul class="navbar-nav usuario align-items-center justify-content-center">
                    <li class="nav-item facaLogin d-flex justify-content-center align-items-center">
                        <a class="nav-link" href="profile" data-toggle="tooltip" data-placement="bottom" title="Acesse seu perfil, clicando em seu nome !">
                            <b>Olá,</b> <?php echo $_SESSION['usuarioNome']; ?>
                        </a>
                        <a href="../sair.php">Sair
                        </a>
                    </li>
                </ul>
                <!--FIM DAS LISTAS-->
            </div>
            <!--FIM DA DIV QUE MOSTRA NO BOTAO OCULTO-->
        </nav>
        <?php
        if ($result->num_rows > 0) {
        ?>
            <script>
                window.location = "solicitacoes";
            </script>
        <?php
        } else {
        ?>
            <!--FIM NAVBAR-->
            <div class="left-text">
                <h5>Você ainda não tem solicitações de nem um cliente no
                    momento, aguarde até uma solicitação
                </h5>
            </div>
            <div class="content">
                <div class="left">
                    <img src="../images/naveEspacial.png" class="img-responsive" alt="Responsive image">
                </div>
            </div>
        <?php
        }
        ?>

        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <!--SCRIPT DE ICONES-->
        <script src="../js/fontawesome.js" crossorigin="anonymous"></script>
        <!--SCRIPT DO BOOTSTRAP-->
        <script src=" ../js/jquery-3.2.1.slim.min.js">
        </script>
        <script src="../js/popper.min.js">
        </script>
        <script src="../js/bootstrap.min.js">
        </script>
</body>

</html>