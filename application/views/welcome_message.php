

	<h1><?php echo $title;  // Variable del array $data en el __construct del controller cuestionario ?>!</h1>


	<div class="logo">
		<img src="<?php echo base_url(); ?>estaticos/images/huawei_logo_png.png" width="400px" />
		
	<?php
		if(@$error)
		{
			?>
			<div class="alert-danger"><?php echo @$error; ?></div>
			<?php
		}
	?>
		
		
	</div>

      <form class="form-signin" role="form" action="<?php echo base_url(); ?>index.php/vrfaux/chklgn/" method="post">
        <h2 class="form-signin-heading">Iniciar sesión</h2>
        <input type="email" class="form-control" placeholder="Email" required="required" autofocus name="emailio" id="emailio" />
        <!-- <input type="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit"> Aceptar </button>
      </form>
