<div class="container">
	<section class="menu">
		<div class="frase">
			<h2>Olá, <?= $nomePessoa ?></h2>
			<h3><?= $dataAtual ?></h3>
		</div>
		<div class="opcoes row">
			<?php if(!$tipo){ ?>
				<a href="deputado">
					<div>
						<i class="fas fa-plus-square"></i>
						<h4>Criar novo Deputado</h4>
					</div>
				</a>
			<?php } ?>
			<a href="projeto">
				<div>
					<i class="fas fa-project-diagram"></i>
					<h4>Criar novo Projeto</h4>
				</div>
			</a>
		</div>
	</section>
</div>