<?php
session_start();
include_once("../dao/conexao.php");
if (!isset($_SESSION['usuarioId']) or ($_SESSION['usuarioNiveisAcessoId'] != 1)) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../login");
    exit;
}
$sqlPrestador = "SELECT  * FROM `prestador` WHERE usuario_idusuario = '" . $_SESSION['usuarioId'] . "' LIMIT 1";
$resultado_prestador = mysqli_query($conexao, $sqlPrestador);
$resultadoFinalPrestador = mysqli_fetch_assoc($resultado_prestador);
$_SESSION['idPrestador'] = $resultadoFinalPrestador['idprestador'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <script>
        function altera() {
            var inputs = document.getElementsByClassName('form-control');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
                $('#salva').removeClass('disabled');
                $('#salva').removeClass('d-none');
                $('#alterar').addClass('d-none');
            }
        }

        function salva() {
            var inputs = document.getElementsByClassName('form-control');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = true;
                $('#salva').addClass('disabled');
                $('#salva').addClass('d-none');
                $('#alterar').removeClass('d-none');
            }
        }
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="../css/telaperfilP.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.maskedinput.js"></script>
    <script src="../js/mascaras.js"></script>
    <link rel="shortcut icon" href="../images/favicon.ico"/>
    <title>EmpresaX | Meu Perfil</title>
</head>

