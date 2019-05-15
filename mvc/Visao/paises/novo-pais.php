<div class="container">
	<section class="novo-pais">
		<div class="texto">
			<h2>Novo país</h2>
		</div>
		<div class="formulario">
			<form action="<?= URL_RAIZ . 'novoPais' ?>" id="formulario-novo-pais" method="post" enctype="multipart/form-data">
				<input type="text" placeholder="nome do país" id="nome-pais" name="nome-pais">
				<input type="text" placeholder="sigla" pattern="[A-Z][A-Z]" id="sigla" name="sigla">
				<button type="click" id="verificacao-pais">Verificar país</button>
				<div id="segunda-parte-formulario">
				</div>
			</form>
		</div>
	</section>
</div>