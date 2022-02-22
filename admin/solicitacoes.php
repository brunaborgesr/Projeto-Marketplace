<?php
session_start();

if (!isset($_SESSION['usuarioId']) or ($_SESSION['usuarioNiveisAcessoId'] != 1)) {
    session_destroy();

    header("Location: ../login");
    exit;
}
include_once("../dao/conexao.php");

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

$query_solicitacoes = "SELECT nome_usuario, foto, email, idsolicitacao, status FROM solicitacao
    INNER JOIN contratante on contratante.idcontratante = solicitacao.contratante_idcontratante
    INNER JOIN servicos on servicos.idservicos = solicitacao.servicos_idservicos
    INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador
    INNER JOIN usuario on usuario.idusuario = contratante.usuario_idusuario
    WHERE prestador_idprestador = '" . $_SESSION['idPrestador']  . "' ";

$solicitacoes = mysqli_query($conexao, $query_solicitacoes);
$total_solicitacoes = mysqli_num_rows($solicitacoes);
$quantidade_pag = 5;

$num_pagina = ceil($total_solicitacoes / $quantidade_pag);
$inicio = ($quantidade_pag * $pagina) - $quantidade_pag;

$query_final = "SELECT nome_usuario, foto, email, idsolicitacao, status FROM solicitacao
    INNER JOIN contratante on contratante.idcontratante = solicitacao.contratante_idcontratante
    INNER JOIN servicos on servicos.idservicos = solicitacao.servicos_idservicos
    INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador
    INNER JOIN usuario on usuario.idusuario = contratante.usuario_idusuario
    WHERE prestador_idprestador =  '" . $_SESSION['idPrestador']  . "' ORDER BY status, data_solicitacao DESC LIMIT $inicio, $quantidade_pag";

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
    <link rel="stylesheet" href="../css/solicitacoesaguardoP.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/bootstrap" />
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.maskedinput.js"></script>
    <script src="../js/mascaras.js"></script>
    <link rel="shortcut icon" href="../images/favicon.ico"/>
    <title>EmpresaX | Minhas Solicitações</title>
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
                            <a class="nav-link" href="#">Minhas Solicitações<span class="sr-only">(current)</span></a>
                        </li>
                    </div>
                </ul>
                <!--SEGUNDA LISTA DE LINKS-->
                <ul class="navbar-nav usuario align-items-center justify-content-center">
                    <li class="nav-item facaLogin d-flex justify-content-center align-items-center">
                        <a class="nav-link" href="profile" data-toggle="tooltip" data-placement="bottom" title="Acesse seu perfil, clicando em seu nome !">
                            <b>Olá,</b> <?php echo $_SESSION['usuarioNome'] ?>
                        </a>
                        <a href="../sair">Sair</a>
                    </li>
                </ul>
                <!--FIM DAS LISTAS-->
            </div>
            <!--FIM DA DIV QUE MOSTRA NO BOTAO OCULTO-->
        </nav>
        <!--FIM NAVBAR-->
        <div class="left-text">
            <p>Lembre-se de entrar em contato com o cliente logo após a<br>
                aprovação para saber sobre o serviço, preços</p>
        </div>

        <div class="tabela">
            <?php
            if ($result->num_rows > 0) {
                while ($rows_solicita = $result->fetch_assoc()) {
            ?>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td class="comptabela">
                                    <div class="container infoAllUser">
                                        <?php
                                        if ($rows_solicita['foto']) {  ?>
                                            <img class="img-responsive" src="../<?php echo $rows_solicita['foto']; ?>" alt="Imagem responsiva">
                                        <?php } else { ?>
                                            <img class="img-responsive" alt="Imagem responsiva">
                                        <?php } ?>
                                        <div class="d-flex infoUser">
                                            <div class="linkUser">
                                                <a href="#"><?php echo $rows_solicita['nome_usuario']; ?></a>
                                            </div>
                                            <div class="e-mailUser">

                                                <a href=mailto:<?php echo $rows_solicita['email']; ?>>
                                                    <h6>
                                                        <?php echo $rows_solicita['email']; ?>
                                                    </h6>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="container containerBotao">
                                        <?php
                                        if ($rows_solicita['status'] == "Em Andamento") {
                                        ?>
                                            <form action="" method="post">
                                                <button type="text" name="aprovar" class="btn btn-aprovar " value="<?php echo $rows_solicita['idsolicitacao'] ?>">
                                                    Aprovar

                                                    <?php
                                                    if (isset($_POST['aprovar'])) {
                                                        $value = (int) $_POST['aprovar'];
                                                        $update = mysqli_query($conexao, "UPDATE solicitacao SET solicitacao.status = 'Aprovado' WHERE 
                                                        idsolicitacao = '$value'");

                                                        echo "
                                                            <script>
                                                                alert('Você aceitou a soliticação, entre em contato pelo email do cliente!');
                                                                window.location = 'solicitacoes';
                                                            </script>
                                                        ";
                                                    }
                                                    ?>
                                                </button>
                                                <button type="text" name="recusar" class="btn btn-recusar " value="<?php echo $rows_solicita['idsolicitacao'] ?>">
                                                    Recusar
                                                    <?php
                                                    if (isset($_POST['recusar'])) {
                                                        $value = (int) $_POST['recusar'];
                                                        $recusa_solicitacao = mysqli_query($conexao, "UPDATE solicitacao SET solicitacao.status = 'Negado'  WHERE idsolicitacao = '$value'");

                                                        echo "
                                                            <script>
                                                                alert('Você recusou a soliticação do cliente.');
                                                                window.location = 'solicitacoes';
                                                            </script>
                                                        ";
                                                    }
                                                    ?>

                                                </button>
                                            </form>
                                        <?php
                                        } else if ($rows_solicita['status'] == "Aprovado") {
                                        ?>
                                            <form action="" method="post">
                                                <button type="text" name="finalizar" class="btn btn-success " value="<?php echo $rows_solicita['idsolicitacao'] ?>">

                                                    Finalizar serviço

                                                    <?php
                                                    if (isset($_POST['finalizar'])) {
                                                        $value = (int) $_POST['finalizar'];
                                                        $query_finaliza = mysqli_query($conexao, "UPDATE solicitacao SET solicitacao.status = 'Finalizado' WHERE idsolicitacao = '$value'");
                                                        echo "
                                                                        <script>
                                                                            alert('Você finalizou a soliticação do cliente, aguarde a avaliação :)');
                                                                            window.location = 'solicitacoes';
                                                                        </script>
                                                                    ";
                                                    }
                                                    ?>
                                                </button>
                                            </form>

                                        <?php
                                        } else if ($rows_solicita['status'] == "Finalizado") {
                                        ?>
                                            <button type="text" name="finalizado" class="btn btn-success ">
                                                Serviço finalizado
                                            </button>
                                        <?php
                                        } else if ($rows_solicita['status'] == "Negado") {
                                        ?>
                                            <button type="text" name="finalizado" class="btn btn-dark">
                                                Serviço negado
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
            } else {
                ?>
                <script>
                    window.location = "semsolicitacoes";
                </script>
            <?php
            }
            ?>
            <!--paginação-->
            <div class="container paginacao d-flex justify-content-center align-items-center">
                <?php
                $pagina_anterior = $pagina - 1;
                $pagina_posterior = $pagina + 1;
                ?>
                <nav aria-label="text-center">
                    <ul class="pagination">
                        <li class="page-item d-flex justify-content-center align-items-center">
                            <?php
                            if ($pagina_anterior != 0) {
                            ?>
                                <a class="page-link" aria-label="Previous" href="solicitacoes?pagina=<?php echo $pagina_anterior ?>">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            <?php
                            } else {
                            ?>
                                <span aria-hidden="true">&laquo;</span>
                            <?php
                            }
                            ?>
                        </li>

                        <?php
                        for ($i = 1; $i < $num_pagina + 1; $i++) {
                        ?>
                            <li>
                                <a class="page-link" href="solicitacoes?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="page-item d-flex justify-content-center align-items-center">
                            <?php
                            if ($pagina_posterior <= $num_pagina) {
                            ?>
                                <a class="page-link" aria-label="Previous" href="solicitacoes?pagina=<?php echo $pagina_posterior; ?>">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <?php
                            } else {
                            ?>
                                <span aria-hidden="true">&raquo;</span>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
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