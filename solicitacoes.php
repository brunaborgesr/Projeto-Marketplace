<?php

session_start();

if (!isset($_SESSION['usuarioId']) or ($_SESSION['usuarioNiveisAcessoId'] != 0)) {

    // Destrói a sessão por segurança

    session_destroy();

    // Redireciona o visitante de volta pro login

    header("Location: login");

    exit;
}

//Incluindo a conexao

include_once("dao/conexao.php");

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//Selecionar todas as solicitacoes

$sqlSolicita = "SELECT solicitacao.idsolicitacao, usuario.nome_usuario, usuario.foto, usuario.email, usuario.cidade, usuario.estado, solicitacao.status, solicitacao.idsolicitacao, servicos.descricao_servico, servicos.prestador_idprestador FROM solicitacao

INNER JOIN servicos on servicos.idservicos = solicitacao.servicos_idservicos

INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador

INNER JOIN usuario on usuario.idusuario = prestador.usuario_idusuario

WHERE contratante_idcontratante = '" . $_SESSION['idContratante']  . "'";



$solicitacoes = mysqli_query($conexao, $sqlSolicita);

//Contar o total de cursos

$total_solicitacoes = mysqli_num_rows($solicitacoes);

//Seta a quantidade de solicitacoes por pagina

$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os cursos

$num_pagina = ceil($total_solicitacoes / $quantidade_pg);

//Calcular o inicio da visualizacao

$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$result_cursos = "SELECT solicitacao.idsolicitacao, usuario.nome_usuario, usuario.foto, usuario.email, usuario.cidade, usuario.estado, solicitacao.status,solicitacao.idsolicitacao, servicos.descricao_servico, servicos.prestador_idprestador FROM solicitacao

INNER JOIN servicos on servicos.idservicos = solicitacao.servicos_idservicos

INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador

INNER JOIN usuario on usuario.idusuario = prestador.usuario_idusuario

WHERE contratante_idcontratante = '" . $_SESSION['idContratante']  . "' ORDER BY idsolicitacao DESC limit $incio, $quantidade_pg";

$resultado = mysqli_query($conexao, $result_cursos);

$total_solicitacoes = mysqli_num_rows($resultado);

?>



<!DOCTYPE html>

