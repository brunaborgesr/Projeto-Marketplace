<?php
if (isset($_POST['name']))
    $name = $_POST['name'];
if (isset($_POST['email']))
    $email = $_POST['email'];
if (isset($_POST['message']))
    $message = $_POST['message'];
if (isset($_POST['subject']))
    $subject = $_POST['subject'];

$content = "De: $name \nEmail: $email \nAssunto: $subject\nMensagem: $message";
$recipient = "mecanicomarketplace@gmail.com";
$mailheader = "De: $email \r\n";
$headers =  'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: $name <mecanicomarketplace@gmail.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($recipient, $subject, $content, $mailheader) or die("Error!");
?>
<script>
    alert("E-mail enviado com sucesso !");
            window.location = "index";
</script>
<?php

?>