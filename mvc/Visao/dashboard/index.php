<div class="container">
	<section class="menu">
		<div class="frase">
			<h2>Olá, <?= $nomePessoa ?></h2>
			<h3><?= $dataAtual ?></h3>
		</div>
		<div class="opcoes row">
			<?php if(!$tipo){ ?>
				<a href="novoDeputado">
					<div>
						<i class="fas fa-signal"></i>
						<h4>Criar novo Deputado</h4>
					</div>
				</a>
			<?php } ?>
			<a href="novoProjeto">
				<div>
					<i class="fas fa-signal"></i>
					<h4>Criar novo Projeto</h4>
				</div>
			</a>
		</div>
	</section>
</div>