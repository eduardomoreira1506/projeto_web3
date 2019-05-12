<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin|Modak|Noto+Sans+KR" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="<?= URL_CSS . 'geral.css' ?>" rel="stylesheet">
</head>
<body>
<header>
	<div class="larguraCabecalho">
		<div class="paiTitulo">
			<h1>Votações</h1>
		</div>
		<div class="paiMenu">
			<a href="#">Entrar</a>
			<a href="#">Painel</a>
		</div>
	</div>
</header>
<div class="container">
	<?php $this->imprimirConteudo() ?>
</div>
<section class="login" style="display: none">
	<div class="row tamanhoTotal">
		<div class="col-md-8 tamanhoTotal">
			<div class="textosBoasVindas">
				<h3>Bem</h3>
				<h3>vindo</h3>
				<h4>Você está no sistema de votações dos países.</h4>
			</div>
		</div>
		<div class="col-md-4 tamanhoTotal">
			<div class="formulario">
				<form action="">
					<input type="text" placeholder="email">
					<input type="password" placeholder="senha">
					<button type="submit">Entrar</button>
				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<h3>© Copyright 2019 Antonio Eduardo Moreira</h3>
</footer>
</body>
</html>
