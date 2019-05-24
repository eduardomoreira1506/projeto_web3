$(document).ready(function(){

	$('#formulario-comentario').submit(function(e){
		e.preventDefault();
		var comentario = $('#comentario').val();

		$.ajax({
			url: `${baseUrl}comentario`,
			method: 'POST',
			data: {comentario: comentario, idProjeto: idProjeto},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					});
				}else{
					var html = `
					<li>
						<div class="topoComentariolista">
							<h2>${resposta.nome} | ${dataAtual()}</h2>
							<p>${comentario}</p>
						</div>
					</li>`;

					var quantidadeDeComentariosAtuais = $('#numeroQuantidadeComentarios').html()
					quantidadeDeComentariosAtuais = parseInt(quantidadeDeComentariosAtuais);
					quantidadeDeComentariosAtuais++;
					$('#numeroQuantidadeComentarios').html(quantidadeDeComentariosAtuais)

					$('#lista-de-comentarios').prepend(html);
					$('#comentario').val('');
				}
			}
		});
	});

	$('#aprovar-projeto').click(function(){
		$.ajax({
			url: `${baseUrl}alterarStatusProjeto`,
			method: 'POST',
			data: {status: 1, idProjeto: idProjeto},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					})
				}else{
					Swal.fire({
						type: 'success',
						title: resposta.titulo,
						text: resposta.frase
					}).then(() => {
						window.location.href = baseUrl;
					});
				}
			}
		});
	})

	$('#reprovar-projeto').click(function(){
		$.ajax({
			url: `${baseUrl}alterarStatusProjeto`,
			method: 'POST',
			data: {status: 4, idProjeto: idProjeto},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					})
				}else{
					Swal.fire({
						type: 'success',
						title: resposta.titulo,
						text: resposta.frase
					}).then(() => {
						window.location.href = baseUrl;
					});
				}
			}
		});
	});

	$('#deferir').click(function(){
		$.ajax({
			url: `${baseUrl}votar`,
			method: 'POST',
			data: {voto: 1, idProjeto: idProjeto},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					})
				}else{
					Swal.fire({
						type: 'success',
						title: resposta.titulo,
						text: resposta.frase
					});

					var quantidadeVotosAtuais = $('#quantidade-votos-deferidos').html();
					quantidadeVotosAtuais = parseInt(quantidadeVotosAtuais);
					quantidadeVotosAtuais++;
					$('#quantidade-votos-deferidos').html(quantidadeVotosAtuais);
				}
			}
		});
	});

	$('#indeferir').click(function(){
		$.ajax({
			url: `${baseUrl}votar`,
			method: 'POST',
			data: {voto: 0, idProjeto: idProjeto},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					})
				}else{
					Swal.fire({
						type: 'success',
						title: resposta.titulo,
						text: resposta.frase
					});

					var quantidadeVotosAtuais = $('#quantidade-votos-indeferidos').html();
					quantidadeVotosAtuais = parseInt(quantidadeVotosAtuais);
					quantidadeVotosAtuais++;
					$('#quantidade-votos-indeferidos').html(quantidadeVotosAtuais);
				}
			}
		});
	});

});

function dataAtual(){
	var data = new Date()
	var dia = data.getDate();
	var mes = data.getMonth();
	var ano = data.getFullYear();
	data = dia + '/' + (mes++) + '/' + ano;

	return data;
}