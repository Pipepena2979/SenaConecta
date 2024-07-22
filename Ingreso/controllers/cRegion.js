$('#jornada').change(function(){
	let parametros = "id="+$('#jornada').val();
	console.log(parametros);
	if($('#jornada').val()){
		$('#displayRegionq').show();
	}else{
		$('#displayRegionq').hide();
		$('#displayRegion').hide();
	}

});


$('#zona').change(function(){
	let parametros = "id="+$('#zona').val();
	console.log(parametros);
	$.ajax({
		data: parametros,
		url: '../controllers/cRegion.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			// console.log(response);
			$('#Ciudad').html(response.municipio);
			$('#displayRegion').show();

		},
		error:function(){
			// alert('ocurrio un Errorsito!!');
		}
	});
})

