<?php
include('config.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/bootstrap" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/recuperar.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/mascaras.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <title> EmpresaX | Nova senha</title>
</head>

<body>
    <div class="content">
        <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-danger">
                            Ocorreu um erro em nosso sistema !
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <a href="recuperar">
                            <button type="button" class="btn btn-secondary">Voltar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-success">
                            Senha redefinida com sucesso !
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <a href="login">
                            <button type="button" class="btn btn-secondary">Voltar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="left">
            <img src="images/esqueceuSenha.png" alt="" srcset="">
            <div class="left-text">
                <h2>Oba, encontramos seu e-mail</h2>
                <p>Agora para prosseguir, escolha uma nova senha e guarde bem ela.</p>
            </div>
        </div>
        <div class="rigth">
            <?php
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                if ($token != $_SESSION['token']) {
                    die('O token não corresponde');
                } else {
            ?>
                    <div class="bg_login">
                        <div class="box_esqueci_a_senha">
                            <?php
                            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
                            $sql->execute([$_SESSION['email_aluno']]);
                            $info = $sql->fetch();

                            if ($sql->rowCount() == 1) {
                                if (isset($_POST['redefinirsenha'])) {
                                    $senha = $_POST['senha_aluno'];
                                    $sql = $pdo->prepare("UPDATE usuario SET senha = ? WHERE email = ?");
                                    $sql->execute([$senha, $_SESSION['email_aluno']]);
                            ?>
                                    <script>
                                        $(document).ready(function() {
                                            $('#modal').modal('show');
                                        });
                                    </script>
                                <?php
                                }
                            } else {
                                ?>
                                <script>
                                    $(document).ready(function() {
                                        $('#modalErro').modal('show');
                                    });
                                </script>
                            <?php
                            }
                            ?>
                            <div class="head_login">
                                <h2><i class="fas fa-lock"></i> Redefinir a minha senha</h2>
                            </div>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="senha">Digite a sua nova senha</label>
                                    <input type="password" class="form-control" id="senha_aluno" name="senha_aluno" maxlength="12">
                                </div>

                                <div class="input_group">
                                    <button type="submit" name="redefinirsenha" class="btn btn-entrar" value="Redefinir">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php
            } else {
                echo 'Precisa de um token';
            }
            ?>
        </div>
    </div>
    <!--SCRIPT DO BOOTSTRAP-->
    <script src="js/jquery-3.2.1.slim.min.js">
    </script>
    <script src="js/popper.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
</body>

</html>