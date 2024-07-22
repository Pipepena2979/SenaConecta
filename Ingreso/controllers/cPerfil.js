
$('#depar').change(function(){
	let parametros = "id="+$('#depar').val();
	console.log(parametros);
	$.ajax({
		data: parametros,
		url: '../controllers/cMunicipios.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			// console.log(response);
			$('#Ciudad').html(response.municipio);
			$('#displayDepartamento').show();

		},
		error:function(){
			alert('ocurrio un Errorsito!!');
		}
	});
})

