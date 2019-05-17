<div class="container">
	<section class="noticia">
		<div class="titulo">
			<h2><?= $projeto->getTitulo(); ?></h2>
			<h3><?= $projeto->getDataCriacao(); ?></h3>
		</div>
		<div class="imagemDestaque">
			<figure>
				<img src="<?= URL_IMG . 'projetos/' . $projeto->getIdProjeto() . '.png' ?>" alt="">
			</figure>
		</div>
		<div class="informacoesProjeto">
			<figure>
				<img src="<?= URL_IMG.'bandeiras/' . $projeto->getIdPais() . '.png' ?>" alt="">
			</figure>
			<ul>
				<li><?= $projeto->getPais()->getNome() ?></li>
				<li><?= $projeto->getPais()->getPresidente()->getNome() ?></li>
				<?php if($tipo){ ?>
					<li><?= $projeto->getStatus() ?></li>
				<?php }elseif($projeto->getStatusNumero() == 0){ ?>
					<li>Aguardando sua aprovação</li>
				<?php }else{ ?>
					<li><?= $projeto->getStatus() ?></li>
				<?php } ?>
			</ul>
		</div>
		<div class="descricaoProjeto">
			<p><?= $projeto->getDescricao() ?></p>
		</div>
		<?php if($logado){ 
			if($tipo){ 
				if($projeto->getStatusNumero() != 0 && $projeto->getStatusNumero() != 4 && $projeto->getStatusNumero() != 5){ ?>
					<div class="votos">
						<div class="row">
							<div class="col-md-6">
								<div class="larguraVotos">
									<h3><span id="quantidade-votos-deferidos"><?= $projeto->getVotosAprovados(); ?></span> votos deferidos</h3>
									<button id="deferir"><i class="fas fa-thumbs-up"></i><h2>Deferir</h2></button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="larguraVotos">
									<h3><span id="quantidade-votos-indeferidos"><?= $projeto->getVotosReprovados(); ?></span> votos indeferidos</h3>
									<button id="indeferir"><i class="fas fa-thumbs-down"></i><h2>Indeferir</h2></button>
								</div>
							</div>
						</div>
					</div>
				<?php } 
			} else{ ?>
				<?php if($projeto->getStatusNumero() == 0){ ?>
					<div class="votos">
						<div class="row">
							<div class="col-md-6">
								<div class="larguraVotos">
									<button id="aprovar-projeto"><i class="fas fa-thumbs-up"></i><h2>Aprovar projeto</h2></button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="larguraVotos">
									<button id="reprovar-projeto"><i class="fas fa-thumbs-down"></i><h2>Reprovar projeto</h2></button>
								</div>
							</div>
						</div>
					</div>
				<?php } elseif($projeto->getStatusNumero() != 4){ ?>
					<?php if($projeto->getStatusNumero() == 1){ ?>
						<h2>Em votação:</h2>
					<?php }elseif($projeto->getStatusNumero() == 2){ ?>
						<h2>Aprovado:</h2>
					<?php }elseif($projeto->getStatusNumero() == 3){ ?>
						<h2>Reprovado:</h2>
					<?php }elseif($projeto->getStatusNumero() == 5){ ?>
						<h2>Empate:</h2>
					<?php } ?>
					<div class="votos">
						<div class="row">
							<div class="col-md-6">
								<div class="larguraVotos">
									<h3><?= $projeto->getVotosAprovados(); ?> votos deferidos</h3>
									<i class="fas fa-thumbs-up"></i>
								</div>
							</div>
							<div class="col-md-6">
								<div class="larguraVotos">
									<h3><?= $projeto->getVotosReprovados(); ?> votos indeferidos</h3>
									<i class="fas fa-thumbs-down"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		<?php }else{ ?>
			<?php if($projeto->getStatusNumero() != 0 && $projeto->getStatusNumero() != 4 && $projeto->getStatusNumero() != 5){ ?>
				<?php if($projeto->getStatusNumero() == 1){ ?>
					<h2>Em votação:</h2>
				<?php }elseif($projeto->getStatusNumero() == 2){ ?>
					<h2>Aprovado:</h2>
				<?php }elseif($projeto->getStatusNumero() == 3){ ?>
					<h2>Reprovado:</h2>
				<?php } ?>
				<div class="votos">
					<div class="row">
						<div class="col-md-6">
							<div class="larguraVotos">
								<h3><?= $projeto->getVotosAprovados(); ?> votos deferidos</h3>
								<i class="fas fa-thumbs-up"></i>
							</div>
						</div>
						<div class="col-md-6">
							<div class="larguraVotos">
								<h3><?= $projeto->getVotosReprovados(); ?> votos indeferidos</h3>
								<i class="fas fa-thumbs-down"></i>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<div class="comentarios">
			<div class="comentar">
				<div class="topoComentario">
					<h2 class="quantidadeComentarios"><?= $projeto->getQuantidadeComentarios(); ?> comentário (s)</h2>
					<div class="parteDireita">
						<?php if(!$logado){ ?>
							<a href="<?= URL_RAIZ . 'login' ?>">Entrar</a>
						<?php }else{ ?>
							<h2 class="nomeUsuarioLogado"><?= $nome ?></h2>
						<?php } ?>

					</div>
				</div>
				<div class="formularioComentario">
					<form id="formulario-comentario">
						<textarea name="" id="comentario" cols="30" rows="10" ></textarea>
						<div class="botaoFormulario">
							<button>Comentar</button>
						</div>
					</form>
				</div>
			</div>
			<div class="comentariosLista">
				<ul id="lista-de-comentarios">
					<?php foreach ($comentarios as $comentario): ?>
						<li>
							<div class="topoComentariolista">
								<h2><?= $comentario->getPessoa()->getNome(); ?> | <?= $comentario->getDataComentario(); ?></h2>
								<p><?= $comentario->getComentario(); ?></p>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</section>
</div>
<script>
	idProjeto = '<?= $projeto->getIdProjeto(); ?>';
</script>