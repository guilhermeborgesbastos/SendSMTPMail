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
