<?php
SESSION_START();
header("Content-Type: text/html;charset=utf-8");
include("php/conectar.php");
$con = conectar();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    $user = "Undefinded";
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Q'PLAN!</title>

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- bootstrap -->
    <!--<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">

<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />


    <!-- animate.css -->
    <link rel="stylesheet" href="assets/animate/animate.css" />
    <link rel="stylesheet" href="assets/animate/set.css" />

    <!-- gallery -->
    <link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="css/login.css" />
    <!-- jquery -->
    <!--<script src="assets/jquery.js"></script>-->
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>


    <!-- wow script -->
    <script src="assets/wow/wow.min.js"></script>


    <!-- boostrap -->
    <!--<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>


    <!-- jquery mobile -->
    <script src="assets/mobile/touchSwipe.min.js"></script>
    <script src="assets/respond/respond.js"></script>

    <!-- gallery -->
    <script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

    <!-- custom script -->
    <script src="assets/script.js"></script>

	<!--  Slider  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.4.1/css/bootstrap-slider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.4.1/bootstrap-slider.min.js"></script>
    
    
    <!--  Chosen  -->
    <link rel="stylesheet" href="http://alxlit.name/bootstrap-chosen/bootstrap.css" />
    <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>

    <!--  Clockpicker -->
    <link rel="stylesheet" href="css/clockpicker.css" />
    <script src="js/clockpicker.js"></script>
    <style type="text/css">
        .red{ border-color:hsla(359,91%,43%,1.00);
        }
        .red2{ color:hsla(359,91%,43%,1.00);
        }
		.vistas{
			width:100%;
			margin-top:20px;
		}
		
		.zoom{
			width:100%;
			height:150px;
			border-top-right-radius:10px;
			border-top-left-radius:10px;
			cursor:pointer;
		}
		
		.text{
			width:100%;
			margin-top:-5px;
			background-color:#EBEBEB;
			padding:8px;
			font-size:12px;
			border-bottom-right-radius:10px;
			border-bottom-left-radius:10px;
		}
		
		.text:hover{
			background-color:#d7d7d7;
		}
    </style>
	<link rel="stylesheet" href="css/style.css" />
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script type="application/javascript" src="js/script.js"></script>
    <script>
        $(function() {
            $('.chosen-select').chosen({width:"100%"});
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true, width:"100%" });
        });
    </script>
</head>

<body>


<!-- Header Starts -->



<div id="contact" class="spacer">

    <div class="row wowload fadeInLeftBig">
        <div class="col-sm-6  col-xs-12"  align="center" >
        <a href="index.php">
            <img src="images/qplanneon.png" alt="logo" class="img-responsive">
            </a> 
        </div>
        <div class="col-sm-5 col-xs-12" align="center" style ='background-color: #35363a; color:#FFF; border-style:solid; border-width:80; border-color:#FFF; border-radius: 25px;'>

            <h2 class="text-center  wowload fadeInUp" style="padding-top:10px">Solo aquí te enteraras de los mejores eventos de Cuernavaca!.</h2>
            
            <div id="loggin">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#login-modal">
        <img id="logimg" src="images/usuario.png"  alt="login" width="50" class="img-responsive" >
        </a>
    </div>
            
            <div class="dropdown navbar-right" id="user" style="display:none">
               
                <form method="post" id="cerra">
                 <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                        <?php
                        echo ''.$user;
                        ?>

                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                        <li><a role="menuitem" href="javascript:void(0)" onClick="crearEvento()">Crear Evento</a></li>
                        <?php
                        echo '<li><a role="menuitem" href="javascript:void(0)" onClick="misEventos(\''.$user.'\')">Mis Eventos</a></li>';
                        ?>
                        <?php
                        if($user=='admin'){
                            echo '
							<li><a role="menuitem" href="javascript:void(0)" onClick="aprobarEventos()">Aprobar Eventos</a></li>
							';
                            echo '
							<li><a role="menuitem" href="javascript:void(0)" onClick="administrarEventos()">Administrar Eventos</a></li>
							';
                        }
                        ?>
                        <li class="divider"></li>
                        <li><a role="menuitem" href="javascript:void(0)" name="cerrar" onClick="cerrarSesion()">Cerrar Sesión</a></li>
                    </ul>
                </form>
                
            </div>
            
        </div>
    </div>
    
