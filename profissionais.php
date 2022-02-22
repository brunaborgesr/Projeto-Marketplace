<?php



session_start();

if (!isset($_SESSION['usuarioId']) or ($_SESSION['usuarioNiveisAcessoId'] != 0)) {

    // Destrói a sessão por segurança

    session_destroy();

    // Redireciona o visitante de volta pro login

    header("Location: login");

    exit;

}

//conexão

include_once("dao/conexao.php");

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;



//Selecionar todos os cursos da tabela



$sqlBuscar = "SELECT usuario.nome_usuario, usuario.foto, usuario.cidade, usuario.estado, servicos.descricao_servico, servicos.prestador_idprestador FROM servicos 

INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador

INNER JOIN usuario on usuario.idusuario = prestador.usuario_idusuario";





$resultado_curso = mysqli_query($conexao, $sqlBuscar);



//Contar o total de cursos

$total_cursos = mysqli_num_rows($resultado_curso);



//Seta a quantidade de cursos por pagina

$quantidade_pg = 6;



//calcular o número de pagina necessárias para apresentar os cursos

$num_pagina = ceil($total_cursos / $quantidade_pg);



//Calcular o inicio da visualizacao

$incio = ($quantidade_pg * $pagina) - $quantidade_pg; //Selecionar os cursos a serem apresentado na página

$result_cursos = "SELECT usuario.nome_usuario, usuario.foto, usuario.cidade, usuario.estado, servicos.descricao_servico, servicos.prestador_idprestador, servicos.idservicos FROM servicos 

INNER JOIN prestador on prestador.idprestador = servicos.prestador_idprestador

INNER JOIN usuario on usuario.idusuario = prestador.usuario_idusuario limit $incio, $quantidade_pg";

$resultado_cursos = mysqli_query($conexao, $result_cursos);

$total_cursos = mysqli_num_rows($resultado_cursos);



?>



<!DOCTYPE html>

<html lang="pt-BR">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->

    <link rel="stylesheet" href="css/buscaP.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico"/>

    <title>EmpresaX | Nossos profissionais</title>

</head>



<body class="d-flex flex-column">

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

                    <a class="nav-link" href="profile">

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

    <!--CONTAINER PRINCIPAL-->

    <div class="container-fluid busca">

        <h2>Encontre seu profissional</h2>

        <h6>Contrate um profissional sem sair de sua casa</h6>

        <div class="input-group">

            <form action="pesquisar" method="POST" class="d-flex justify-content-center align-items-center flex-row w-100">

                <input type="text" name="pesquisar" class="form-control" placeholder="Procure pelo nome, cidade, estado ou descrição">



                <span class="input-group-btn">

                    <button class="btn btn-procura" type="submit">Procurar</button>

                </span>

            </form>

        </div>

    </div>

    <div class="container-fluid profissionais">

        <div class="row d-flex justify-content-center align-items-center">

            <?php while ($rows_cursos = mysqli_fetch_assoc($resultado_cursos)) {

                $idservico = $rows_cursos['idservicos'];

                $result_servico = "SELECT * FROM solicitacao WHERE contratante_idcontratante = '" . $_SESSION['idContratante'] . "' AND servicos_idservicos = '$idservico' and status = 'Finalizado'";

                $consulta_servico = mysqli_query($conexao, $result_servico);





                $sqlVerificaNota = "SELECT * FROM solicitacao WHERE contratante_idcontratante = '" . $_SESSION['idContratante'] . "' AND servicos_idservicos = '$idservico'";

                $buscaVerifinOTA = mysqli_query($conexao, $sqlVerificaNota);



                if (mysqli_num_rows($consulta_servico) || !mysqli_num_rows($buscaVerifinOTA)) { ?>

                    <div class="card-group d-flex justify-content-center align-items-center col-sm-4 col-md-4">

                        <div class="card ">

                            <img src="<?php echo $rows_cursos['foto']; ?>" class="card-img-top" alt="...">

                            <div class="card-body col-sm-1 col-md-12">

                                <h5 class="card-title text-center"><?php echo $rows_cursos['nome_usuario']; ?></h5>

                                <h6 class="card-subtitle text-center"><?php echo $rows_cursos['cidade'];

                                                                        echo " - ";

                                                                        echo $rows_cursos['estado']; ?></h6>
								
                                <p class="card-text"><?php echo $rows_cursos['descricao_servico']; ?></p>

                                <p class="text-center avaliacoes">Avaliações</p>

                                <div class="stars d-flex justify-content-center align-items-center">

                                    <?php

                                    $idPrestad = $rows_cursos['prestador_idprestador'];

                                    $result_avalicao = "SELECT AVG(classificacao) AS max_classificacao FROM avaliacao WHERE prestador_idprestador = '$idPrestad' ";

                                    $resultado_avaliaFinal = mysqli_query($conexao, $result_avalicao);

                                    $rows_avaliacao = mysqli_fetch_array($resultado_avaliaFinal);

                                    $avaliacao = $rows_avaliacao['max_classificacao'];



                                    if (!$avaliacao) {

                                    ?>

                                        <small class="text-danger" style="text-align: center">Esse prestador não teve nem uma nota de serviço atribuida ainda</small>

                                    <?php

                                    } else if ($avaliacao >= 0 && $avaliacao <= 0.9) {

                                    ?>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                    <?php  } else if ($avaliacao >= 1 && $avaliacao <= 1.9) {

                                    ?>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                    <?php  } else if ($avaliacao >= 2 && $avaliacao <= 2.9) {

                                    ?>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                    <?php  } else if ($avaliacao >= 3 && $avaliacao <= 4.9) {

                                    ?>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                    <?php  } else if ($avaliacao >= 5) {

                                    ?>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        <i class="fa fa-star" aria-hidden="true"></i>

                                    <?php  }



                                    ?>

                                </div>

                                <form action="" method="POST">

                                    <button type="text" value="<?php echo $rows_cursos['idservicos']; ?>" name="contratar" class="btn">

                                        Quero contratar

                                        <?php if (isset($_POST['contratar'])) {

                                            $valor = (int)$_POST['contratar'];

                                            $contrante = $_SESSION['idContratante'];

                                            $date = date('Y-m-d');

                                            date_default_timezone_set('America/Sao_Paulo');



                                            $horaLocal = date('H:m:s', time());

                                            $contratar = "INSERT INTO solicitacao (status, data_solicitacao, hora_solicitacao, contratante_idcontratante, servicos_idservicos)

                                        VALUES ('Em Andamento', ' $date', '$horaLocal', '$contrante', '$valor')";



                                            $final_contrata = mysqli_query($conexao, $contratar);

                                            $conexao->close();

                                        ?>

                                            <script>

                                                window.location = "solicitacoes";

                                            </script>



                                        <?php

                                        } ?>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

            <?php

                }

            } ?>



        </div>



    </div>

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

                        <a class="page-link" href="profissionais?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">

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

                        <a class="page-link" href="profissionais?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>

                    </li>

                <?php } ?>

                <li class="page-item d-flex justify-content-center align-items-center">

                    <?php

                    if ($pagina_posterior <= $num_pagina) { ?>

                        <a class="page-link" href="profissionais?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">

                            <span aria-hidden="true">&raquo;</span>

                        </a>

                    <?php } else { ?>

                        <span aria-hidden="true">&raquo;</span>

                    <?php }  ?>

                </li>

            </ul>

        </nav>

    </div>

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