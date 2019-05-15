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
				<li><?= $projeto->getStatus() ?></li>
			</ul>
		</div>
		<div class="descricaoProjeto">
			<p><?= $projeto->getDescricao() ?></p>
		</div>
		<div class="votos">
			<div class="row">
				<div class="col-md-6">
					<div class="larguraVotos">
						<h3>10 votos deferidos</h3>
						<button><i class="fas fa-thumbs-up"></i><h2>Deferir</h2></button>
					</div>
				</div>
				<div class="col-md-6">
					<div class="larguraVotos">
						<h3>10 votos indeferidos</h3>
						<i class="fas fa-thumbs-down"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="comentarios">
			<div class="comentar">
				<div class="topoComentario">
					<h2 class="quantidadeComentarios">5 comentário (s)</h2>
					<div class="parteDireita">
						<a href="#">Entrar</a>
						<h2 class="nomeUsuarioLogado">Nome pessoa aqui</h2>
					</div>
				</div>
				<div class="formularioComentario">
					<form action="#">
						<textarea name="" id="" cols="30" rows="10"></textarea>
						<div class="botaoFormulario">
							<button>Comentar</button>
						</div>
					</form>
				</div>
			</div>
			<div class="comentariosLista">
				<ul>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
					<li>
						<div class="topoComentariolista">
							<h2>Nome pessoa aqui | 10/05/2019 16:57</h2>
							<p>Gostei bastante porém acho que deveria ser mum ofabn onsaofn aobgoan orbo anovbdo baovbadonva obv oabo ebof gbao</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
</div>