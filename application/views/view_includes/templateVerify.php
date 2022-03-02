<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Verificación de usuario - Mylatindate.com</title>

	<style type="text/css">
		*{
			font-size: 16px !important;
		}
	</style>
</head>
<body>

	<p>Hola,</p>
	<p>El usuario <strong><?= $id_user." - ".$name_user ?></strong> ha enviado una solicitud para verificar su cuenta.</p>
	<p>Revisa su tarjeta de identificación y acepta o rechaza su verificación.</p><br>
	<p>Presiona <a href="<?= base_url('home/verify_account/accept/'.$id_user.'/'.$id_verify) ?>">clic aquí</a> para verificar la cuenta.</p>
	<p>Presiona <a href="<?= base_url('home/verify_account/decline/'.$id_user.'/'.$id_verify) ?>">clic aquí</a> para rechazar la verificación y pedir que envie un nuevo documento.</p>
	<br><br><p>Saludos, Team Mylatindate.com:</p>
	<img style="width: 10px" src="<?= base_url('img/src/logo_black.png') ?>" alt="Logo Mylatindate.com">
	
</body>
</html>