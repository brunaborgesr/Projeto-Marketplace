<!DOCTYPE html>
<html lang="pt-br">

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
    <title>EmpresaX | Esqueci minha senha</title>
</head>

<body>
    <div class="content">
        <div class="left">
            <img src="images/esqueceuSenha.png" alt="" srcset="">
            <div class="left-text">
                <h2>Não lembra mais sua senha?</h2>
                <p>Sem problemas, informe seu e-mail e enviaremos um link para redefinir sua senha.</p>
            </div>
        </div>
        <div class="rigth">
            <form method="post" action="recuperar">
                <div class="form-group">
                    <label for="email_aluno">E-mail</label>
                    <input type="email" class="form-control" name="email_aluno" id="email_aluno" aria-describedby="emailHelp" placeholder="Digite seu e-mail" required>
                </div>
                <div class="input_form_login">
                    <button type="submit" class="btn btn-entrar" id="esqueciasenha" name="esqueciasenha" value="Redefinir">Redefinir minha senha</button>
                </div>
            </form>
        </div>

    </div>
    <script src="js/main.js"></script>
    <script src="js/query-3.2.1.slim.min.js">
    </script>
    <script src="js/popper.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
</body>

</html>