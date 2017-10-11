<?php
SESSION_START();
include("conectar.php");
$con = conectar();

function cuadroEvento ($titulo, $img, $precio, $fecha, $hora, $id, $categoria, $action){
    $price =  (intval($precio) == 0) ? 'Gratuito' : 'Desde $'.$precio.' MXN';
    $currentDateTime = $fecha.' '.$hora;
    $ampm = date('h:i A', strtotime($currentDateTime));
	switch ($action) {
		case "mis":
			return "<div class=\" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item $categoria\" time='$hora' data-time=\"$fecha $hora\"><div class=\"resultado-listado__propuesta  itemtype-event \"><div class=\"resultado-listado__propuesta____imagen\"><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'><img src=\"$img\" class=\"img-responsive\" alt=\"\"></a></div><div class=\"resultado-listado__propuesta____bandera favorite-item itemtype-event\" data-itemid=\"\" data-itemtype=\"event\"><i class=\"cdmx-favorite\"></i><span class=\"countFavorites\">$hora  </span></div><div class=\"resultado-listado__propuesta____texto\"><div class=\"principal\"><h3><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'>$titulo</a><span></span></h3></div><div class=\"secundario\"><h4 class=\"pull-left\">$fecha</h4><h4 class=\"pull-right\">$price</h4><span style=\"display:none\" class=\"precio\">$precio</span><button onclick='eliminar($id, this)' type=\"button\" class=\"btn btn-danger btn-block\" style=\"padding-top:9px\">Eliminar</button></div></div></div></div>";
			break;
		case "aprobar":
			return "<div class=\" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item $categoria\" time='$hora' data-time=\"$fecha $hora\"><div class=\"resultado-listado__propuesta  itemtype-event \"><div class=\"resultado-listado__propuesta____imagen\"><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'><img src=\"$img\" class=\"img-responsive\" alt=\"\"></a></div><div class=\"resultado-listado__propuesta____bandera favorite-item itemtype-event\" data-itemid=\"\" data-itemtype=\"event\"><i class=\"cdmx-favorite\"></i><span class=\"countFavorites\">$hora  </span></div><div class=\"resultado-listado__propuesta____texto\"><div class=\"principal\"><h3><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'>$titulo</a><span></span></h3></div><div class=\"secundario\"><h4 class=\"pull-left\">$fecha</h4><h4 class=\"pull-right\">$price</h4><span style=\"display:none\" class=\"precio\">$precio</span><button onclick='aprueba($id, this, 1)' type=\"button\" class=\"btn btn-primary btn-block\" style=\"padding-top:9px\">Aprobar</button><button onclick='eliminar($id, this)' type=\"button\" class=\"btn btn-danger btn-block\" style=\"padding-top:9px\">Eliminar</button></div></div></div></div>";
			break;
		case "admin":
			return "<div class=\" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item $categoria\" time='$hora' data-time=\"$fecha $hora\"><div class=\"resultado-listado__propuesta  itemtype-event \"><div class=\"resultado-listado__propuesta____imagen\"><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'><img src=\"$img\" class=\"img-responsive\" alt=\"\"></a></div><div class=\"resultado-listado__propuesta____bandera favorite-item itemtype-event\" data-itemid=\"\" data-itemtype=\"event\"><i class=\"cdmx-favorite\"></i><span class=\"countFavorites\">$hora  </span></div><div class=\"resultado-listado__propuesta____texto\"><div class=\"principal\"><h3><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'>$titulo</a><span></span></h3></div><div class=\"secundario\"><h4 class=\"pull-left\">$fecha</h4><h4 class=\"pull-right\">$price</h4><span style=\"display:none\" class=\"precio\">$precio</span><button onclick='aprueba($id, this, 0)' type=\"button\" class=\"btn btn-primary btn-block\" style=\"padding-top:9px\">NO Aprobar</button><button type=\"button\" onclick='eliminar($id, this)' class=\"btn btn-danger btn-block\" style=\"padding-top:9px\">Eliminar</button></div></div></div></div>";
			break;
		default:
			return "<div class=\" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item $categoria\" time='$hora' data-time=\"$fecha $hora\"><div class=\"resultado-listado__propuesta  itemtype-event \"><div class=\"resultado-listado__propuesta____imagen\"><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'><img src=\"$img\" class=\"img-responsive\" alt=\"\"></a></div><div class=\"resultado-listado__propuesta____bandera favorite-item itemtype-event\" data-itemid=\"\" data-itemtype=\"event\"><i class=\"cdmx-favorite\"></i><span class=\"countFavorites\">$ampm  </span></div><div class=\"resultado-listado__propuesta____texto\"><div class=\"principal\"><h3><a onclick='leerevento($id)' href=\"javascript:void(0)\" data-toggle='modal' data-target='#event-modal'>$titulo</a><span></span></h3></div><div class=\"secundario\"><h4 class=\"pull-left\">$fecha</h4><h4 class=\"pull-right\">$price</h4><span style=\"display:none\" class=\"precio\">$precio</span></div></div></div></div>";
	}
    //return "<figure class='effect-oscar  wowload fadeIn'><img src='$img' alt='img01'/><figcaption><h2>$titulo</h2><p>$descrCorta<br><a onclick='leerevento($id)' href='javascript:void(0)' data-toggle='modal' data-target='#event-modal'>View more</a></p></figcaption></figure>";
}