</div>




<div id="buscador" style="background-color:#eeeeee "align='center'>
<div class="col-sm-12  col-xs-12 none" id="titulo">
<h2 class="text-center  wowload fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></h2>
</div>
<br>
<br>
<div class='col-sm-3  col-xs-12'  align='center' >
<div class="input-group input-group-lg" style="width:100%;">
    <select id="ciudades" data-placeholder="Ciudad" multiple class="form-control chosen-select"  tabindex="8">
        <option value=""></option>
        <?php
        $resultado = $con->query('SELECT DISTINCT ciudad FROM eventos WHERE estatus = 1 AND fecha >= CURDATE()');
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$row["ciudad"]."'>" . $row["ciudad"] . "</option>";
        }
        ?>
    </select>
</div>
</div>



<div class='col-sm-3  col-xs-12'  align='center' >
<div class="input-group datepic">
    <input type="text" id="fecha1" class="form-control" placeholder="Desde">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </div>
</div>

</div>

<div class='col-sm-3 col-xs-12'  align='center' >
<div class="input-group datepic" >
    <input type="text" id="fecha2" class="form-control" placeholder="Hasta">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </div>
</div>

</div>

<div class='col-sm-3 col-xs-12'  align='center' >
<div class="form-group"> <!-- Submit button -->
    <button class="btn btn-primary" name="submit" type="button" onclick="buscarl()">Buscar</button>
</div>

</div>
<br>
<br>
</div>
<div class="container-fluid resultado-listado" id="filtss">
<div >
<div class="row" style="background-color:#eeeeee">
<h2>Filtros</h2>
<div class='col-xs-12 col-sm-7 col-md-7 col-lg-7'>
<div id="filters" class="button-group">  
    <button class="button is-checked todos" data-filter="*"><img src="images/Send/Titles2/todos.png" width="60" height="60"></button>
    <button class="button" data-filter=".musica"><img src="images/Send/Titles2/conciertos.png" width="60" height="60"></button>
    <button class="button" data-filter=".cultural"><img src="images/Send/Titles2/cultural.png" width="60" height="60"></button>
    <button class="button" data-filter=".deportes"><img src="images/Send/Titles2/deportivos.png" width="60" height="60"></button>
    <button class="button" data-filter=".universitarios"><img src="images/Send/Titles2/academicos.png" width="60" height="60"></button>
    <button class="button" data-filter=".negocios"><img src="images/Send/Titles2/negocios.png" width="60" height="60"></button>
    <button class="button" data-filter=".otros"><img src="images/Send/Titles2/otros.png" width="60" height="60"></button> 
    </div>
    </div>
    <div class='col-xs-12 col-sm-5 col-md-5 col-lg-5' style="padding-left:40px; padding-right:50px;">
    <span class="text-center"><h4> Precio:</h4> 
    </span><span>
    <!--<input id="ex2" type="text" class="span2" value="" data-slider-min="0" 
    data-slider-max="1000" data-slider-step="5" data-slider-value="[0,1000]"/>-->
    <input id="ex2" style="width:100%;" type="text" value="" data-slider-value="1000" data-slider-ticks="[0, 200, 500, 700, 1000]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["$0", "$100", "$200", "$300", "$400"]' />
    </span>  
</div>
</div>
</div>
<div id="ords" class="row">
<h2>Ordenar</h2>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div id="sorts" class="button-group">
    <!--<button class="button is-checked" data-sort-by="original-order">original order</button>-->
    <button class="button is-checked fecha" data-sort-by="fecha">Fecha</button>
    <button class="button" data-sort-by="r">Random</button>
    <button class="button" data-sort-by="precio">Precio</button>    
    <button class="button" data-sort-by="fp">Fecha/Precio</button>
    <button class="button" data-sort-by="hora">Hora</button>
    </div>
</div>
<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
<div id="sorts" class="button-group">
    <!--<button class="button is-checked" data-sort-by="original-order">original order</button>-->
    <button class="button is-checked ascendente"  onClick="asc()">Ascendente</button>
    <button class="button" onClick="des()">Descendente</button>    
