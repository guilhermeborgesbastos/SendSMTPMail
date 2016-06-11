# SendSMTP Mail
Exemplo prático de como utilizar o envio de e-mail autenticado via SMTP AUTH, usando uma conta GMAIL.

[![VIDEO](https://meucomercioeletronico.com/tutorial/SendSMTPMail.jpg)](https://meucomercioeletronico.com/tutorial/sendmail)


### Veja funcionando:

[![VIDEO](https://meucomercioeletronico.com/tutorial/exemplo_online.jpg)](https://meucomercioeletronico.com/tutorial/sendmail)


## Instalação e uso
Basta importar o projeto do Git para o seu editor.

## Estrutura e informações úteis ##

#### index.php
No arquivo index.php ( Veja arquivo: https://goo.gl/Ft95ro ), temos o formulário de envio de email:

```
<!DOCTYPE html>
<html>
<head>
	<title>Email Autenticado - SMTP & PHP</title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <form action="sendmail.php" method="post">
        <ul class="form-style-1">
        	<h2>Email Autenticado - SMTP & PHP</h2><br>
            <li><label>Título E-mail <span class="required">*</span></label><input type="text" name="titulo" class="field-long" placeholder="Título" /></li>
            <li><label>Email do Destinatário <span class="required">*</span></label><input type="text" name="destinatario" class="field-long" placeholder="Informe seu e-mail aqui" /></li>
            <li>
                <label>Url da Imagem Anexa</label>
                <input type="text" name="imagem" class="field-long" placeholder="Url da foto a ser encaminhada no email"/>
            </li>
            <li>
                <label>Mensagem do E-mail <span class="required">*</span></label>
                <textarea name="mensagem" id="mensagem" class="field-long field-textarea" placeholder="Escreva a mensagem"></textarea>
            </li>
            <li>		
            	<!-- este é o id do usuário que está cadastrado no banco e dados e receberá a notification no celular -->
                <input type="submit" value="Enviar email" />
            </li>
        </ul>
        <ul class="form-style-1">
        	<div class="info"> Participe, baixe código fonte e teste você tambem:<br> <a href="https://github.com/guilhermeborgesbastos/SendSMTPMail">Baixe agora no Git</a></div>
        </ul>
    </form>

</body>
</html>
```


#### sendmail.php
No arquivo sendmail.php ( Veja arquivo: https://goo.gl/EkVmog ), temos o código que inclui a classe de envio de email autenticado e envia o email para o destinatátio:

```
<!DOCTYPE html>
<html>
<head>
	<title>Enviando E-mail Autenticado...</title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css?nocache.2.2">
</head>
<body>

<?php 

/**
 * How to use SMTP auth mail
 * COmo utilizar o envio de e-mail autentidaco
 *
 * @copyright  2016-06-11 onwards Guilherme Borges Bastos (http://androidnapratica.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
*   This example shows making an SMTP connection with authentication.
*   Este exemplo mostra como se autenticar em um servidor SMTP e disparar um email autenticado pelo mesmo.
*/

/******************************************* EN ******************************************************/
// Receive vars form FORM HTML
/******************************************* PT ******************************************************/
// Recebe as variáveis do formulário HTML
/*****************************************************************************************************/
$titulo = $_POST['titulo'];
$destinatario = $_POST['destinatario'];
$anexo = $_POST['imagem'];
$message = $_POST['mensagem'];

/******************************************* EN ******************************************************/
// It makes some verifications
/******************************************* PT ******************************************************/
// Verifica se as vars foram envias
// Obs: aqui caberia um validador para saber se o @destinatario informado é valido, etc..
// nao utilizo neste exemplo pois o objetivo é ensinar como autenticar email e dispará-los.
/*****************************************************************************************************/
if(empty($titulo)){
	echo "<div class='alert error'>Favor informar o título do e-mail.</div>";
	exit();
} else if(empty($destinatario)){
	echo "<div class='alert error'>Favor informar o destinatário do e-mail.</div>";
	exit();
}else if(empty($message)){
	echo "<div class='alert error'>Favor informar a mensagem do e-mail.</div>";
	exit();
}

/******************************************* EN ******************************************************/
// SMTP needs accurate times, and the PHP timezone MUST be set
// This should be done in your php.ini, but this is how to do it if you don't have access to that
/******************************************* PT ******************************************************/
// O SMTP precisa que o horário ( Timezone ) seja especificado
/*****************************************************************************************************/
date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

/******************************************* EN ******************************************************/
// Create a new PHPMailer instance
/******************************************* PT ******************************************************/
// Cria uma nova instancia da classe PHPMailer
/*****************************************************************************************************/
$mail = new PHPMailer;

/******************************************* EN ******************************************************/
// Tell PHPMailer to use SMTP
/******************************************* PT ******************************************************/
// Diz ao PHP para utilizar SMTP
/*****************************************************************************************************/
$mail->isSMTP();


/******************************************* EN ******************************************************/
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
/******************************************* PT ******************************************************/
// Habilitando SMTP Debug
// 0 = deslidado (usado em modo de produçao)
// 1 = Mensagem de cliente
// 2 = Mensagem do cliente e servidor
//
// Ele é responsável pelos logs que serao exibidos na tela, para desativa-lo coloque 0
/*****************************************************************************************************/
$mail->SMTPDebug = 0;

/******************************************* EN ******************************************************/
// Ask for HTML-friendly debug output
/******************************************* PT ******************************************************/
// Habilita o debug amigável do HTML
/*****************************************************************************************************/
$mail->Debugoutput = 'html';

/******************************************* EN ******************************************************/
// Set the hostname of the mail server
/******************************************* PT ******************************************************/
// Informa o HOST do servidor de email ( em nosso teste estamos usando o do GMAIL), 
// em caso de dúvidas contacte seu host pedinfo informaçoes.
/*****************************************************************************************************/
$mail->Host = "smtp.gmail.com";

/******************************************* EN ******************************************************/
// Set the SMTP port number - likely to be 25, 465 or 587
/******************************************* PT ******************************************************/
// Habilita s porta SMTP - ex: 25, 465 or 587  ( Verifique essa info no seu HOST), 
// em nosso teste GMAIl usaremos a porta 587
/*****************************************************************************************************/
$mail->Port = 587;

/******************************************* EN ******************************************************/
// Whether to use SMTP authentication
/******************************************* PT ******************************************************/
// Habilita a autenticaçao para utilizar o SMTP, também utilizamos o TLS pois o GMAIL exije.
/*****************************************************************************************************/
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";  

/******************************************* EN ******************************************************/
// Username to use for SMTP authentication
/******************************************* PT ******************************************************/
// Usuário para se autenticar no email ( geralmente é o próprio e-mail ), 
// em caso de dúvidas contacte seu host pedinfo informaçoes.
/*****************************************************************************************************/
$mail->Username = "guilhermeborgesbastos@gmail.com";

/******************************************* EN ******************************************************/
// Password to use for SMTP authentication
/******************************************* PT ******************************************************/
// Senha utilizada para logar no e-mail
/*****************************************************************************************************/
$mail->Password = "Aqui.Sua.Senha";

/******************************************* EN ******************************************************/
// Set who the message is to be sent from
/******************************************* PT ******************************************************/
// Informa o remetente do e-mail  ( MUDE AQUI PARA SEU EMAIL )
/*****************************************************************************************************/
$mail->setFrom('seu.email@gmail.com', 'Seu Nome');

/******************************************* EN ******************************************************/
// Set an alternative reply-to address
/******************************************* PT ******************************************************/
// Caso coloque voce pode alterar o reply-to do email para o que informar na linha abaixo
/*****************************************************************************************************/
$mail->addReplyTo('seu.email@gmail.com', 'Replay');

/******************************************* EN ******************************************************/
// Charset of email
/******************************************* PT ******************************************************/
// Utiliza-se UTF-8 pois no nosso português temos acentos, :/
/*****************************************************************************************************/
$mail->CharSet = 'UTF-8';

/******************************************* EN ******************************************************/
// Set who the message is to be sent to
/******************************************* PT ******************************************************/
// Informa quem receberá o email
// Obs: podemos colocar mais de um destinatátio apenas duplicando a linha abaixo
/*****************************************************************************************************/
$mail->addAddress( $destinatario, 'Usuário Testando');
$mail->addAddress('seu.email@gmail.com', 'Seu Nome');

/******************************************* EN ******************************************************/
// Set the subject line
/******************************************* PT ******************************************************/
// Informa o Assunto do e-mail 
/*****************************************************************************************************/
$mail->Subject = $titulo;

/******************************************* EN ******************************************************/
// if you want to include text in the body. 
/******************************************* PT ******************************************************/
// Na var abaixo informamos o que será enviado no corpo do email, também podemos mandar no formato HTML
/*****************************************************************************************************/
$mail->Body = $message;

/******************************************* EN ******************************************************/
// add Attachment if exist
/******************************************* PT ******************************************************/
// Caso exista um anexo ele o adiciona
/*****************************************************************************************************/
if(!empty($anexo)){
	$mail->addStringAttachment(file_get_contents($anexo), 'Anexo');
}

/******************************************* EN ******************************************************/
// send the message, check for errors
/******************************************* PT ******************************************************/
// envia a mensagem de e-mail e verifica por erros
/*****************************************************************************************************/
if (!$mail->send()) {
	echo "<div class='alert error'>Favor tente mais tarde, verifique se preencheu o formulário com dados válidos.</div>";
} else {
   	echo "<div class='alert success'>E-mail enviado com sucesso!</div>";
}
?>

</body>
</html>
```

### Importante
Após baixar o código e subir para seu servidor online, mude as configurações de autenticação do email para as suas. Caso contrário o envio não irá funcionar.

### Conclusão
Com este recurso temos uma maior certeza da entrega, pois o mesmo sendo autenticado oferece garantias de sua procedência .

Espero que tenha ajudado!

Fico a disposição para tirar dúvidas:
guilhermeborgesbastos@gmail.com

## Agradecimentos
https://github.com/PHPMailer/PHPMailer

## Contato
[![VIDEO](https://media.licdn.com/mpr/mpr/shrinknp_100_100/AAEAAQAAAAAAAAgiAAAAJGMwMTQwNTMyLTU2N2EtNDM1NS1iZDMxLTI2ZjVhZDRlNjM2Mw.jpg)](https://www.facebook.com/guilherme.borgesbastos)