<html lang="pt-BR">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->

    <link rel="stylesheet" href="css/solicitacoesaguardoU.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script src="js/jquery-3.6.0.min.js"></script>

    <script src="js/jquery.maskedinput.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico"/>
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

                            <a class="nav-link" href="solicitacoes">Minhas Solicitações<span class="sr-only">(current)</span></a>

                        </li>

                        <li class="nav-item active">

                            <a class="nav-link" href="profissionais">Nossos Profissionais<span class="sr-only">(current)</span></a>

                        </li>

                    </div>

                </ul>

                <!--SEGUNDA LISTA DE LINKS-->

                <ul class="navbar-nav usuario align-items-center justify-content-center">

                    <li class="nav-item facaLogin d-flex justify-content-center align-items-center">

                        <a class="nav-link" href="profile" data-toggle="tooltip" data-placement="bottom" title="Acesse seu perfil, clicando em seu nome !">

                            <b>Olá,</b> <?php echo $_SESSION["usuarioNome"] ?>

                        </a>

                        <a href="sair">Sair</a>

                    </li>

                </ul>

                <!--FIM DAS LISTAS-->

            </div>

            <!--FIM DA DIV QUE MOSTRA NO BOTAO OCULTO-->

        </nav>

        <!--FIM NAVBAR-->

        <div class="left-text">

            <p>Atenção, após a aprovação o profissional irá entrar em contato com<br>

                você pelo seu e-mail informado no perfil</p>

        </div>

        <div class="tabela">

            <?php

            if ($resultado->num_rows > 0) {

                while ($rows_solicita = $resultado->fetch_assoc()) { ?>

                    <table class="table table-striped">

                        <tbody>

                            <tr>

                                <td class="comptabela">

                                    <div class="container infoAllUser">

                                        <img class="img-responsive" src="<?php echo $rows_solicita['foto']; ?>" alt="Imagem responsiva" srcset="">

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

                                        if ($rows_solicita['status'] == 'Aprovado') {

                                        ?>

                                            <button type="button" class="btn btn-andamento">Em Andamento</button>

                                        <?php

                                        } else if ($rows_solicita['status'] == 'Negado') {

                                        ?>

                                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Você teve seu serviço negado, por tanto poderá cancelar sua solicitação a qualquer momento !">Recusado</button>

                                            <form action="" method="post">

                                                <button type="text" name="excluir" class="btn btn-cancelarsolicitacao" value="<?php echo $rows_solicita['idsolicitacao'] ?>">Cancelar solicitação

                                                    <?php if (isset($_POST['excluir'])) {

                                                        //Pegando o valor do botao

                                                        $valor = (int) $_POST['excluir'];

                                                        $deletar = mysqli_query($conexao, "DELETE FROM solicitacao WHERE idsolicitacao= '$valor' ");

                                                    ?>

                                                        <script>
                                                            window.location = "solicitacoes";
                                                        </script>

                                                    <?php

                                                    } ?>

                                                </button>

                                            </form>

                                        <?php

                                        } else if ($rows_solicita['status'] == 'Finalizado') {

                                        ?>

                                            <button type="button" class="btn btn-finalizado" data-toggle="modal" data-target="#exampleModalCenter <?php echo $rows_solicita['idsolicitacao'] ?>">Finalizado</button>

                                            <div class="modal fade" id="exampleModalCenter <?php echo $rows_solicita['idsolicitacao'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header h5-center">

                                                            <h5 class="h5-center modal-dialog-centered">Avalie seu profissional</h5>



                                                            <a href="#"><span aria-hidden="true" data-dismiss="modal">&times;</span></a>



                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="d-flex justify-content-center align-items-center">

                                                                <img class="img-responsive-avalia" src="<?php echo $rows_solicita['foto']; ?>" alt="Imagem responsiva" srcset="">

                                                            </div>

                                                            <div class="d-flex justify-content-center align-items-center">

                                                                <p class="e-mailUser user-text"><?php echo $rows_solicita['nome_usuario']; ?></p>

                                                            </div>

                                                            <div class="d-flex justify-content-center align-items-center">

                                                                <p class="user-text-cidade"><?php echo $rows_solicita['cidade'];

                                                                                            echo " - ";

                                                                                            echo $rows_solicita['estado']; ?></p>

                                                            </div>

                                                            <div class="d-flex justify-content-center align-items-center">

                                                                <p class="text-infoP text-descricao">

                                                                    <?php echo $rows_solicita['descricao_servico']; ?>

                                                                </p>

                                                            </div>

                                                        </div>

                                                        <?php

                                                        $avaliacao = "SELECT solicitacao_idsolicitacao from avaliacao

                                                        WHERE solicitacao_idsolicitacao = '" . $rows_solicita['idsolicitacao']  . "'";

                                                        $verificaAvalia = mysqli_query($conexao, $avaliacao);

                                                        if ($verificaAvalia->num_rows > 0) {

                                                            echo "<p class='text-danger text-center'> Você ja fez uma avaliação para esse serviço </p>";
                                                        } else { ?>

                                                            <div class="modal-footer flex-column">

                                                                <form action="" method="post" class="d-flex justify-content-center align-items-center w-100 flex-column">

                                                                    <div class="input-group mb-3 flex-column">

                                                                        <label for="nota">Nota de avaliação</label>

                                                                        <input type="text" id="nota" name="nota" class="form-control w-100" placeholder="Digite uma nota de 1 até 5" aria-label="Digite uma nota de 1 até 5" aria-describedby="button-addon2" maxlength="1" required>

                                                                    </div>

                                                                    <button class="btn btn-outline-secondary btn-enviar" name="enviarAvali" type="text" id="button-addon2">Avaliar</button>

                                                                    <?php

                                                                    if (isset($_POST['enviarAvali'])) {

                                                                        $idSolciitacaoAvalia = $rows_solicita['idsolicitacao'];

                                                                        $nota = $_POST['nota'];

                                                                        $idPrestador = $rows_solicita['prestador_idprestador'];

                                                                        $insereAvaliacao = mysqli_query($conexao, "INSERT INTO avaliacao (classificacao, solicitacao_idsolicitacao, prestador_idprestador) VALUES ('$nota', '$idSolciitacaoAvalia', '$idPrestador')");

                                                                        $conexao->close();

                                                                    ?>

                                                                        <script>
                                                                            alert('Avaliação realizada com exito');

                                                                            window.location = "solicitacoes";
                                                                        </script>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </form>

                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                            <?php

                                        } else {

                                            ?>

                                                <form action="" method="post">

                                                    <button type="text" name="excluir" class="btn btn-cancelarsolicitacao" value="<?php echo $rows_solicita['idsolicitacao'] ?>">Cancelar solicitação

                                                        <?php if (isset($_POST['excluir'])) {

                                                            //Pegando o valor do botao

                                                            $valor = (int) $_POST['excluir'];

                                                            $deletar = mysqli_query($conexao, "DELETE FROM solicitacao WHERE idsolicitacao= '$valor' ");

                                                        ?>

                                                            <script>
                                                                window.location = "solicitacoes";
                                                            </script>

                                                        <?php

                                                        } ?>

                                                    </button>

                                                <?php

                                            }



                                                ?>

                                                </form>

                                            </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                <?php }
            } else {

                ?>

                <script>
                    window.location = "semsolicitacoes";
                </script>

            <?php

            } ?>

            <!--PAGINAÇÃO-->

            <div class="container paginacao d-flex justify-content-center align-items-center">

                <?php

                //Verificar a pagina anterior e posterior

                $pagina_anterior = $pagina - 1;

                $pagina_posterior = $pagina + 1;

                ?>

                <nav class="text-center">

                    <ul class="pagination">

                        <li class="page-item d-flex justify-content-center align-items-center">

                            <?php

                            if ($pagina_anterior != 0) { ?>

                                <a class="page-link" href="solicitacoes?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">

                                    <span aria-hidden="true">&laquo;</span>

                                </a>

                            <?php } else { ?>

                                <span aria-hidden="true">&laquo;</span>

                            <?php }  ?>

                        </li>

                        <?php

                        //Apresentar a paginacao

                        for ($i = 1; $i < $num_pagina + 1; $i++) { ?>

                            <li>

                                <a class="page-link" href="solicitacoes?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>

                            </li>

                        <?php } ?>

                        <li class="page-item d-flex justify-content-center align-items-center">

                            <?php

                            if ($pagina_posterior <= $num_pagina) { ?>

                                <a class="page-link" href="solicitacoes?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">

                                    <span aria-hidden="true">&raquo;</span>

                                </a>

                            <?php } else { ?>

                                <span aria-hidden="true">&raquo;</span>

                            <?php }  ?>

                        </li>

                    </ul>

                </nav>

            </div>

        </div>

    </div>



    <!--SCRIPT DE ICONES-->

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <!--SCRIPT DE ICONES-->
    <script src="js/fontawesome.js" crossorigin="anonymous"></script>
    <!--SCRIPT DO BOOTSTRAP-->
    <script src="js/jquery-3.2.1.slim.min.js">
    </script>
    <script src="js/popper.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

</body>



</html>