<body class="d-flex flex-column">
    <!--CONTAINER PRINCIPAL-->
    <div class="container-fluid">
        <!--NAVBAR-->
        <nav class="d-flex navbar navbar-expand-lg align-items-center justify-content-between sticky-top ">
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
                        <a class="nav-link" href="profile">
                            <b>Olá,</b> <?php echo $_SESSION['usuarioNome']; ?>
                        </a>
                        <a href="../sair.php">Sair</a>
                    </li>
                </ul>
                <!--FIM DAS LISTAS-->
            </div>
            <!--FIM DA DIV QUE MOSTRA NO BOTAO OCULTO-->
        </nav>
        <!--FIM NAVBAR-->
        <?php
        $sql = "SELECT * FROM usuario WHERE idusuario = '" . $_SESSION['usuarioId'] . "'";
        $result = mysqli_query($conexao, $sql);
        while ($row = $result->fetch_assoc()) { ?>
            <div class="container-fluid principal">
                <!--INICIO ESQUERDA-->
                <div class="container esquerda">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="../<?php echo $row['foto']; ?>" alt="">
                            <p><?php echo $_SESSION['usuarioNome']; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="photo">Envie sua foto</label>
                            <input type="file" class="form-control" name="file" id="photo" accept="image/*" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="alterarFoto" class="btn roxo text-white">Alterar foto do perfil
                                <?php if (isset($_POST['alterarFoto'])) {

                                    if (isset($_FILES["file"])) {
                                        $formatos = array("png", "jpeg", "jpg", "pdf", "PNG", "JPEG", "JPG");
                                        $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                                        $arquivo = $_FILES['file']['name'];
                                        //diretorio dos arquivos
                                        $pasta_dir = "../profilesPhoto/";
                                        // Faz o upload da imagem
                                        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'gerald35_marketplaceMecanico' AND TABLE_NAME = 'usuario' ";
                                        $executa = mysqli_query($conexao, $sql);
                                        $resultado = $executa->fetch_assoc();
                                        $proximoID = implode("|", $resultado);
                                        $arquivo_nome = "profilesPhoto/" . "fotoPerfil-idUser-" . $_SESSION['usuarioId'] . '.' . $extensao;
                                        $arquivo_nome2 = "../profilesPhoto/" . "fotoPerfil-idUser-" . $_SESSION['usuarioId'] . '.' . $extensao;
                                        //salva no banco
                                        move_uploaded_file($_FILES["file"]['tmp_name'], $arquivo_nome2);
                                    }
                                    $atualizaFoto = mysqli_query($conexao, "UPDATE usuario SET foto = '$arquivo_nome' where idusuario = '" . $_SESSION['usuarioId'] . "'");
                                ?>
                                    <script>
                                        alert('Foto atualizada com sucesso');
                                        window.location = "profile";
                                    </script>
                                <?php
                                } ?>

                            </button>
                        </div>
                    </form>
                    <form action="" method="POST">
                        <button type="text" class="text-secondary removeFoto" href="" name="excluirFoto"><small>Remover foto</small>
                            <?php if (isset($_POST['excluirFoto'])) {
                                //Pegando o valor do botao
                                $valor = "";
                                $deletar = mysqli_query($conexao, "UPDATE usuario SET foto = '$valor' where idusuario = '" . $_SESSION['usuarioId'] . "'");
                            ?>
                                <script>
                                    window.location = "profile";
                                </script>
                            <?php
                            } ?>
                        </button>
                    </form>
                </div>
                <!--FIM DIV ESQUERDA -->
                <!--INICIO DIREITA -->

                <div class="container-fluid direita">
                    <div class="container title">
                        <h5 class="text-secondary">Edite suas informações</h5>
                    </div>
                    <div class="container-fluid conteudo">
                        <form action="" method="POST">
                            <div class="form-group ">
                                <div class="input-group">
                                    <label for="nome">Nome</label>
                                    <input name="nome" type="text" class="form-control" id="nome" value="<?php echo $row['nome_usuario'] ?>" disabled required>
                                </div>
                                <div class="input-group">
                                    <label for="email">E-mail</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" disabled required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="cidade">Cidade</label>
                                    <input name="cidade" type="text" class="form-control" id="cidade" value="<?php echo $row['cidade']; ?>" disabled required>
                                </div>
                                <div class="input-group">
                                    <label for="estado">Estado</label>
                                    <input name="estado" type="text" class="form-control" id="estado" value="<?php echo $row['estado']; ?>" disabled required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="cidade">Telefone</label>
                                    <input name="telefone" type="text" class="form-control" id="telefone" value="<?php echo $row['telefone_fixo']; ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label for="estado">Celular</label>
                                    <input name="celular" type="text" class="form-control" id="celular" value="<?php echo $row['celular']; ?>" disabled required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha" aria-describedby="senha" value="<?php echo $row['senha']; ?>" maxlength="12" disabled required>
                                </div>
                                <div class="input-group">
                                    <label for="nascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="nascimento" name="dataNascimento" aria-describedby="nascimento" value="<?php echo $row['data_nascimento']; ?>" disabled required>
                                </div>
                            </div>

                            <div class="form-group btn">
                                <div class="botoes">
                                    <a class="text-danger btn altera" id="alterar" onclick="altera();">Alterar minhas informações</a>
                                    <form action="" method="POST">
                                        <button type="text" class="text-secondary btn disabled d-none salvar" id="salva" name="alteraOsDados" onclick="salva();">
                                            Salvar informações
                                            <?php if (isset($_POST['alteraOsDados'])) {

                                                //Pegando o valor do botao

                                                $nome = $_POST['nome'];
          
          										$email = $_POST['email'];

                                                $cidade = $_POST['cidade'];

                                                $estado = $_POST['estado'];

                                                $senha = $_POST['senha'];

                                                $data = $_POST['dataNascimento'];

                                                $telefone = $_POST['telefone'];

                                                $celular = $_POST['celular'];

                                                $alterar = mysqli_query($conexao, "UPDATE usuario

                                                SET email = '$email',
                                                
                                                nome_usuario = '$nome',

                                                cidade = '$cidade',

                                                estado = '$estado',                                                

                                                telefone_fixo = '$telefone',  

                                                celular = '$celular',

                                                senha = '$senha',

                                                data_nascimento = '$data'                                                 

                                                where idusuario = '" . $_SESSION['usuarioId'] . "'");
          										
          										if ($alterar) { 
                                                  ?>
                                                <script>
                                                    alert("Perfil atualizado com sucesso");
                                                    window.location = "profile";
                                                </script>
                                                <?php
                                                } else { ?>
                                                <script>
                                                  	alert("Esse email encontra-se em uso, por favor tente com outro e-mail");
                                                    window.location = "profile";
                                                </script>
                                               <?php
                                                }
                                            } ?>
                                        </button>
                                    </form>
                                    <?php
                                    $verificaServico = " SELECT * FROM servicos WHERE prestador_idprestador = '" . $_SESSION['idPrestador'] . "'";
                                    $resultadoVerifica = mysqli_query($conexao, $verificaServico);
                                    $numResultado = $resultadoVerifica->num_rows;
                                    if ($numResultado > 0) { ?>
                                        <?php

                                        // Pegando ID
                                        $resultadoID = mysqli_fetch_assoc($resultadoVerifica);
                                        $idServico = $resultadoID['idservicos'];
                                        $descricaoServico = $resultadoID['descricao_servico'];
                                        $verificaSolicitaca = "SELECT * FROM solicitacao WHERE servicos_idservicos = '$idServico'";
                                        $resultadoSolicita = mysqli_query($conexao, $verificaSolicitaca);
                                        $numSolicita = $resultadoSolicita->num_rows;
                                        if ($numSolicita > 0) { ?>
                                            <a href="" class="text-secondary btn" data-toggle="modal" data-target="#modalAltera">Alterar serviço</a>
                                        <?php }
                                        ?>
                                        <form action="" method="POST">
                                            <button type="text" name="removeServico" class="btn roxo text-white">
                                                Remover Serviço Existente
                                                <?php if (isset($_POST['removeServico'])) {
                                                    //Pegando o valor do botao
                                                    $descricao = $_POST['descricao'];
                                                    $removeServicos = mysqli_query($conexao, "DELETE FROM servicos WHERE prestador_idprestador = '" . $_SESSION['idPrestador'] . "'");
                                                    if (mysqli_affected_rows($conexao) > 0) {
                                                ?>
                                                        <script>
                                                            alert("Serviço excluido com sucesso !");
                                                            window.location = "profile";
                                                        </script>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <script>
                                                            alert("Você possui solicitacoes enviadas para seu serviço, logo não será possivel excluir o seu serviço, mas podera editar a informação do mesmo !");
                                                            window.location = "profile";
                                                        </script>
                                                <?php
                                                    }
                                                    $conexao->close();
                                                } ?>
                                            </button>
                                        </form>
                                        <!--SE ELE NAO ENCONTROU NADA ENTAO PERMITA O CADASTRO DE SERVIÇO-->
                                    <?php } else { ?>
                                        <a href="" class="text-secondary btn" data-toggle="modal" data-target="#exampleModalCenter">Adicionar serviços</a>
                                    <?php }
                                    ?>


                                </div>
                        </form>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <form action="" method="POST">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center align-items-center">
                                        <h5 class="modal-title" id="title" class="text-center">Adicionando um serviço</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group d-flex justify-content-center align-items-center flex-column">
                                            <label for="descricao">Coloque aqui a descrição do serviço</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="6" maxlength="255" style="resize: none" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addServico" class="btn btn-primary">
                                            Cadatrar serviço
                                            <?php if (isset($_POST['addServico'])) {
                                                //Pegando o valor do botao
                                                $descricao = $_POST['descricao'];
                                                $inserir = mysqli_query($conexao, "INSERT INTO servicos (descricao_servico , prestador_idprestador) VALUES ('$descricao','" . $_SESSION['idPrestador'] . "')");
                                                $conexao->close();
                                            ?>
                                                <script>
                                                    alert("Serviço cadastrado com sucesso !");
                                                    window.location = "profile";
                                                </script>
                                            <?php
                                            } ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Fim Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="modalAltera" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <form action="" method="POST">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center align-items-center">
                                        <h5 class="modal-title" id="title" class="text-center">Alterando seu serviço</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group d-flex justify-content-center align-items-center flex-column">
                                            <label for="descricao">Descrição</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="6" maxlength="255" style="resize: none" required><?php echo $descricaoServico ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="alteraServico" class="btn btn-danger">
                                            Salvar alterações
                                            <?php if (isset($_POST['alteraServico'])) {
                                                //Pegando o valor do botao
                                                $descricao = $_POST['descricao'];
                                                $inserir = mysqli_query($conexao, "UPDATE servicos SET descricao_servico = '$descricao' WHERE prestador_idprestador = '" . $_SESSION['idPrestador'] . "'");
                                                $conexao->close();
                                            ?>
                                                <script>
                                                    alert("Serviço alterado com sucesso !");
                                                    window.location = "profile";
                                                </script>
                                            <?php
                                            } ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Fim Modal -->
                </div>
            <?php } ?>
            <!--FIM DIV DIREITA -->
            </div>
    </div>
    <!--SCRIPT DE ICONES-->
    <script src="../js/fontawesome.js"></script>
    <!--SCRIPT DO BOOTSTRAP-->
    <script src=" ../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>