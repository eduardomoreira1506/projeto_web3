<div class="container">
	<?php if(count($projetos) > 5){ ?>
		<section class="alturaNoticiasDestacadas">
			<div class="destaque">
				<div class="row destaque">
					<div class="col-md-5 destaque">
						<div class="alturaNoticiaMaior" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[0]->getIdProjeto() . '.png' ?>'); background-size: cover;">
							<a href="<?= URL_RAIZ . 'projeto/' . $projetos[0]->getIdProjeto() ?>">
								<div class="noticiaMaior">
									<div class="informacoes">
										<h2><?= $projetos[0]->getTitulo() ?> - <?= $projetos[0]->getDataCriacao() ?>
											<?php if(!$logado){ ?>
												<img src="<?= URL_IMG . 'bandeiras/' . $projetos[0]->getIdPais() . '.png' ?>" alt="">
											<?php } ?>
										</h2>
										<p><?= $projetos[0]->getDescricaoResumida() ?></p>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-7 destaque">
						<div class="primeiraLinha">
							<div class="row destaque">
								<div class="col-md-6 destaque">
									<a href="<?= URL_RAIZ . 'projeto/' . $projetos[1]->getIdProjeto() ?>">
										<div class="noticiaMaior" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[1]->getIdProjeto() . '.png' ?>'); background-size: cover;">
											<div class="informacoes">
												<h2><?= $projetos[1]->getTitulo() ?> - <?= $projetos[1]->getDataCriacao() ?>
												<?php if(!$logado){ ?>
													<img src="<?= URL_IMG . 'bandeiras/' . $projetos[1]->getIdPais() . '.png' ?>" alt="">
												<?php } ?>
												</h2>
												<p><?= $projetos[1]->getDescricaoResumida() ?></p>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6 destaque">
									<a href="<?= URL_RAIZ . 'projeto/' . $projetos[2]->getIdProjeto() ?>">
										<div class="noticiaMaior" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[2]->getIdProjeto() . '.png' ?>'); background-size: cover;">
											<div class="informacoes">
												<h2><?= $projetos[2]->getTitulo() ?> - <?= $projetos[2]->getDataCriacao() ?>
												<?php if(!$logado){ ?>
													<img src="<?= URL_IMG . 'bandeiras/' . $projetos[2]->getIdPais() . '.png' ?>" alt="">
												<?php } ?>
												</h2>
												<p><?= $projetos[2]->getDescricaoResumida() ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="alturaLinhas">
							<div class="row destaque">
								<div class="col-md-6 destaque">
									<a href="<?= URL_RAIZ . 'projeto/' . $projetos[3]->getIdProjeto() ?>">
										<div class="noticiaMaior" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[3]->getIdProjeto() . '.png' ?>'); background-size: cover;">
											<div class="informacoes">
												<h2><?= $projetos[3]->getTitulo() ?> - <?= $projetos[3]->getDataCriacao() ?>
												<?php if(!$logado){ ?>
													<img src="<?= URL_IMG . 'bandeiras/' . $projetos[3]->getIdPais() . '.png' ?>" alt="">
												<?php } ?>
												</h2>
												<p><?= $projetos[3]->getDescricaoResumida() ?></p>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6 destaque">
									<a href="<?= URL_RAIZ . 'projeto/' . $projetos[4]->getIdProjeto() ?>">
										<div class="noticiaMaior" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[4]->getIdProjeto() . '.png' ?>'); background-size: cover;">
											<div class="informacoes">
												<h2><?= $projetos[4]->getTitulo() ?> - <?= $projetos[4]->getDataCriacao() ?>
												<?php if(!$logado){ ?>
													<img src="<?= URL_IMG . 'bandeiras/' . $projetos[4]->getIdPais() . '.png' ?>" alt="">
												<?php } ?>
												</h2>
												<p><?= $projetos[4]->getDescricaoResumida() ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
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
			<input type="text" id="busca" placeholder="Buscar...">
			<ul class="larguraListaNoticias" id="listaProjetos">
				<?php for($i = 5; $i < count($projetos) ; $i++){ ?>
					<a href="<?= URL_RAIZ . 'projeto/' . $projetos[$i]->getIdProjeto() ?>">
						<li class="itemLista">
							<div class="row destaque">
								<div class="col-md-9 destaque">
									<h2><?= $projetos[$i]->getTitulo() ?></h2>
									<h3><?= $projetos[$i]->getTempoFormatado() ?>
										<?php if(!$logado){ ?>
											<img src="<?= URL_IMG . 'bandeiras/' . $projetos[$i]->getIdPais() . '.png' ?>" alt="">
										<?php } ?>
									</h3>
									<p><?= $projetos[$i]->getDescricaoResumida() ?></p>
								</div>
								<div class="col-md-3 destaque">
									<div class="larguraImagem" style="background: url('<?= URL_IMG . 'projetos/' . $projetos[$i]->getIdProjeto() . '.png' ?>'); background-size: cover;">
									</div>
								</div>
							</div>
						</li>
					</a>
				<?php } ?>
			</ul>
		</section>
	<?php }else{ ?>
		<section class="noticiasVariadas marginTopo">
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
				<?php foreach ($projetos as $projeto): ?>
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
				<?php endforeach ?>
			</ul>
		</section>
	<?php } ?>
</div>