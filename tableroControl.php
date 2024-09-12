<?php 
session_start();
$_SESSION['tituloPrincipal'] = "CONTROL";
require_once('sessionValidateAdmin.php');
require_once('core/Conexion.php');
require_once('core/Mysql.php');
require_once('core/Helpers.php');



class centros{
	
	//Propiedades
	private $bd;
	private $arraySucursales;
	private $arrayUsuarios;
	public  $datos;
	
	public function __construct($fecha,$datos){
		
		
		$this->bd = new Mysql();
		$this->arrayUsuarios = $this->bd->select_all("SELECT * FROM usuario");
		$this->arraySucursales = $this->bd->select_all("SELECT * FROM sucursal");		
		$this->datos = $datos;
	}
	

	public function mostrarDatos(){
		include('header.php');
			$accesosLinks = $links;
		?>
			<div class="content-wrapper">
		    
		     <section class="content-header" style="background-color:#000000;  font-weight:bold; height:50px; border-left:1px solid black ;">
		      <h1 style="text-transform: uppercase; color:#d89531;">
		        CONTROL
		        <span style="color:#d89531; text-transform: capitalize; font-size: 18px;"> - Accesos</span>
		      </h1>
		    </section>
		    <section class="content">
		    	<div class="box">
		    		<div class="box-body">
		    			<div class="row" style="margin: 0 auto;">
				    	<?php

				    		if(isset($_SESSION['rol'])){
						       foreach ($accesos[$_SESSION['rol']] as $modulo => $modulos) {
						       	?>
						       		<div class="col-md-3" style=" border: 1px solid #ccc; box-shadow: 2px 2px 2px #ccc; padding: 0px; background:#fff; margin: 5px; width: 23% !important;">
						       			
						       			<div style="background: #F4BC13; border-bottom: 1px solid #ccc; padding:5px">
						       				<h4  style="color:black !important; text-transform: uppercase; cursor: pointer; font-weight: bold" id="<?= md5(rand()) ?>" link="<?= $modulo ?>" cant = "<?= count($modulos) ?>" cantOriginal = "<?= count($modulos) ?>" class="header" onclick="$('.t<?= str_replace(" ", "_", $modulo);  ?>').toggle()">Modulo <?= $modulo ?><i style="float:right; " class="fa fa-arrow-down"></i></h4>
						       			</div>
						       			<div style="background: white; padding:5px; z-index:5; height:150px; overflow:auto;">
						       	<?php
						       	foreach ($modulos as $link) {
						       	?>
						       		<p link ="<?= $accesosLinks[$link][0] ?>" cant='abc' style=" color: black; text-decoration: none;" class="t<?= str_replace(" ", "_", $modulo) ?>">
								          <a href="<?= $accesosLinks[$link][1] ?>" target="_blank">
								            <i class="fa fa-edit" ></i> <span><?= $accesosLinks[$link][0] ?></span>
								          </a>
								        </p>

						       		<?php
						       	}
						       		?></div></div><?php
						       }
						       
						   }

				    	?>
				    </div>
				</div>
		    </section>
		</div>
		<?php
		include('generalFooter.php');
	}

	
}

$datos = array();
$obj = new centros('','');
$obj->mostrarDatos();


?>