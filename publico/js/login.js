$(document).ready(function(){
	$('#email').blur(function(){
		var email = $('#email').val();

		$.ajax({
			url: `${baseUrl}verificacaoEmail`,
			method: 'POST',
			data: {email: email},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					});
				}
			}
		});
	});

	$('#formulario-login').submit(function(e){
		e.preventDefault();

		var email = $('#email').val();
		var senha = $('#senha').val();

		$.ajax({
			url: `${baseUrl}login`,
			method: 'POST',
			data: {email: email, senha: senha},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(!resposta.status){
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					});
				}else{
					Swal.fire({
						type: 'success',
						title: 'Sucesso!',
						text: resposta.frase
					}).then(() => {
						window.location.href = baseUrl;
					});
				}
			}
		});
	});
});