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

});