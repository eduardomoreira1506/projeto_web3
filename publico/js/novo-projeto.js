$(document).ready(function(){

	$('#titulo').blur(function(){
		var titulo = $('#titulo').val();
		if(titulo == undefined || titulo == null || titulo == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops..',
				text: 'Título do projeto é obrigatório'
			});
		}
	});

	$('#descricao').blur(function(){
		var descricao = $('#descricao').val();
		if(descricao == undefined || descricao == null || descricao == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops..',
				text: 'Descrição do projeto é obrigatório'
			});
		}
	});

	$('#formulario-novo-projeto').submit(function(e){
		e.preventDefault();

		var formulario = document.getElementById('formulario-novo-projeto');
		var formData = new FormData(formulario);

		$.ajax({
			url: `${baseUrl}novoProjeto`,
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
	})

});