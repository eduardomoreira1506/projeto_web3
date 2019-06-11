<div class="container">
	<?php $logado = $this->estaLogado(); ?>
	<section class="noticiasVariadas">
		<select class="form-control" id="filtro-projetos">
			<option value="">Todos</option>
			<option value="0">Aguardando aprovação do presidente</option>
			<option value="1">Em votação</option>
			<option value="2">Aprovado</option>
			<option value="3">Reprovado</option>
			<option value="4">Não aceito pelo presidente</option>
			<option value="5">Empatado</option>
		</select>
		<input type="text" id="busca" placeholder="Buscar..." class="form-control marginTopoInput">
		<ul class="larguraListaNoticias" id="listaProjetos">
			<?php foreach($projetos as $projeto){ ?>
				<a href="<?= URL_RAIZ . 'projeto/' . $projeto->getIdProjeto() ?>">
					<li class="itemLista">
						<div class="row destaque">
							<div class="col-md-9 destaque">
								<h2><?= $projeto->getTitulo() ?></h2>
								<h3><?= $projeto->getTempoFormatado() ?>
								<?php if(!$logado){ ?>
									<img src="<?= URL_IMG . 'bandeiras/' . $projeto->getIdPais() . '.png' ?>" alt="">
								<?php } ?>
							</h3>
							<p><?= $projeto->getDescricaoResumida() ?></p>
						</div>
						<div class="col-md-3 destaque">
							<div class="larguraImagem" style="background: url('<?= URL_IMG . 'projetos/' . $projeto->getIdProjeto() . '.png' ?>'); background-size: cover;">
							</div>
						</div>
					</div>
				</li>
			</a>
		<?php } ?>
	</ul>
</section>
</div>