</div>
</div>
<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3 lemobile'>
<div id="sorts" class="button-group">
    <!--<button class="button is-checked" data-sort-by="original-order">original order</button>-->
    <button class="button is-checked juntas"  onClick="juntas()">Filas Juntas</button>
    <button class="button" onClick="separadas()">Filas Separadas</button>    
</div>
</div>
</div>
</div>
			
			<!--<div id="tabs" class="tabs" >
				<nav>
					<ul>
						<li onclick="cargartodas()"><a href="#section-1"><center> <img src="images/all.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('musica')"><a href="#section-2"><center> <img src="images/music.ico" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('cultural')"><a href="#section-3"><center> <img src="images/culture.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('deportes')"><a href="#section-4"><center> <img src="images/sport.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('universitarios')"><a href="#section-5"><center> <img src="images/university.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('negocios')"><a href="#section-6"><center> <img src="images/negocios.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
                        <li onclick="newCategory('otros')"><a href="#section-7"><center> <img src="images/otros.png" alt="logo" width="50"  class="img-responsive"></center><span></span></a></li>
						
						
					</ul>
				</nav>
				<div class="content">
					<section id="section-1"><h2 align="center">Todas</h2></section>
					<section id="section-2"><h2 align="center">Musical</h2></section>
					<section id="section-3"><h2 align="center">Cultural</h2></section>
					<section id="section-4"><h2 align="center">Deportes</h2></section>
					<section id="section-5"><h2 align="center">Universitarios</h2></section>
                    <section id="section-6"><h2 align="center">Negocios</h2></section>
                    <section id="section-7"><h2 align="center">Otros</h2></section>
				</div>
			</div> -->
			
		

<!--  ************	****************************** eventos  **************************************************** -->


<div class="container-fluid resultado-listado">
<div  >
	<div id="works" class="row rectifica-row resultado-listado__contenedor" style="background-color:hsla(222,7%,65%,0.22)">


        <!--<div class=" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item musica" data-category="musica"><div class="resultado-listado__propuesta  itemtype-event "><div class="resultado-listado__propuesta____imagen"><a onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'><img src="images/kike/12/ecard-encuentro-bandas.jpg" class="img-responsive" alt="Concierto con la Banda de Gaitas del Batallón de San Patricio"></a></div><div class="resultado-listado__propuesta____bandera favorite-item itemtype-event" data-itemid="16072" data-itemtype="event"><i class="cdmx-favorite"></i><span class="countFavorites">   1  </span></div><div class="resultado-listado__propuesta____texto"><div class="principal"><h3><a  onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'>Concierto con la Banda de Gaitas del Batallón de San Patrici...</a><span></span></h3></div><div class="secundario"><h4 class="pull-left">01 may - 04 dic</h4><h4 class="pull-right">Gratuito</h4><span style="display:none" class="precio"></span>
                        <button type="button" class="btn btn-primary btn-block" style="padding-top:9px">Aprobar</button><button type="button" class="btn btn-danger btn-block" style="padding-top:9px">Eliminar</button></div></div></div></div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item cultural" data-category="cultural"><div class="resultado-listado__propuesta  itemtype-event "><div class="resultado-listado__propuesta____imagen"><a onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'><img src="images/kike/11/b74b6493-2508-4668-869e-37572a85ff64_176861_CUSTOM.jpg" class="img-responsive" alt="Concierto con la Banda de Gaitas del Batallón de San Patricio"></a></div><div class="resultado-listado__propuesta____bandera favorite-item itemtype-event" data-itemid="16072" data-itemtype="event"><i class="cdmx-favorite"></i><span class="countFavorites">   1  </span></div><div class="resultado-listado__propuesta____texto"><div class="principal"><h3><a  onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'>Concierto con la Banda de Gaitas del Batallón de San Patrici...</a><span></span></h3></div><div class="secundario"><h4 class="pull-left">01 may - 04 dic</h4><h4 class="pull-right">Gratuito</h4><span style="display:none" class="precio">2</span>
                        <button type="button" class="btn btn-primary btn-block" style="padding-top:9px">Aprobar</button><button type="button" class="btn btn-danger btn-block" style="padding-top:9px">Eliminar</button></div></div></div></div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-3  rectifica-columna element-item universitarios" data-category="universitarios"><div class="resultado-listado__propuesta  itemtype-event "><div class="resultado-listado__propuesta____imagen"><a onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'><img src="images/kike/23/14731137_1478075218874305_3407087927875116096_n.jpg" class="img-responsive" alt="Concierto con la Banda de Gaitas del Batallón de San Patricio"></a></div><div class="resultado-listado__propuesta____bandera favorite-item itemtype-event" data-itemid="16072" data-itemtype="event"><i class="cdmx-favorite"></i><span class="countFavorites">   1  </span></div><div class="resultado-listado__propuesta____texto"><div class="principal"><h3><a  onclick='leerevento(12)' href="javascript:void(0)" data-toggle='modal' data-target='#event-modal'>Concierto con la Banda de Gaitas del Batallón de San Patrici...</a><span></span></h3></div><div class="secundario"><h4 class="pull-left">01 may - 04 dic</h4><h4 class="pull-right">Gratuito</h4><span style="display:none" class="precio">3</span>
                        <button type="button" class="btn btn-primary btn-block" style="padding-top:9px">Aprobar</button><button type="button" class="btn btn-danger btn-block" style="padding-top:9px">Eliminar</button></div></div></div>-->







    </div>
	</div>
