<div class="container">
	<section class="novo-deputado">
		<div class="texto">
			<h2>Novo deputado</h2>
		</div>
		<div class="formulario" method="post" action="<?= URL_RAIZ . 'deputado' ?>">
			<form id="formulario-novo-deputado">
				<input type="text" placeholder="nome" name="nome" id="nome">
				<input type="email" placeholder="email" name="email" id="email">
				<input type="password" placeholder="senha" id="senha" name="senha">
				<button type="submit">Criar</button>
			</form>
		</div>
	</section>
</div>