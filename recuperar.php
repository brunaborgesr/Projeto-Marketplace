<?php
include('config.php');
include('Email.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/bootstrap" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/recuperar.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/mascaras.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <title>EmpresaX | Esqueci minha senha</title>
</head>

<body>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success">
                        As instruções para redefinição da sua senha foram enviadas com sucesso ao seu e-mail !
                    </p>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center">
                  <div class="form-group d-flex justify-content-center align-items-center">
                      <button type="button" class="btn btn-secondary" onclick="window.location.href='login'">Voltar</button>                    
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                </div>
                <div class="modal-body">
                    <p class="alert alert-danger">
                        Não encontra-se esse e-mail em nosso sistema !
                    </p>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center">
                  <div class="form-group d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='login'">Voltar</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['esqueciasenha'])) {
        $token = uniqid();
        $_SESSION['email_aluno'] = $_POST['email_aluno'];
        $_SESSION['token'] = $token;

        $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $sql->execute([$_SESSION['email_aluno']]);

        if ($sql->rowCount() == 1) {
            $info = $sql->fetch();

            $mail = new Email('smtp.gmail.com', 'test@gmail.com', 'senha', 'Marketplace Mecanico');
            $mail->enviarPara($_POST['email_aluno'], $info['nome_usuario']);

            $url = 'https://site.com.br/';
            $corpo = 'Olá ' . $info['nome_usuario'] . ', <br>
    Foi solicitada uma redefinição da sua senha no "Marketplace Mecanica", acesse o link abaixo para redefinir sua senha.<br>
    <h3><a href="' . $url . '?token=' . $_SESSION['token'] . '">Redefinir a sua senha</a></h3>
    <br>
    Caso você não tenha solicitado essa redefinição, ignore esta mensagem.<br>
    Qualquer problema ou dúvida entre em contato pelo email mecanicomarketplace@gmail.com';

            $informacoes = ['Assunto' => 'Redefinição de senha', 'Corpo' => $corpo];

            $mail->formatarEmail($informacoes);

            if ($mail->enviarEmail()) {
                $data['sucesso'] = true;
            } else {
                $data['erro'] = true;
            }
    ?>
            <script>
                $(document).ready(function() {
                    $('#modal').modal('show');
                });
            </script>
        <?php
        } else {
        ?>
            <script>
                $(document).ready(function() {
                    $('#modalErro').modal('show');
                });
            </script>
    <?php
        }
    } ?>


    <script src=" https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>