</div>
<!-- works -->

<!-- Footer Starts -->
<div class="footer text-center spacer">
    <p>Copyright 2016. Todos los derechos reservados. Consulte los<a href="javascript:void(0)" data-toggle="modal" data-target="#condiciones-modal">términos y condiciones</a></p>
</div>
<!-- # Footer Ends -->





<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
</div>


<div class="modal fade" id="condiciones-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="condmodal">
        	<div class='row'>
			<div class='col-sm-6  col-xs-12'  align='left'>
			<img style='padding-top:5px' src='images/iconqplan.png' width='100' height='100' alt='icon' class='img-responsive' />
			</div>
			</div>
          <h1 style="text-align: center;"><span style="text-decoration: underline; color: #972513;">T&eacute;rminos y condiciones de uso</span></h1>
<p>Nuestros T&eacute;rminos y Condiciones de uso del sitio web le indican los t&eacute;rminos de uso seg&uacute;n los cuales puede usar nuestro sitio web www.qplan.com.mx, ya sea como invitado o como usuario registrado.</p>
<h2>Definiciones</h2>
<p>En estos T&eacute;rminos y Condiciones, se hace referencia a Qplan como &ldquo;nosotros" o &ldquo;nos&rdquo;. Lea estos T&eacute;rminos y Condiciones de uso (&ldquo;T&eacute;rminos&rdquo;) detenidamente antes de usar nuestro sitio web. Al usar nuestro sitio web, usted acepta estos T&eacute;rminos, y acepta respetarlos. Si no est&aacute; de acuerdo con estos T&eacute;rminos, no debe usar nuestro sitio web.</p>
<h2>Datos personales</h2>
<p>Usted acepta que al usar nuestro sitio web, nosotros podemos recopilar datos personales de usted. Puede encontrar una descripci&oacute;n de c&oacute;mo utilizaremos sus datos personales en nuestra Pol&iacute;tica de Privacidad.</p>
<h2>Sus obligaciones</h2>
<p>Al usar nuestro sitio web, seg&uacute;n los T&eacute;rminos y Condiciones usted:</p>
<p>Debe usar nuestro sitio web s&oacute;lo para fines l&iacute;citos y de una manera que no viole los derechos de terceros ni restrinja ni inhiba el uso de nuestro sitio web por parte de terceros;</p>
<p>No debe participar de ninguna conducta que sea il&iacute;cita, o que pueda acosar o causar consternaci&oacute;n o incomodidad a cualquier persona;</p>
<p>No debe cargar, publicar, transmitir ni distribuir ning&uacute;n material o informaci&oacute;n (i) cuando usted no sea titular de los derechos de propiedad intelectual o no tenga derecho a usar dichos derechos sobre ese material o los permisos necesarios (ii) que sea il&iacute;cito o que pueda ser perjudicial, amenazante, abusivo, calumnioso, difamatorio, pornogr&aacute;fico o de otro modo obsceno, objetable desde el punto de vista racial, &eacute;tnico o de otro tipo, o que da&ntilde;e la reputaci&oacute;n de Qplan;</p>
<p>No debe interferir, da&ntilde;ar ni afectar ninguna parte de nuestro sitio web, ning&uacute;n equipo, sistema o red utilizados para operar nuestro sitio web;</p>
<p>No debe transmitir ning&uacute;n dato ni enviar ni cargar ning&uacute;n material que contenga virus, troyanos, gusanos, bombas de tiempo, registradores de pulsaciones de teclas, spyware, adware o cualquier otro programa perjudicial o c&oacute;digo de computaci&oacute;n similar dise&ntilde;ado para afectar negativamente el funcionamiento de cualquier computadora o hardware;</p>
<p>Debe usar software de comprobaci&oacute;n de virus; y</p>
<p>No debe reproducir, duplicar, copiar ni revender ninguna parte de nuestro sitio web.</p>
<h2>Exclusi&oacute;n de garant&iacute;as</h2>
<p>Qplan no ofrece garant&iacute;as, manifestaciones ni compromisos respecto de ning&uacute;n contenido de este sitio web (incluidos, a modo de ejemplo, respecto de la calidad, exactitud, completitud o aptitud para un fin espec&iacute;fico de dicho contenido), ni de ning&uacute;n contenido de cualquier otro sitio web al que se remita o al que se acceda por enlace de hipertexto a trav&eacute;s de este sitio web.</p>
<p>Qplan no acepta responsabilidad alguna por ninguna p&eacute;rdida que pudiera surgir por basarse en informaci&oacute;n o materiales publicados en este sitio web. Si desea obtener m&aacute;s detalles sobre la informaci&oacute;n en los materiales publicados, comun&iacute;quese con Qplan.</p>
<p>Determinadas partes de este sitio web y sitios web relacionados tienen enlaces a sitios web de internet externos, y otros sitios web de internet externos pueden contener enlaces a este sitio web. Qplan no es responsable del contenido de ning&uacute;n sitio web de internet externo.</p>
<p>No podemos garantizar que nuestro sitio web y cualquier documento, archivo e informaci&oacute;n albergados o descargados de este sitio web no contendr&aacute;n virus, troyanos, gusanos, bombas de tiempo, registradores de pulsaciones de teclas, spyware, adware y otros programas perjudiciales o c&oacute;digo de computaci&oacute;n dise&ntilde;ado para afectar negativamente el funcionamiento de cualquier software o hardware de computaci&oacute;n; No somos responsables de ninguna p&eacute;rdida que pueda sufrir una persona, que surja de dicho c&oacute;digo perjudicial o c&oacute;digo de computaci&oacute;n.</p>
<p>Los enlaces a otros sitios web se proporcionan s&oacute;lo con fines informativos. No tenemos control sobre el contenido de los sitios web a los que se incluyen enlaces, y no aceptamos responsabilidad alguna por el material que se encuentra en estos ni por p&eacute;rdidas o da&ntilde;os que puedan surgir del uso de estos.</p>
<h2>Derechos de autor</h2>
<p>El derecho de autor sobre el contenido de todas las p&aacute;ginas de nuestro sitio web es propiedad de nosotros. La reproducci&oacute;n de parte o la totalidad del contenido de cualquier forma se encuentra prohibida salvo de conformidad con los siguientes permisos</p>
<p>Usted no puede:</p>
<p>Modificar el papel ni las copias digitales de ning&uacute;n material que haya imprimido o descargado de ninguna manera sin nuestro consentimiento previo por escrito. No se le permite incorporar ning&uacute;n material ni ninguna parte de los materiales de nuestro sitio web como parte de ning&uacute;n otro trabajo o publicaci&oacute;n, ya sea en copia impresa, electr&oacute;nica o de cualquier otra forma; ni</p>
<p>Distribuir o copiar ninguna parte de nuestro sitio web para fines comerciales.</p>
<p>Los nombres y logotipos que identifican a nuestro sitio web y a Qplan son propiedad de nosotros.</p>
<h2>Cambios en nuestro sitio web</h2>
<p>Podemos actualizar nuestro sitio web peri&oacute;dicamente, y podemos cambiar el contenido en cualquier momento. Sin embargo, tenga en cuenta que cualquier contenido de nuestro sitio web puede estar desactualizado en cualquier momento, y no tenemos la obligaci&oacute;n de actualizarlo.</p>
<p>No garantizamos que nuestro sitio web ni ning&uacute;n contenido de este est&eacute; libre de errores u omisiones.</p>
<h2>Acceso a nuestro sitio web</h2>
<p>Nuestro sitio web est&aacute; disponible sin cargo.</p>
<p>No garantizamos que nuestro sitio web ni ning&uacute;n contenido del mismo est&eacute; siempre disponible o no sea interrumpido. El acceso a nuestro sitio web se permite en forma temporal. Podemos suspender, retirar, discontinuar o cambiar la totalidad o cualquier parte de nuestro sitio web sin aviso. No asumiremos responsabilidad frente a usted por ning&uacute;n motivo por el que nuestro sitio web no est&eacute; disponible en cualquier momento o por cualquier per&iacute;odo.</p>
<p>Usted es responsable de hacer todas las gestiones necesarias para tener acceso a nuestro sitio web.</p>
<p>Usted tambi&eacute;n es responsable de asegurarse de que todas las personas que accedan a nuestro sitio web mediante su conexi&oacute;n a internet conozcan estos T&eacute;rminos y otros t&eacute;rminos y condiciones aplicables, y de que cumplan con ellos.</p>
<h2>Enlaces a nuestro sitio web</h2>
<p>Usted puede incluir un enlace a la&nbsp;<a href="http://www.qplan.com.mx">p&aacute;gina de inicio</a>&nbsp;de nuestro sitio web, siempre que lo haga de manera justa y legal y que no da&ntilde;e nuestra reputaci&oacute;n ni se aproveche de ella.</p>
<p>Usted no debe establecer un enlace de modo que sugiera cualquier forma de asociaci&oacute;n, aprobaci&oacute;n o aval de nuestra parte cuando no exista.</p>
<p>Nuestro sitio web no debe enmarcarse en ning&uacute;n otro sitio web, usted tampoco debe crear un enlace a ninguna parte de nuestro sitio web distinta de la p&aacute;gina de inicio.</p>
<p>Nos reservamos el derecho de retirar el permiso de enlace sin aviso.</p>
<p>Si desea hacer uso de cualquier contenido de nuestro sitio web de un modo distinto del establecido anteriormente, comun&iacute;quese con nosotros.</p>
<h2>Derecho aplicable</h2>
<p>Estos T&eacute;rminos, su objeto y su formaci&oacute;n (y cualquier disputa o reclamaci&oacute;n) se rigen por el derecho mexicano. Ambas partes aceptamos la jurisdicci&oacute;n exclusiva de los tribunales de M&eacute;xico</p>
<h2>Cambios en los t&eacute;rminos</h2>
<p>Podemos revisar estos T&eacute;rminos modificando esta p&aacute;gina. Verifique esta p&aacute;gina peri&oacute;dicamente para consultar cualquier cambio que hayamos hecho, dado que es vinculante para usted.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Iniciar Sesión</h1><br>
            <form method="post" action="php/login.php" id="init">
                <input type="text" name="user" id="usr" placeholder="Username">
                <input type="password" name="pass" id="pss" placeholder="Password">
                <input type="submit" name="login" id="boton" class="login loginmodal-submit" value="Login" onClick="iniciar(this)">
            </form>
            <p id="incorrecto" style="color:red;" class="hide">Usuario o Contraseña incorrectos</p>
            <div class="login-help">
                <a href="javascript:void(0)" onclick="nologgin()">Registrarse</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Registrarse</h1><br>
            <form method="post" action="php/login.php" id="init2">
                <input type="text" name="user2" id="usr2" placeholder="Username">
                <input type="password" name="pass2" id="pss2" placeholder="Password">
                <input type="submit" name="login" id="boton2" class="login loginmodal-submit" value="Registrate" onClick="registrar(this)">
            </form>
            <p id="existe" style="color:red;" class="hide">Usuario existente</p>
			<div class="login-help">
                <a href="javascript:void(0)" onclick="condiciones()">términos y condiciones</a>
            </div>
            <div id="condd"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div id="cosa123"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>




<!--<script src="js/cbpFWTabs.js"></script>
		<script>
			new CBPFWTabs( document.getElementById( 'tabs' ) );
		</script>-->
<script type="text/javaScript">
    <?php
    if(isset($_SESSION['user'])){
        //echo $user;
        echo '$("#loggin").css("display","none");
		$("#user").css("display","block");';
    }
    ?>
</script>

</body>
</html>