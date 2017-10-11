<?php
include("conectar.php");
$DBH = conectar();
$color = "";



$resultado= $DBH->query("SELECT * FROM eventos WHERE ideventos =".$_REQUEST['id']."");
while($row = $resultado->fetch(PDO::FETCH_ASSOC)) 
{
	
	if ($row["categoria"] == "musica") {
		$color = "#bbefe1";
    	echo "<img style='padding-top:5px; float: right;' src='images/Send/Musica.png' width='100' height='100' alt='icon' class='img-responsive' />";
	} elseif ($row["categoria"] == "cultural") {
		$color = "#bbefe1";
    	echo "<img style='padding-top:5px; float: right;' src='images/Send/Cultural.png' width='100' height='100' alt='icon' class='img-responsive' />";
	} elseif ($row["categoria"] == "deportes") {
		$color = "#ffd1ae";
    	echo "<img style='padding-top:5px; float: right;' src='images/Send/Deportes.png' width='100' height='100' alt='icon' class='img-responsive' />";
	}elseif ($row["categoria"] == "universitarios") {
		$color = "#bbe4fe";
    	echo "<img style='padding-top:5px; float: right;' src='images/Send/Universitarios.png' width='100' height='100' alt='icon' class='img-responsive' />";
	} elseif ($row["categoria"] == "negocios") {
		$color = "#a8aeb9";
    	echo "<img style='padding-top:5px; float: right;' src='images/Send/Negocios.png' width='100' height='100' alt='icon' class='img-responsive' />";
	}else {
		$color = "#bbefe1";
		echo "<img style='padding-top:5px' src='images/Send/Otros.png' width='100' height='100' alt='icon' class='img-responsive' />";
			}
			
echo	"<div align='center' style='background:$color;'>

	<div class='row'>
		<div class='col-sm-6  col-xs-12'  align='left'>
			<img style='padding-top:5px' src='images/iconqplan.png' width='100' height='100' alt='icon' class='img-responsive' />
		</div>
	</div>
	
	<div class='panel panel-default' style='background:$color;'>
	<h2 class='panel-heading'>".$row["titulo"]."</h2>
	</div>
    <h3 class='text-center' style='background:$color; color:black;'>".$row["descripcionCorta"]."</h3>
  
  <div class='clearfix'>
    <div class='col-sm-12  col-xs-12'  align='center' >
         <img src='".$row["img"]."'width='500'  class='img-thumbnail'>
    </div>
    <div class='col-sm-12  col-xs-12'  align='center' >
	<div class='panel panel-default'>
	<div class='text-justify'>
    <h4  class='panel-body'><p>".$row["descripcion"]."</p></h4>
	</div>
	</div>

    </div>
  </div>
  
  <table class='table table-bordered'>
  <div class='clearfix'>
  
        <div class='col-sm-6  col-xs-12'  align='center' >
		<tbody>
       <tr><th><h4><p>Ciudad: ".$row["ciudad"]."</p></h4></th></tr>
        </div>
        <div class='col-sm-6 col-xs-12' align='center'>
			<tr>
            <th><h4><p>Lugar: ".$row["lugar"]."</p></h4></th>
            </div>
       
            </div>
            
            <div class='clearfix'>
  
        <div class='col-sm-6  col-xs-12'  align='center' >
       <th><h4><p>Catergoria: ".$row["categoria"]."</p></h4></th>
	   
        </div>
        <div class='col-sm-6 col-xs-12' align='center'>
            <th><h4><p>Precio: ".$row["precio"]."</p></h4></th>
</tr>
            </div>
            </div>
            
            
            <div class='clearfix'>
  
        <div class='col-sm-4  col-xs-11'  align='center'>
		<tr>
       <th><h4><p>Fecha: ".$row["fecha"]."</p></h4></th>
        </div>
        <div class='col-sm-4 col-xs-12' align='center'>
            <th><h4><p>Hora Inicio: ".$row["horaInicio"]."</p></h4></th>
            </div>
            <div class='col-sm-4 col-xs-12' align='center'>
            <th><h4><p>Hora Fin: ".$row["horaFin"]."</p></h4></th>
			<tr>
			</tbody>
            </div>
            
            </div>
			</div>
<br>
<br>
<br>
  </div>";
	
}

$DBH=null;

?>