//______________________Mostrar todos_________________________________
if(isset($_REQUEST['todos'])) {
    $res = $con->query('SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE()');
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "todos");
    }
    echo'<div id="category" style="display:none;"></div>';
}

//______________________Mis eventos_________________________________
if(isset($_REQUEST['usr'])) {
    //echo "<h1 class='text-center'> Mis eventos <span></span></h1>";
    $usr = $_REQUEST['usr'];
    $res = $con->query("SELECT * FROM eventos WHERE idusuario = '$usr'");
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"],"mis");
    }
    echo'<div id="category" style="display:none;"></div>';
}

//______________________Aprobar eventos_________________________________
if(isset($_REQUEST['aprobar'])) {
    //echo "<h1 class='text-center'> Aprobar eventos <span></span></h1>";
    $res = $con->query("SELECT * FROM eventos WHERE estatus = 0 AND fecha >= CURDATE()");
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "aprobar");
    }
    echo'<div id="category" style="display:none;"></div>';
}

//______________________Administrar eventos_________________________________
if(isset($_REQUEST['admin'])) {
    if($_SESSION['user'] == 'admin') {
        //echo "<h1 class='text-center'> Administrar eventos <span></span></h1>";
        $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE()");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "admin");
        }
        echo '<div id="category" style="display:none;"></div>';
    }else{
        header('Location: ../');
    }
}

//____________________Cambiar Categoria_______________________________
if(isset($_REQUEST['newcategory'])) {
    $category = $_REQUEST['newcategory'];
    if($category == ""){
        $res = $con->query('SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE()');
    }else{
        $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$category'");
    }
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "todos");
    }
    echo "<div id='category' style='display:none;'>$category</div>";
}

