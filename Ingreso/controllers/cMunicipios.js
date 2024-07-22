$('#rol').change(function(){
	//let parametrosS = "rol="+$('#rol').val();
	let parametros = $('#rol').val();
	// let enDoc = $('#eDoc').val();
	let para = 0;
	let paraS = "";
	// console.log(enDoc);
	if(parametros == 1){
		para = 0;
		paraS = "rol=" + para;
	}else if(parametros == 2){
		para = 1;
		paraS = "rol=" + para;
	}else if (parametros == 3){
		para = 2;
		paraS = "rol=" + para;
	}else{
		para = 0;
		paraS = "rol=" + para;
	}
	console.log(para);

	if( para > 0){
		$.ajax({
			data: paraS,
			url: '../controllers/cMunicipios.php',
			type: 'POST',
			beforeSend: function() { },
			dataType:"json",
			success:function(response){
				//console.log(response);
				$('#supervisor').html(response.municipio);
				$('#displaySupervisor').show();
	
			},
			error:function(){
				alert('ocurrio un Errorsito!!');
			}
		});
	}else{
		$('#displaySupervisor').hide();
	}
});

$('#eRol').change(function(){
	//let parametrosS = "rol="+$('#rol').val();
	let parametros = $('#eRol').val();
	// let enDoc = $('#eDoc').val();
	let para = 0;
	let paraS = "";
	// console.log(parametros + "SSS");
	if(parametros == 1){
		para = 0;
		paraS = "eRol=" + para;
	}else if(parametros == 2){
		para = 1;
		paraS = "eRol=" + para;
	}else if (parametros == 3){
		para = 2;
		paraS = "eRol=" + para;
	}else{
		para = 0;
		paraS = "eRol=" + para;
	}
	console.log(para);

	if( para > 0){
		$.ajax({
			data: paraS,
			url: '../controllers/cMunicipios.php',
			type: 'POST',
			beforeSend: function() { },
			dataType:"json",
			success:function(response){
				//console.log(response);
				$('#supervisor').html(response.municipio);
				$('#displaySupervisor').show();
	
			},
			error:function(){
				alert('ocurrio un Errorsito!!');
			}
		});
	}else{
		$('#displaySupervisor').hide();
	}
});


$('#departamento').change(function(){
	let parametros = "id="+$('#departamento').val();
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

