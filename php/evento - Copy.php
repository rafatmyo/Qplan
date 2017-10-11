<?php
include("conectar.php");
$DBH = conectar();

$resultado= $DBH->query("SELECT * FROM eventos WHERE ideventos =".$_REQUEST['id']."");
while($row = $resultado->fetch(PDO::FETCH_ASSOC)) 
{
echo	"<div align='center'>
<br>
<br>
<br>
	<h2 class='text-center'>".$row["titulo"]."</h2>
    <h3 class='text-center'>".$row["descripcionCorta"]."</h3>
  
  <div class='clearfix'>
    <div class='col-sm-12  col-xs-12'  align='center' >
         <img src='".$row["img"]."'width='500'  class='img-responsive'>
    </div>
    <div class='col-sm-12  col-xs-12'  align='center' >
    <h4><p>".$row["descripcion"]."</p></h4>

    </div>
  </div>
  <div class='clearfix'>
  
        <div class='col-sm-6  col-xs-12'  align='center' >
       <h4><p>Ciudad: ".$row["ciudad"]."</p></h4>
        </div>
        <div class='col-sm-6 col-xs-12' align='center'>
            <h4><p>Lugar: ".$row["lugar"]."</p></h4>
            </div>
       
            </div>
            
            <div class='clearfix'>
  
        <div class='col-sm-6  col-xs-12'  align='center' >
       <h4><p>Catergoria: ".$row["categoria"]."</p></h4>
        </div>
        <div class='col-sm-6 col-xs-12' align='center'>
            <h4><p>Precio: ".$row["precio"]."</p></h4>
            </div>
            </div>
            
            
            <div class='clearfix'>
  
        <div class='col-sm-4  col-xs-11'  align='center'>
       <h4><p>Fecha: ".$row["fecha"]."</p></h4>
        </div>
        <div class='col-sm-4 col-xs-12' align='center'>
            <h4><p>Hora Inicio: ".$row["horaInicio"]."</p></h4>
            </div>
            <div class='col-sm-4 col-xs-12' align='center'>
            <h4><p>Hora Fin: ".$row["horaFin"]."</p></h4>
            </div>
            
            </div>
<br>
<br>
<br>
  </div>";
	
}

$DBH=null;

?>