//_____________________Filtros_________________________________________
if(isset($_REQUEST['filtros'])){
    if(isset($_REQUEST['ciudades'])) {
        $ciudades = join("','", $_REQUEST['ciudades']);
    }else{
        $ciudades = "";
    }
    if(isset($_REQUEST['categoria']) && $_REQUEST['categoria'] != "") {
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];
        $categoria = $_REQUEST['categoria'];
        /*echo $ciudades.PHP_EOL;
        echo $fecha1.PHP_EOL;
        echo $fecha2.PHP_EOL;*/

        if ($ciudades == "" && $fecha1 == "" && $fecha2 == "") {
            //echo "Todos";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria'");
        } elseif ($ciudades != "" && $fecha1 != "" && $fecha2 != "") {
            //echo "Ciudad,Fecha1,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND ciudad IN ('$ciudades') AND fecha >= '$fecha1' AND fecha <= '$fecha2'");
        } elseif ($ciudades != "" && $fecha1 != "" && $fecha2 == "") {
            //echo "Ciudad,Fecha1";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND ciudad IN ('$ciudades') AND fecha >= '$fecha1'");
        } elseif ($ciudades != "" && $fecha1 == "" && $fecha2 != "") {
            //echo "Ciudad,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND ciudad IN ('$ciudades') AND fecha <= '$fecha2'");
        } elseif ($ciudades == "" && $fecha1 != "" && $fecha2 != "") {
            //echo "Fecha1,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND fecha >= '$fecha1' AND fecha <= '$fecha2'");
        } elseif ($ciudades != "" && $fecha1 == "" && $fecha2 == "") {
            //echo "Ciudad";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND ciudad IN ('$ciudades')");
        } elseif ($ciudades == "" && $fecha1 != "" && $fecha2 == "") {
            //echo "Fecha1";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND fecha >= '$fecha1'");
        } elseif ($ciudades == "" && $fecha1 == "" && $fecha2 != "") {
            //echo "Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND categoria = '$categoria' AND fecha <= '$fecha2'");
        }
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            //echo $row["titulo"] . PHP_EOL;
            echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "todos");
        }
        echo "<div id='category' style='display:none;'>$categoria</div>";
    }//------------------------------------TODOS----------------------------------------------------
    else {
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];
        /*echo $ciudades.PHP_EOL;
        echo $fecha1.PHP_EOL;
        echo $fecha2.PHP_EOL;*/

        if ($ciudades == "" && $fecha1 == "" && $fecha2 == "") {
            //echo "Todos";
            $res = $con->query('SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE()');
        } elseif ($ciudades != "" && $fecha1 != "" && $fecha2 != "") {
            //echo "Ciudad,Fecha1,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND ciudad IN ('$ciudades') AND fecha >= '$fecha1' AND fecha <= '$fecha2'");
        } elseif ($ciudades != "" && $fecha1 != "" && $fecha2 == "") {
            //echo "Ciudad,Fecha1";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND ciudad IN ('$ciudades') AND fecha >= '$fecha1'");
        } elseif ($ciudades != "" && $fecha1 == "" && $fecha2 != "") {
            //echo "Ciudad,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND ciudad IN ('$ciudades') AND fecha <= '$fecha2'");
        } elseif ($ciudades == "" && $fecha1 != "" && $fecha2 != "") {
            //echo "Fecha1,Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND fecha >= '$fecha1' AND fecha <= '$fecha2'");
        } elseif ($ciudades != "" && $fecha1 == "" && $fecha2 == "") {
            //echo "Ciudad";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND ciudad IN ('$ciudades')");
        } elseif ($ciudades == "" && $fecha1 != "" && $fecha2 == "") {
            //echo "Fecha1";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND fecha >= '$fecha1'");
        } elseif ($ciudades == "" && $fecha1 == "" && $fecha2 != "") {
            //echo "Fecha2";
            $res = $con->query("SELECT * FROM eventos WHERE estatus = 1 AND fecha >= CURDATE() AND fecha <= '$fecha2'");
        }
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            //echo $row["titulo"] . PHP_EOL;
            echo cuadroEvento($row["titulo"], $row['img'], $row['precio'], $row["fecha"], $row["horaInicio"], $row["ideventos"], $row["categoria"], "todos");
        }
    }
}

$con = null;
?>
<script>
$(function() {
	var MONTHS = ["ENE","FEB","MER","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"];
	var weekday = new Array(7);
    weekday[0] = "DO";
    weekday[1] = "LU";
    weekday[2] = "MA";
    weekday[3] = "MI";
    weekday[4] = "JU";
    weekday[5] = "VI";
    weekday[6] = "SA";
	var myDate, myFormatDate;
	$('h4.pull-left').each(function() {
		var date_str = $(this).html();
		var t = date_str.split("-");
		if(t[2]) {
			myDate = new Date(t[0], t[1] - 1, t[2]);
			myFormatDate = myDate.getDate() + " " + MONTHS[myDate.getMonth()];
		} else {
			myDate = new Date(new Date().getFullYear(), t[1] - 1, t[2]);
			myFormatDate = myDate.getDate() + " " + MONTHS[myDate.getMonth()];
		}
		$(this).html( weekday[myDate.getDay()] + " "+ myFormatDate);
	});
});
//alert(myFormatDate);
</script>