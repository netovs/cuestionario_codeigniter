<h1>REGLAMENTO</h1>
<?php
// echo $num_promotor;
// echo $nombre;
if($intentos == 0)
{
?>
	Muestra las reglas y botón verde para comenzar test...<br/>
	<div class="col-lg-2 center-block">
		<a href="test" class="btn alert-success">COMENZAR</a>
	</div> 
<?php	
}
else {
?>
	Muestra las reglas y botón ROJO DONDE SE INDICA QUE YA NO PUEDE HACER EL TEST... <br/>
		<div class="col-lg-2 center-block">
		<a href="#" class="btn alert-danger"><i class="icon-bar"></i> COMENZAR</a>
	</div> 
<?php
}
?>
<div style="clear: both;"></div>
