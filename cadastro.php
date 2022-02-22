<?php

include_once("dao/conexao.php");
include('valida-cpf.php');

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

  <link rel="stylesheet" href="css/cadastro.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <script src="js/jquery-3.6.0.min.js"></script>

  <script src="js/jquery.maskedinput.js"></script>

  <script src="js/mascaras.js"></script>

  <link rel="shortcut icon" href="images/favicon.ico"/>

  <title>EmpresaX | Cadastro</title>

</head>



<body class="d-flex flex-column">

  <div class="container-fluid registrar d-flex">



    <div class="container-fluid formPhoto visible d-flex justify-content-center align-items-center flex-column">

      <div class="container d-flex justify-content-center align-items-center flex-column">

        <img src="images/homemeFoguete.png" alt="" srcset="">

        <div class="left-text">

          <h2>Que bom que você está aqui</h2>

          <p>Realize seu cadastro e encontre os melhores profissionais.</p>

        </div>

      </div>

    </div>



    <div class="formRegister d-flex justify-content-center align-items-center container">

      <form action="#" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center flex-column">

        <div class="form-group d-flex">

          <div class="group">

            <label for="nome">Nome</label>

            <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Digite seu nome completo" required>

          </div>

          <div class="group">

            <label for="cpf">CPF</label>

            <input type="text" class="form-control" name="cpf" id="cpf" aria-describedby="cpf" placeholder="Ex: 121.324.987-65" required>

          </div>

        </div>

        <div class="form-group d-flex">

          <div class="group">

            <label for="email">E-mail</label>

            <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Digite seu e-mail" required>

          </div>

          <div class="group">

            <label for="senha">Senha</label>

            <input type="password" class="form-control" id="senha" name="senha" aria-describedby="senha" placeholder="Digite a sua senha" maxlength="12" required>

          </div>

        </div>

        <div class="form-group d-flex">

          <div class="group">

            <label for="estado">Estado</label>

            <select class="form-control" name="estado" id="estado">

            </select>

          </div>

          <div class="group">

            <label for="cidade">Cidade</label>

            <select class="form-control" name="cidade" id="cidade">

            </select>

          </div>

        </div>

        <div class="form-group d-flex">

          <div class="group">

            <label for="endereco">Endereço</label>

            <input type="text" class="form-control" id="endereco" name="endereco" aria-describedby="endereco" placeholder="Ex: Av. Fulano de Tal, 212" required>

          </div>

          <div class="group">

            <label for="telefone">Telefone Fixo</label>

            <input type="text" class="form-control" id="telefone" name="telefone" aria-describedby="telefone" placeholder="Ex: (34) 3421-0987">

          </div>

        </div>

        <div class="form-group d-flex">

          <div class="group">

            <label for="celular">Celular</label>

            <input type="text" class="form-control" id="celular" name="celular" aria-describedby="celular" placeholder="Ex: (34) 99991-8762" required>

          </div>

          <div class="group">

            <label for="nascimento">Data de Nascimento</label>

            <input type="date" class="form-control" id="nascimento" name="dataNascimento" aria-describedby="nascimento" placeholder="Ex: 10/01/1971" required>

          </div>

        </div>

        <div class="form-group d-flex justify-content-center align-items-end">

          <div class="group">

            <label for="exampleFormControlSelect1">Tipo de Usuário</label>

            <select class="form-control" name="tipoUsuario" id="exampleFormControlSelect1">

              <option name="Contratante">Contratante</option>

              <option name="Prestador">Prestador</option>

            </select>

          </div>

          <div class="group">

            <label for="photo">Envie sua foto</label>

            <input type="file" class="form-control" name="file" id="photo" accept="image/*" required />

          </div>

        </div>

        <div class="form-group">

          <div class="group">

            <button type="submit" class="btn" id="enviarCadastro">Cadastrar</button>

          </div>

        </div>

        <div class="form-group">

          <a href="login">Já possui uma conta?</a>

        </div>

      </form>

    </div>



    <?php



    if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {

      $nome = $_POST['nome'];

      $nivel_acesso = $_POST['tipoUsuario'];

      $email = $_POST['email'];

      $senha = $_POST['senha'];

      $estado = $_POST['estado'];

      $cidade = $_POST['cidade'];

      $endereco = $_POST['endereco'];

      $tel_fixo = $_POST['telefone'];

      $celular = $_POST['celular'];

      $data_nasc = $_POST['dataNascimento'];

      $cpf = $_POST['cpf'];

      $data = implode("-", array_reverse(explode("/", $data_nasc)));

      /* INSERINDO OS DADOS*/



      if ($nivel_acesso == 'Contratante') {

        $nivel_acesso = 0;
      } else {

        $nivel_acesso = 1;
      }



      $search_email = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email' LIMIT 1");

      $search_cpf = mysqli_query($conexao, "SELECT * FROM usuario where cpf = '$cpf' LIMIT 1");




      if (valida_cpf($cpf) == false) {
    ?>
        <div class="modal fade" id="modalError2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
              </div>
              <div class="modal-body">
                <p class="alert alert-danger">
                  CPF Invalido !
                </p>
              </div>
              <div class="modal-footer">
                <a href="cadastro.php">
                  <button type="button" class="btn btn-secondary">Voltar</button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            $('#modalError2').modal('show');
          });
        </script>

      <?php
      } else if (mysqli_num_rows($search_email) > 0 || mysqli_num_rows($search_cpf) > 0) {

      ?>

        <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>

              </div>

              <div class="modal-body">

                <p class="alert alert-danger">

                  Email ou CPF já registrados. Tente novamente!

                </p>

              </div>

              <div class="modal-footer">

                <a href="cadastro">

                  <button type="button" class="btn btn-secondary">Voltar</button>

                </a>

              </div>

            </div>

          </div>

        </div>

        <script>
          $(document).ready(function() {

            $('#modalError').modal('show');

          });
        </script>



        <?php

      } else {

        if (isset($_FILES["file"])) {

          $formatos = array("png", "jpeg", "jpg", "pdf", "PNG", "JPEG", "JPG");

          $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

          $arquivo = $_FILES['file']['name'];

          //diretorio dos arquivos

          $pasta_dir = "profilesPhoto/";

          // Faz o upload da imagem

          $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'gerald35_marketplaceMecanico' AND TABLE_NAME = 'usuario' ";

          $executa = mysqli_query($conexao, $sql);

          $resultado = $executa->fetch_assoc();

          $proximoID = implode("|", $resultado);

          $arquivo_nome = $pasta_dir . "fotoPerfil-idUser-" . $proximoID . '.' . $extensao;

          //salva no banco

          move_uploaded_file($_FILES["file"]['tmp_name'], $arquivo_nome);
        }

        $query = "INSERT INTO usuario (nivel_acesso, email, senha, nome_usuario, data_nascimento, 

                  foto, endereco, cidade, estado, telefone_fixo, celular, cpf) VALUES ('$nivel_acesso',

                  '$email', '$senha', '$nome', '$data', '$arquivo_nome', '$endereco', '$cidade', '$estado', 

                  '$tel_fixo', '$celular', '$cpf')";



        $resultado_usuario_acesso = mysqli_query($conexao, $query);



        $id_inserido = mysqli_query($conexao, "SELECT * FROM usuario WHERE cpf = '$cpf'");

        $result_id = mysqli_fetch_assoc($id_inserido);



        $id = $result_id['idusuario'];



        if ($nivel_acesso == 0) {

          $insert_tipousuario = "INSERT INTO contratante (usuario_idusuario) VALUES ('$id')";

          $result_insert = mysqli_query($conexao, $insert_tipousuario);
        } else {

          $insert_tipousuario = "INSERT INTO prestador (usuario_idusuario) VALUES ('$id')";

          $result_insert = mysqli_query($conexao, $insert_tipousuario);
        }



        if (mysqli_affected_rows($conexao) > 0) {

        ?>

          <!-- MODAL DE SUCESSO -->

          <div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalCenterTitle">Atenção</h5>

                </div>

                <div class="modal-body">

                  <div class="alert alert-success" role="alert">

                    <?php echo $nome; ?> sua conta foi criada com sucesso !</div>

                </div>

                <div class="modal-footer">

                  <a href="login" class="btn">

                    <button type="button" class="btn btn-secondary">Fazer seu login</button>

                  </a>

                </div>

              </div>

            </div>

          </div>

          <script>
            $(document).ready(function() {

              $('#modalSucess').modal('show');

            });
          </script>

        <?php

        } else {

        ?>

          <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>

                </div>

                <div class="modal-body">

                  <p class="alert alert-danger">

                    Ocorreu um erro não foi possivel realizer seu cadastro, tente novamente!

                  </p>

                </div>

                <div class="modal-footer">

                  <a href="cadastro">

                    <button type="button" class="btn btn-secondary">Voltar</button>

                  </a>

                </div>

              </div>

            </div>

          </div>

          <script>
            $(document).ready(function() {

              $('#modalError').modal('show');

            });
          </script>

    <?php

        }
      }
    }

    ?>

  </div>

  <script src="js/main.js"></script>
  <!--SCRIPT DO BOOTSTRAP-->
  <script src="js/jquery-3.2.1.slim.min.js">
  </script>
  <script src="js/popper.min.js">
  </script>
  <script src="js/bootstrap.min.js">
  </script>

</body>


</html>