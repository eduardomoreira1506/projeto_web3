<div class="container">
	<section class="novo-projeto">
		<div class="texto">
			<h2>Novo projeto</h2>
		</div>
		<div class="formulario">
			<form action="<?= URL_RAIZ . 'novoProjeto' ?>" method="post" enctype="multipart/form-data">
				<input type="text" placeholder="titulo do projeto" id="titulo" name="titulo">
				<input type="file" name="imagem">
				<textarea id="descricao" name="descricao"></textarea>
				<button type="submit">Criar</button>
			</form>
		</div>
	</section>
</div>