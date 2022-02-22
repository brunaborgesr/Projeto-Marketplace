<?php
include_once("dao/conexao.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="charset" content="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/mascaras.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <title>EmpresaX | Bem Vindo</title>
</head>

<body class="d-flex flex-column">
    <div class="container-fluid">
        <nav class="d-flex navbar navbar-expand-lg align-items-center justify-content-between sticky-top">
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
                            <a class="nav-link" href="#hero">INICIO<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#sobre">QUEM SOMOS<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#contato">CONTATO<span class="sr-only">(current)</span></a>
                        </li>
                    </div>
                </ul>
                <!--SEGUNDA LISTA DE LINKS-->
                <ul class="navbar-nav usuario align-items-center justify-content-center">
                    <li class="nav-item facaLogin d-flex justify-content-center align-items-center">
                        <a class="btn btn-roxo text-white" target="_blank" href="login">Entrar</a>
                    </li>
                </ul>
                <!--FIM DAS LISTAS-->
            </div>
            <!--FIM DA DIV QUE MOSTRA NO BOTAO OCULTO-->
        </nav>

        <section id="hero" class="hero">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12">
                        <span class="heroBrand text-white" title="Home">EmpresaX</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <h1>
                        Sejam bem vindos !
                    </h1>

                    <p class="tagline">
                        Está a procura de profissionais ou deseja anunciar seu serviço relacionado com a mecânica?
                    </p>
                    <a class="btnHero" href="#sobre">Conheça mais</a>
                </div>
            </div>

        </section>

        <section id="sobre" class="container-fluid d-flex justify-content-center align-items-center">
            <div class="container ">
                <h2 class="text-center" style="margin-bottom: 35px;">Qual a sua <strong>duvida?</strong></h2>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    O que é o Marketplace Mecanica?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                O Marketplace Mecanica é uma plataforma que permite prestadores oferecerem seus serviços de um modo fácil, rápido e aos contratantes uma maneira fácil de encontrar e comparar o profissional que atenda às suas necessidades.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Como Funciona?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Faça seu cadastro. Selecione um dos nossos prestadores contendo a descrição do serviço que realizam e aguarde o seu contato pelo email informado em seu cadastro em nossa plataforma.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Quais serviços estão presentes no site?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                Atualmente temos diversos serviços que você pode estar procurando: Pneus, Vidraçaria, Troca de Óleo, entre outros.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Contact v.2-->
        <section id="contato" class="container mb-4 d-flex justify-content-center flex-column">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center mt-5">Entre em contato</h2>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Você tem alguma duvida, sugestão? Nossa equipe entrará em contato com você em questão de
                horas para ajudá-lo.</p>

            <div class="row d-flex justify-content-center align-items-center">
                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="enviaEmail.php" method="POST">
                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <!--Grid column-->
                        </div>
                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Assunto</label>
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form">
                                    <label for="message">Sua mensagem</label>
                                    <textarea type="text" id="message" name="message" rows="6" class="form-control md-textarea" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="btnEmail btn btn-roxo text-white" type="submit" value="Enviar">
                        </div>
                        <!--Grid row-->
                    </form>
                </div>
            </div>
        </section>
        <footer class="footer container-fluid">
            <div class="containerFooter text-white d-flex justify-content-center align-items-center h-100 flex-column" style="background: #26272B;">
                <div class="parte1Row row w-100">
                    <div class="col-md-6">
                        <h4>Sobre</h4>
                        <p>O Marketplace Mecanica foi desenvolvimento durante um trabalho proposto pela matéria de Engenharia Web, onde foram aplicados conceitos de diferentes linguagens de programação para o desenvolvimento do projeto, incluindo: HTML, CSS, Bootstrap, JavaScript, PHP, PHPMailer, MySQL entre oturos.</p>
                    </div>
                    <div class="col-sm-2 col-md-6 d-flex flex-row">
                        <div class="col-sm-2 col-md-6">
                            <h4 class="text-white">Categorias</h4>
                            <p class="text-white" style="color: gray;">
                                PHP<br>
                                HTML<br>
                                CSS<br>
                                BOOTSTRAP<br>
                            </p>
                        </div>
                        <div class="linksFooter col-sm-2 col-md-6">
                            <h4 class="text-white">Links de acesso</h4>
                            <a class="text-white" href="#hero">Inicio</a>
                            <a class="text-white" href="#sobre">Sobre</a>
                            <a class="text-white" href="#contato">Contato</a>
                            <a class="text-white" href="login">Login</a>
                        </div>
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col-sm-6 col-md-12">
                        <p style="color: gray;">Copyright © 2021 Todos Direitos Reservados por Bruna Borges, Caio Rodrigues, Danielle Oliveira, Kaynnan Bardauil, Luiz Henrique, Reginaldo Alves, Rodrigo Neves </p>
                    </div>
                </div>
            </div>
        </footer>
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