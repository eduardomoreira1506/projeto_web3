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

					$('#lista-de-comentarios').prepend(html);
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
	})

});

function dataAtual(){
	var data = new Date()
	var dia = data.getDate();
	var mes = data.getMonth();
	var ano = data.getFullYear();
	data = dia + '/' + (mes++) + '/' + ano;

	return data;
}