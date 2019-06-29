$(document).ready(function(){

	$('#email').blur(function(){
		var email = $('#email').val();

		$.ajax({
			url: `${baseUrl}verificacaoEmailNaoExiste`,
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
	})

	$('#formulario-novo-deputado').submit(function(e){
		e.preventDefault();

		var nome = $('#nome').val();
		var email = $('#email').val();
		var senha = $('#senha').val();

		$.ajax({
			url: `${baseUrl}deputado`,
			method: 'POST',
			data: {nome: nome, email: email, senha: senha},
			success: function(respostaJson){
				var resposta = JSON.parse(respostaJson);

				if(resposta.status){
					Swal.fire({
						type: 'success',
						title: 'Sucesso',
						text: resposta.frase
					}).then(() => {
						window.location.href = baseUrl;
					});
				}else{
					Swal.fire({
						type: 'error',
						title: 'Oops..',
						text: resposta.frase
					});
				}
			}
		});
	})

});