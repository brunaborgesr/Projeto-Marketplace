<?php

session_start();

?>



<!DOCTYPE html>

<html lang="pt-BR">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico"/>

    <title>EmpresaX | Login</title>

</head>



<body>

    <div class="content">

        <div class="left">

            <img src="images/foguete.png" alt="" srcset="">

            <div class="left-text">

                <h2>Olá, ótimo ter você em nosso site</h2>

                <p>Realize seu login e encontre os melhores profissionais.</p>

            </div>

        </div>

        <div class="rigth d-flex flex-column">

            <form action="dao/valida.php" method="post">

                <!--PHP ERROR DE LOGIN-->

                <p class="text-center text-danger">

                    <?php

                    if (isset($_SESSION['loginErro'])) {

                        echo $_SESSION['loginErro'];

                        unset($_SESSION['loginErro']);

                    } ?>

                </p>

                <div class="form-group">

                    <label for="exampleInputEmail1">E-mail</label>

                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu e-mail">

                </div>

                <div class="form-group">

                    <label for="exampleInputPassword1">Senha</label>

                    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Digite sua senha">

                </div>

                <div class="form-group">

                    <a href="esquecisenha">Esqueceu sua senha?</a>

                </div>

                <div class="form-group botoes">

                    <button type="submit" class="btn btn-entrar">Entrar</button>

                    <p>Não possui uma conta?</p>

                </div>

            </form>

            <div class="form-group">

                <button type="text" class="btn btn-criarconta" onclick="window.location.href='cadastro'">Criar minha conta</button>

            </div>



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