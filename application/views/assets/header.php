<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Néstor Velázquez">
    
	<title>
		<?php echo $title;  // Variable del array $data en el __construct del controller cuestionario ?>
	</title>
	
	<script src="<?php echo base_url(); ?>estaticos/js/jquery.js"></script>
	<link href="<?php echo base_url(); ?>estaticos/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>estaticos/bootstrap/css/bootstrap-theme.css" type="text/css" rel="stylesheet"  />
	<?php
	if($nosession == 1)
	{
	?>
	<link href="<?php echo base_url(); ?>estaticos/bootstrap/css/login.css" type="text/css" rel="stylesheet" />
	<?php
	}
	elseif($solotest == 1) 
	{
	?>
	
	<script src="<?php echo base_url(); ?>estaticos/js/cronos.js"></script>
	<script type="text/javascript">
	

	
	
	$( document ).ready(function() {
		$(".form-control").keydown(function(e){
		if (e.keyCode == 13 && !e.shiftKey)
		{
		  // prevent default behavior
		  e.preventDefault();
		  //alert("ok");
		  return false;
		  }
		});
		
		

		$('#submit_1').click(function() {
		
          	var enviar = '';
			var limpio = '';
			var json;
			
			// alert('onclick');
          	
          	$("#cuestionario").find(':input').each(function() {
				 var elemento= this;
				 $('#' + elemento.id).attr("disabled","disabled");
				 enviar += ['{\"' + elemento.id  + '\"\: \"' + elemento.value + '\", \"TIME_OUT\": \"false\"}, '] ;
				
			});
							
			limpio += enviar.substring(0, enviar.length-2);
			
			// alert(limpio);

          	/*
          	 * Aqui va el ajax que sube las respuestas del usuario.
          	*/
			$.ajax({
			        type: 'POST',
			        url: 't7q4eq43w073w5qw', 
			        data: ({ todos: '\{\"todos\": [' + limpio + ']\}' }), 
			        success: function(response) 
			        {
			        	window.location = 'lobby';
			            console.log(response);
			        },
			        error: function(response)
			        {
			            console.log(response);
			        }
			            
			});
			
			
			
		});		
		
		
		
		
	});
	
	
      $(function(){
        $('#counter').countdown({
          image: '<?php echo base_url(); ?>estaticos/images/digits.png',
          startTime: '<?php echo $tiempo; ?>',
          timerEnd: function(){ 
          	alert('Tiempo!');

          	var enviar = '';
			var limpio = '';
			var json;
          	
          	$("#cuestionario").find(':input').each(function() {
				 var elemento= this;
				 $('#' + elemento.id).attr("disabled","disabled");
				 enviar += ['{\"' + elemento.id  + '\"\: \"' + elemento.value + '\", \"TIME_OUT\": \"true\"}, '] ;
				
			});
							
			limpio += enviar.substring(0, enviar.length-2);

          	/*
          	 * Aqui va el ajax que sube las respuestas del usuario.
          	*/
			$.ajax({
			        type: 'POST',
			        url: 't7q4eq43w073w5qw', 
			        data: ({ todos: '\{\"todos\": [' + limpio + ']\}' }), 
			        success: function(response) 
			        {
			            console.log(response);
			        },
			        error: function(response)
			        {
			            console.log(response);
			        }
			            
			});
			
			
          	$('#submit').removeClass('btn-info');
          	$('#submit').removeClass('pull-right');
          	$('#submit').addClass('alert-danger');
          	$('#submit').attr("disabled","disabled");
			$('#submit').remove();
			
			window.location = 'lobby';
          },
          format: 'mm:ss'
        });
      });
    </script>
    <style type="text/css">
      	/* br { clear: both; } */
      	.cntSeparator
      	{
		    font-size: 54px;
		    margin: 10px 7px;
		    color: #000;
      	}
      	.desc { margin: 7px 3px; }
      	.desc div
      	{
	        float: left;
	        font-family: Arial;
	        width: 70px;
	        margin-right: 65px;
	        font-size: 13px;
	        font-weight: bold;
	        color: #000;
      	}
    </style>
	<?php	
	}
	
	
	?>
	<link href="<?php echo base_url(); ?>estaticos/css/style.css"  type="text/css" rel="stylesheet" />

</head>
<body>
	<div class="container">