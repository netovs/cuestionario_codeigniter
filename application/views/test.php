<div class="row page-header">
        <div class="col-xs-6 col-sm-4">Nombre: <?php echo $nombre; ?><br/>
        	Modulo: <?php print_r($modulo); ?>
        </div>
        <div class="col-xs-6 col-sm-4">Número de promotor: <?php echo $num_promotor; ?></div>
        <div class="col-xs-6 col-sm-4">
        	
		  <div id="counter"></div>
		  <div class="desc">
		    <div>Minutos</div>
		    <div>Segundos</div>
		  </div>
        	
        </div>
</div>
<div class="row">
	
	<div id="response"></div>
	
	<form role="form" name="cuestionario" id="cuestionario" method="post">
		<input type="hidden" name="modulo_id" id="modulo_id" value="<?php echo $modulo_id; ?>" />
		<input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $id; ?>" />
		<input type="hidden" name="tiempo_asignado" id="tiempo_asignado" value="<?php echo $tiempo; ?>" />
	        <div class="col-lg-*">
	            <div class="well well-sm">
	            	<strong><span class="glyphicon glyphicon-asterisk"></span>Respuestgas obligatorias.</strong>
	            </div>
				<?php // print_r($lasPreguntas); 
				$i = 1;
				foreach($lasPreguntas as $key => $asd)				
				{
				?>
	            <div class="form-group">
	                <label for="InputMessage"><?php echo $i . '.-' .$asd; ?></label>
	                <div class="input-group">
	                	<input type="hidden" name="pregunta_id" id="pregunta_id"  value="<?php echo $key; ?>"/>
	                    <textarea name="respuesta_<?php echo $key; ?>" id="respuesta_<?php echo $key; ?>" class="form-control" rows="5" required></textarea>
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
	                </div>
	            </div>
	            <?php
	             $i ++;
				}
				?>
	            <input type="button" name="submit_1" id="submit_1" value="Enviar" class="btn btn-info pull-right">
	        </div>
	</form>
</div>