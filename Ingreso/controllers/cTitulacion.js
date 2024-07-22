$('#nivel').change(function(){
	let parametros = "id="+$('#nivel').val();
	console.log(parametros + 'hola');
	$.ajax({
		data: parametros,
		url: '../controllers/cTitulacion.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			// console.log(response);
			$('#mTitulacion').html(response.municipio);
			$('#displayTitulacion').show();

		},
		error:function(){
			alert('ocurrio un Errorsito!!');
		}
	});
})


$('#enivel').change(function(){
	let parametros = "id="+$('#enivel').val();
	console.log(parametros);
	$.ajax({
		data: parametros,
		url: '../controllers/cTitulacion.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			// console.log(response);
			$('#enTitulacion').html(response.municipio);
			$('#displayTitulacion').show();

		},
		error:function(){
			alert('ocurrio un Errorsito!!');
		}
	});
})
