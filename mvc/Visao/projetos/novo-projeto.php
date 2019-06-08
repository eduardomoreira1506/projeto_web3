<div class="container">
	<section class="novo-projeto">
		<div class="texto">
			<h2>Novo projeto</h2>
		</div>
		<div class="formulario">
			<form id="formulario-novo-projeto" enctype="multipart/form-data" method="post" action="<?= URL_RAIZ . 'novoProjeto' ?>">
				<input type="text" placeholder="titulo do projeto" id="titulo" name="titulo">
				<input type="file" id="imagem" name="imagem">
				<textarea id="descricao" name="descricao" id="descricao"></textarea>
				<button type="submit">Criar</button>
			</form>
		</div>
	</section>
</div>