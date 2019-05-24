$(document).ready(function(){
	var paginacao = 10;
	var url = window.location.href;
	url = url.toString();

	$(window).bind('scroll', function() {
		if(($(window).innerHeight() + $(window).scrollTop()) >= $("body").height() - 1){
			$.ajax({
				url: `${baseUrl}projetos`,
				method: 'POST',
				data: {paginacao, url},
				success: function(respostaJson){
					var resposta = JSON.parse(respostaJson);

					var html = '';

					for(i in resposta){
						var diferencaEmMinutos = resposta[i].diferenca_em_minutos;

						if(diferencaEmMinutos < 60){
							var diferenca = `${diferencaEmMinutos} minuto(s) atrás`;
						}else if(diferencaEmMinutos < 1440){
							var diferencaEmHoras = Math.round(diferencaEmMinutos / 60);
							var diferenca = `${diferencaEmHoras} hora(s) atrás`;
						}else{
							var diferencaEmDias = Math.round(diferencaEmMinutos / 1440);
							var diferenca = `${diferencaEmDias} dia(s) atrás`;
						}

						html += `
						<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
							<li class="itemLista">
								<div class="row destaque">
									<div class="col-md-9 destaque">
										<h2>${resposta[i].titulo}</h2>
										<h3>${diferenca}</h3>
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
			data: {filtro: this.value, url},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);
				var html = '';

				for(i in resposta){
					var diferencaEmMinutos = resposta[i].diferenca_em_minutos;

					if(diferencaEmMinutos < 60){
						var diferenca = `${diferencaEmMinutos} minuto(s) atrás`;
					}else if(diferencaEmMinutos < 1440){
						var diferencaEmHoras = Math.round(diferencaEmMinutos / 60);
						var diferenca = `${diferencaEmHoras} hora(s) atrás`;
					}else{
						var diferencaEmDias = Math.round(diferencaEmMinutos / 1440);
						var diferenca = `${diferencaEmDias} dia(s) atrás`;
					}

					html += `
					<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
					<li class="itemLista">
					<div class="row destaque">
					<div class="col-md-9 destaque">
					<h2>${resposta[i].titulo}</h2>
					<h3>${diferenca}</h3>
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
			data: {palavraChave: this.value, url},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);
				var html = '';

				for(i in resposta){
					var diferencaEmMinutos = resposta[i].diferenca_em_minutos;

					if(diferencaEmMinutos < 60){
						var diferenca = `${diferencaEmMinutos} minuto(s) atrás`;
					}else if(diferencaEmMinutos < 1440){
						var diferencaEmHoras = Math.round(diferencaEmMinutos / 60);
						var diferenca = `${diferencaEmHoras} hora(s) atrás`;
					}else{
						var diferencaEmDias = Math.round(diferencaEmMinutos / 1440);
						var diferenca = `${diferencaEmDias} dia(s) atrás`;
					}

					html += `
					<a href="${baseUrl}projeto/${resposta[i].id_projeto}">
					<li class="itemLista">
					<div class="row destaque">
					<div class="col-md-9 destaque">
					<h2>${resposta[i].titulo}</h2>
					<h3>${diferenca}</h3>
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