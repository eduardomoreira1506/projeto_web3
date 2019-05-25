$(document).ready(function(){

	$('#verificacao-pais').click(function(e){
		e.preventDefault();

		var nomePais = $('#nome-pais').val();
		var sigla = $('#sigla').val();
		var imagem = $('#bandeira-imagem').val();

		if(nomePais == undefined || nomePais == "" || nomePais == null){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Nome do país é obrigatório!'
			});
		}else{
			if(sigla == undefined || sigla == "" || sigla == null ){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Sigla é obrigatório!'
				});
			}else{
				$.ajax({
					url: `${baseUrl}verificacaoNovoPais`,
					method: 'POST',
					data: {nomePais: nomePais, sigla: sigla},
					success: function(respostaJson){
						var resposta = JSON.parse(respostaJson);
						if(resposta.status){
							Swal.fire({
								type: 'success',
								title: 'Sucesso',
								text: resposta.frase
							}).then(() => {
								document.getElementById("nome-pais").readOnly = true;
								document.getElementById("sigla").readOnly = true;

								$('#verificacao-pais').remove();

								var html = `
									<input type="file" id="bandeira-imagem" name="bandeira-imagem">
									<input type="text" placeholder="nome" id="nome" name="nome">
									<input type="email" placeholder="email" id="email" name="email">
									<input type="password" placeholder="senha" id="senha" name="senha">
									<input type="password" placeholder="confirmação senha" id="confirmacao_senha" name="confirmacao_senha">
									<button type="submit">Criar</button>
								`;

								$('#segunda-parte-formulario').html(html);
							});
						}else{
							Swal.fire({
								type: 'error',
								title: resposta.type,
								text: resposta.frase
							});
						}
					}
				})
			}
		}
	});

	$('#formulario-novo-pais').submit(function(e){
		if($('#verificacao-pais').html() == undefined){
			var nomePais = $('#nome-pais').val();
			var sigla = $('#sigla').val();
			var imagem = $('#bandeira-imagem').val();
			var nome = $('#nome').val();
			var email = $('#email').val();
			var senha = $('#senha').val();

			e.preventDefault();
			var formulario = document.getElementById('formulario-novo-pais');
			var formData = new FormData(formulario);

			$.ajax({
				url: `${baseUrl}novoPais`,
				type: 'POST',
				data: formData,
				dataType: 'json',
				processData: false,  
				contentType: false,
				success: function(retorno){
					Swal.fire({
						type: retorno.type,
						title: 'Oops...',
						text: retorno.frase
					});
				}
			});
			
		}
	});
})