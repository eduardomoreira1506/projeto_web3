<div class="container">
	<section class="paises">
		<div class="titulo">
			<h2>Qual país você deseja ver as notícias?</h2>
		</div>
		<div class="areaPaises">
			<ul>
				<div class="row">
					<?php foreach ($paises as $pais): ?>
						<div class="col-md-4">
							<div class="pais">
								<a href="<?= URL_RAIZ . 'pais/' . $pais->getIdPais() ?>">
									<li style="background: url(<?= URL_IMG. 'bandeiras/' .$pais->getIdPais() ?>.png); background-size: cover;"></li>
									<h3><?= $pais->getNome(); ?> - <?= $pais->getSigla(); ?></h3>
								</a>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</ul>
		</div>
		<a href="<?= URL_RAIZ . 'novoPais' ?>" class="link-novo-pais">Cadastrar novo país</a>
		<a href="<?= URL_RAIZ . 'projetos' ?>" class="link-novo-pais">Ver de todos países</a>
	</section>
</div>