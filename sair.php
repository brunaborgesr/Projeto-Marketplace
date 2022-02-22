<?php

session_start();

unset(

    $_SESSION['usuarioId'],

    $_SESSION['usuarioNome'],

    $_SESSION['usuarioNiveisAcessoId'],

    $_SESSION['usuarioEmail'],

    $_SESSION['enderecoUser'],

    $_SESSION['fotoPerfil']

);



$_SESSION['logindeslogado'] = "Logout relaizado com sucesso";

?>

<script>
    window.location = "login";
</script>

<?php



?>