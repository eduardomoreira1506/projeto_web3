$(document).ready(function(){
	var paginacao = 10;

	$(window).bind('scroll', function() {
		if(($(window).innerHeight() + $(window).scrollTop()) >= $("body").height() - 1){
			$.ajax({
				url: `${baseUrl}projetos`,
				method: 'POST',
				data: {paginacao},
				success: function(respostaJson){
					var resposta = JSON.parse(respostaJson);

					var html = '';

					for(i in resposta){
						var dataBrasileira = resposta[i][3];
						var arrayData = dataBrasileira.split('/')
						var data = new Date(arrayData[2], parseInt(arrayData[1]) - 1, arrayData[0], 0, 0, 0, 0);
						var dataAtual = new Date();

						var diferencaDeDias = Math.abs(dataAtual.getTime() - data.getTime());
						var diferencaDeDias = Math.ceil(diferencaDeDias / (1000 * 3600 * 24));

						html += `
						<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
							<li class="itemLista">
								<div class="row destaque">
									<div class="col-md-9 destaque">
										<h2>${resposta[i].titulo}</h2>
										<h3>${diferencaDeDias} dia(s) atrás</h3>
										<p>${resposta[i].descricao.substring(0,200)}</p>
									</div>
									<div class="col-md-3 destaque">
										<div class="larguraImagem" style="background: url('${baseUrl}publico/img/projetos/${resposta[i].id_projeto}.png'); background-size: cover;">
										</div>
									</div>
								</div>
							</li>
						</a>
						`;
					}

					$('#listaProjetos').append(html);

					paginacao += 10;
				}
			});
		}
	});	

	$('#filtro-projetos').change(function(){
		$.ajax({
			url: `${baseUrl}filtrarProjetos`,
			method: 'POST',
			data: {filtro: this.value},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);
				var html = '';

				for(i in resposta){
					var dataBrasileira = resposta[i][3];
					var arrayData = dataBrasileira.split('/')
					var data = new Date(arrayData[2], parseInt(arrayData[1]) - 1, arrayData[0], 0, 0, 0, 0);
					var dataAtual = new Date();

					var diferencaDeDias = Math.abs(dataAtual.getTime() - data.getTime());
					var diferencaDeDias = Math.ceil(diferencaDeDias / (1000 * 3600 * 24));

					html += `
					<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
					<li class="itemLista">
					<div class="row destaque">
					<div class="col-md-9 destaque">
					<h2>${resposta[i].titulo}</h2>
					<h3>${diferencaDeDias} dia(s) atrás</h3>
					<p>${resposta[i].descricao.substring(0,200)}</p>
					</div>
					<div class="col-md-3 destaque">
					<div class="larguraImagem" style="background: url('${baseUrl}publico/img/projetos/${resposta[i].id_projeto}.png'); background-size: cover;">
					</div>
					</div>
					</div>
					</li>
					</a>
					`;
				}

				$('#listaProjetos').html(html);
			}
		});
	})

	$('#busca').keyup(function(){
		$.ajax({
			url: `${baseUrl}buscarProjetos`,
			method: 'POST',
			data: {palavraChave: this.value},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);
				var html = '';

				for(i in resposta){
					var dataBrasileira = resposta[i][3];
					var arrayData = dataBrasileira.split('/')
					var data = new Date(arrayData[2], parseInt(arrayData[1]) - 1, arrayData[0], 0, 0, 0, 0);
					var dataAtual = new Date();

					var diferencaDeDias = Math.abs(dataAtual.getTime() - data.getTime());
					var diferencaDeDias = Math.ceil(diferencaDeDias / (1000 * 3600 * 24));

					html += `
					<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
					<li class="itemLista">
					<div class="row destaque">
					<div class="col-md-9 destaque">
					<h2>${resposta[i].titulo}</h2>
					<h3>${diferencaDeDias} dia(s) atrás</h3>
					<p>${resposta[i].descricao.substring(0,200)}</p>
					</div>
					<div class="col-md-3 destaque">
					<div class="larguraImagem" style="background: url('${baseUrl}publico/img/projetos/${resposta[i].id_projeto}.png'); background-size: cover;">
					</div>
					</div>
					</div>
					</li>
					</a>
					`;
				}

				$('#listaProjetos').html(html);
			}
		});
	})
})