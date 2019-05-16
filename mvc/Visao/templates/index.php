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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link href="<?= URL_CSS . 'geral.css' ?>" rel="stylesheet">
    <script>
    	let baseUrl = '<?= URL_RAIZ ?>';
    </script>
</head>
<body>
    <header>
       <div class="larguraCabecalho">
          <div class="paiTitulo">
             <a href="<?= URL_RAIZ ?>"><h1>Votações</h1></a>
         </div>
         <div class="paiMenu">
            <?php if($logado){ ?>
                <a href="<?= URL_RAIZ . 'painel' ?>">Painel</a>
                <a href="<?= URL_RAIZ . 'sair' ?>">Sair</a>
            <?php }else{ ?>
                <a href="<?= URL_RAIZ . 'login' ?>">Entrar</a>
            <?php } ?>
        </div>
    </div>
</header>
<?php $this->imprimirConteudo() ?>
<footer>
	<h3>© Copyright 2019 Antonio Eduardo Moreira</h3>
</footer>
<?php foreach ($scripts as $script): ?>
	<script src="<?= URL_JS.$script ?>.js"></script>
<?php endforeach ?>
</body>
</html>
