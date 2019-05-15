<div class="container">
	<section class="alturaNoticiasDestacadas">
		<div class="destaque">
			<div class="row destaque">
				<div class="col-md-5 destaque">
					<div class="alturaNoticiaMaior">
						<a href="#">
							<div class="noticiaMaior">
								<div class="informacoes">
									<h2>Título notícia - 06/05/2019 <img src="<?= URL_IMG.'brasil.jpg' ?>" alt=""></h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies mauris vel justo lobortis, viverra facilisis magna pharetra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut non tempor nibh.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-7 destaque">
					<div class="primeiraLinha">
						<div class="row destaque">
							<div class="col-md-6 destaque">
								<a href="#">
									<div class="noticiaMaior">
										<div class="informacoes">
											<h2>Título notícia - 06/05/2019 <img src="<?= URL_IMG.'brasil.jpg' ?>" alt=""></h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies mauris vel justo lobortis, viverra facilisis magna pharetra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut non tempor nibh.</p>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-6 destaque">
								<a href="#">
									<div class="noticiaMaior">
										<div class="informacoes">
											<h2>Título notícia - 06/05/2019 <img src="<?= URL_IMG.'brasil.jpg' ?>" alt=""></h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies mauris vel justo lobortis, viverra facilisis magna pharetra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut non tempor nibh.</p>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="alturaLinhas">
						<div class="row destaque">
							<div class="col-md-6 destaque">
								<a href="#">
									<div class="noticiaMaior">
										<div class="informacoes">
											<h2>Título notícia - 06/05/2019 <img src="<?= URL_IMG.'brasil.jpg' ?>" alt=""></h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies mauris vel justo lobortis, viverra facilisis magna pharetra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut non tempor nibh.</p>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-6 destaque">
								<a href="#">
									<div class="noticiaMaior">
										<div class="informacoes">
											<h2>Título notícia - 06/05/2019 <img src="<?= URL_IMG.'brasil.jpg' ?>" alt=""></h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies mauris vel justo lobortis, viverra facilisis magna pharetra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut non tempor nibh.</p>
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
		<ul class="larguraListaNoticias">
			<?php foreach ($projetos as $projeto): ?>
				<a href="<?= URL_RAIZ . 'projeto/' . $projeto->getIdProjeto() ?>">
					<li class="itemLista">
						<div class="row destaque">
							<div class="col-md-9 destaque">
								<h2><?= $projeto->getTitulo() ?></h2>
								<h3><?= $projeto->getTempoFormatado() ?></h3>
								<p><?= $projeto->getDescricao() ?></p>
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
</div>