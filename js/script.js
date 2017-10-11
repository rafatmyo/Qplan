var $grid; 

$(document).ready(function(){
            $('.datepic input').datepicker({
                format: "yyyy-mm-dd",
                startDate: "today",
                todayBtn: "linked",
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
            });
            $("#boton").click(function(e){
                e.preventDefault();
            });
            $("#boton2").click(function(e){
                e.preventDefault();
            });
			$("#ex2").slider({
				//tooltip: 'always',
				ticks: [0, 200, 500, 700, 1000],
    ticks_labels: ['Gratuitos', '$200', '$500', '$700', '$1000+'],
    ticks_snap_bounds: 40	
			});
			// flatten object by concatting values
			function concatValues( obj ) {
			  var value = '';
			  for ( var prop in obj ) {
				value += obj[ prop ];
			  }
			  return value;
			}
			$("#ex2").on("change", function(slideEvt) {
				var data = parseInt($("#ex2").val());
				//console.log($("#ex2").val());
				$(".element-item").each(function(){
					var price = parseInt($(this).find(".precio").text());
					if (price <= data) {
						$(this).addClass('show-me');
					}
					else {
						$(this).removeClass('show-me');
					}
				  });
				  if(data >= 1000){
					  var f1 = $('.button-group').find('.is-checked').first().attr('data-filter');
					  $grid = $('.resultado-listado__contenedor').isotope({
						  filter : f1
					  });
				  }else{
					  var f1 = $('.button-group').find('.is-checked').first().attr('data-filter');
					  //alert(f1);
					  if(f1 === "*"){
						  f1 = ".show-me";
					  }else{
						  f1 = ".show-me"+f1;
					  }
					  //console.log(f1);
					  var filterValue = concatValues( f1 );
					  $grid = $('.resultado-listado__contenedor').isotope({
						  //filter : '.show-me'	
						  filter : filterValue
					  });
				  }
			});

			/*
			var $grid;
			$grid = $('.resultado-listado__contenedor').isotope({
						  itemSelector: '.element-item',
						  layoutMode: 'fitRows',
						  getSortData: {
							precio: '.precio'
						  }
						});*/
						
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {todos: ''},
                success: function(response) { 
					//alert('');
					$("#works").html(response); 					
					$(window).on('load', function() { 
						window.setTimeout(function (){
							$grid = $('.resultado-listado__contenedor').isotope({
							  itemSelector: '.element-item',
							  //layoutMode: 'fitRows',					  
							  getSortData: {
								  fecha : '[data-time]',
								precio: '.precio parseInt',
								hora : '[time]'							
							  }
							});
							$grid.isotope({ sortBy : 'fecha' });
						}, 500);						
					});
						
				},complete: function(data){					
					
					//alert();
				}
			});	
			
			//
			
			
			
			// bind filter button click
			$('#filters').on( 'click', 'button', function() {
			  var filterValue = $( this ).attr('data-filter');
			  // use filterFn if matches value
			  $grid.isotope({ filter: filterValue });
			});
			
			// bind sort button click
			$('#sorts').on( 'click', 'button', function() {
			  var sortByValue = $(this).attr('data-sort-by');
			  //$grid.isotope('shuffle');
			  if(sortByValue === "r"){
				  $grid.isotope('shuffle');
			  }
			  else if(sortByValue === "fp"){
				  $grid.isotope({ sortBy: ['fecha', 'precio'] });
			  }else{
			  $grid.isotope({ sortBy: sortByValue });
			  }
			});
			
			// change is-checked class on buttons
			$('.button-group').each( function( i, buttonGroup ) {
			  var $buttonGroup = $( buttonGroup );
			  $buttonGroup.on( 'click', 'button', function() {
				$buttonGroup.find('.is-checked').removeClass('is-checked');
				$( this ).addClass('is-checked');
			  });
			});		
					
        });
		
        function cerrarSesion(){
            $.post( "php/login.php", {cerrar : ''} )
                .done(function( data ) {
                    /*if(data == ""){
                     $('#cerra').submit();
                     }else{
                     alert("Incorrecto");
                     }*/
                    $('#cerra').submit();
                });
        }

        function iniciar(){
            var usuario = $('#usr').val();
            var contra = $('#pss').val();
            $.post( "php/login.php", {user : usuario, pass: contra} )
                .done(function( data ) {
                    if(data == "Incorrecto"){
                        //alert("Incorrecto");
                        $("#incorrecto").removeClass("hide");
                    }else{
                        $('#init').submit();
                    }
                });
        }
		
		function condiciones(){
			//alert();
			$('#condd').html($('#condmodal').html());
			
		}

        function nologgin() {
            $('#login-modal').modal('toggle');
            window.setTimeout(function (){$('#registro-modal').modal('toggle'); }, 500);
            $("#existe").addClass("hide");
            //$('#registro-modal').modal('toggle');
        }
		function cargartodas() {
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {todos: ''},
                success: function(response) { $("#works").html(response); }});
        }
		function leerevento(x) {
            $.ajax({
                url: 'php/evento.php',
                type: 'post',
                data: {id: x},
                success: function(response) { $("#cosa123").html(response); }});
        }
		

        function registrar(){
            var usuario = $('#usr2').val();
            if(usuario != "") {
                $.post("php/login.php", {userCheck: usuario})
                    .done(function (data) {
                        //alert(data);
                        if (data == "Existe") {
                            $("#existe").removeClass("hide");
                        } else {
                            $('#init2').submit();
                            //Cambiar html -> Success
                        }
                    });
            }else{
                alert("Llenar los campos");
            }
        }

        function crearEvento() {			
            $.ajax({
                url: 'php/subir.php',
                type: 'post',
                data: {},
                success: function(data) {
                    $("#works").html(data);
					$("#filtss").addClass("hide");
					$("#buscador").addClass("hide");
                    $("#cerra").removeClass("open");
                    $('.dropdown-backdrop').remove();
                    $('html, body').animate({
                        scrollTop: $('#works').offset().top
                    },1000);
                }
            });
        }

        function imag(file){
            $('#file').removeClass("red2");
            $(file).next().html('<img src="images/ajax-loader.gif" width="180"/>');
            var formData = new FormData($('#formuedith')[0]);
            var ruta = 'php/previmg.php';
            $.ajax({
                url: ruta,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                    //alert(datos);
                    $(file).next().html(datos);
                }
            });
        }

        function buscarl() {
            $ciudades = $('#ciudades').val();
            $fecha1 = $('#fecha1').val();
            $fecha2 = $('#fecha2').val();
            $categoria = $('#category').html();
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {filtros: '', ciudades: $ciudades, fecha1: $fecha1, fecha2: $fecha2, categoria: $categoria},
                success: function(response) {
                    $("#works").html(response);
					window.setTimeout(function (){
						$grid.isotope('destroy');
						$grid = $('.resultado-listado__contenedor').isotope({
						  itemSelector: '.element-item',
						  //layoutMode: 'fitRows',					  
						  getSortData: {
							  fecha : '[data-time]',
							precio: '.precio parseInt',
							hora : '[time]'							
						  }
						});
						$grid.isotope({ sortBy : 'fecha' });
						
						$('.button-group').each( function( i, buttonGroup ) {
						  var $buttonGroup = $( buttonGroup );
						  $buttonGroup.find('.is-checked').removeClass('is-checked');							
						});
						$( '#filters' ).find('.todos').addClass('is-checked');	
						$( '#ords' ).find('.fecha').addClass('is-checked');
						$( '#ords' ).find('.ascendente').addClass('is-checked');
						$( '#ords' ).find('.juntas').addClass('is-checked');
						$("#ex2").slider('setValue', 1000);	
						$('#titulo').addClass('none');	
						$('#titulo').children().text("");					
                    }, 500);
					$(window).on('load', function() { 
						$grid.isotope({ sortBy : 'fecha' });
					});
                    //alert(response);
					$('html, body').animate({
                        scrollTop: $('#buscador').offset().top
                    },1000);
                }
            });
        }
		
		function asc(){
			$grid = $('.resultado-listado__contenedor').isotope({
			  sortAscending : true
			});
		}
		
		function des(){
			$grid = $('.resultado-listado__contenedor').isotope({
			  sortAscending : false
			});
		}
		
		function juntas(){
			$grid = $('.resultado-listado__contenedor').isotope({
			  layoutMode: 'masonry'
			});
		}
		
		function separadas(){
			$grid = $('.resultado-listado__contenedor').isotope({
			  layoutMode: 'fitRows'
			});
		}


        /*function newCategory(c) {
            //alert(c);
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {newcategory: c},
                success: function(response) {
                    $("#works").html(response);
					window.setTimeout(function (){$('.resultado-listado__contenedor').masonry( 'destroy' );	
					$('.resultado-listado__contenedor').masonry({
					  percentPosition: true
					}); }, 100);
                    //alert(response);
                }
            });
        }*/

        function misEventos(u) {
            //alert(u);
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {usr: u},
                success: function(response) {
                    //alert(response);
                    $("#works").html(response);
					$("#filtss").removeClass("hide");
					$("#buscador").removeClass("hide");
                    $("#cerra").removeClass("open");
                    $('.dropdown-backdrop').remove();					
					window.setTimeout(function (){
						$grid.isotope('destroy');
						$grid = $('.resultado-listado__contenedor').isotope({
						  itemSelector: '.element-item',
						  //layoutMode: 'fitRows',					  
						  getSortData: {
							  fecha : '[data-time]',
							precio: '.precio parseInt',
							hora : '[time]'
							
						  }
						});
						$grid.isotope({ sortBy : 'fecha' });
						
						$('.button-group').each( function( i, buttonGroup ) {
						  var $buttonGroup = $( buttonGroup );
						  $buttonGroup.find('.is-checked').removeClass('is-checked');							
						});
						$( '#filters' ).find('.todos').addClass('is-checked');	
						$( '#ords' ).find('.fecha').addClass('is-checked');
						$( '#ords' ).find('.ascendente').addClass('is-checked');
						$( '#ords' ).find('.juntas').addClass('is-checked');
						$("#ex2").slider('setValue', 1000);	
						$('#titulo').addClass('none');	
						$('#titulo').children().text("Mis Eventos");
						$('#titulo').removeClass('none');				
                    }, 700);
					$('html, body').animate({
                        scrollTop: $('#buscador').offset().top
                    },1000);
                }
            });
        }

        function aprobarEventos() {
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {aprobar: ''},
                success: function(response) {
                    //alert(response);
                    $("#works").html(response);
					$("#filtss").removeClass("hide");
					$("#buscador").removeClass("hide");
                    $("#cerra").removeClass("open");
                    $('.dropdown-backdrop').remove();
					window.setTimeout(function (){
						$grid.isotope('destroy');
						$grid = $('.resultado-listado__contenedor').isotope({
						  itemSelector: '.element-item',
						  //layoutMode: 'fitRows',					  
						  getSortData: {
							  fecha : '[data-time]',
							precio: '.precio parseInt',
							hora : '[time]'
							
						  }
						});
						$grid.isotope({ sortBy : 'fecha' });
						
						$('.button-group').each( function( i, buttonGroup ) {
						  var $buttonGroup = $( buttonGroup );
						  $buttonGroup.find('.is-checked').removeClass('is-checked');							
						});
						$( '#filters' ).find('.todos').addClass('is-checked');	
						$( '#ords' ).find('.fecha').addClass('is-checked');
						$( '#ords' ).find('.ascendente').addClass('is-checked');
						$( '#ords' ).find('.juntas').addClass('is-checked');
						$("#ex2").slider('setValue', 1000);		
						$('#titulo').addClass('none');	
						$('#titulo').children().text("Aprobar Eventos");
						$('#titulo').removeClass('none');			
                    }, 700);
					$('html, body').animate({
                        scrollTop: $('#buscador').offset().top
                    },1000);
                }
            });
        }

        function aprueba(id, c, s) {
            //alert($(c).parent().parent().parent().html());
            $.post( "php/validar.php", {aprobar : id, status : s} )
                .done(function( data ) {
                    //$(c).parents('.rectifica-columna').remove();
					$grid.isotope( 'remove', $(c).parents('.rectifica-columna') ).isotope('layout');
                });
        }

        function eliminar(id, c) {
			//alert($(c).parents('.rectifica-columna').remove());
            $.post( "php/validar.php", {eliminar : id} )
                .done(function( data ) {
                    //$(c).parents('.rectifica-columna').remove();
					$grid.isotope( 'remove', $(c).parents('.rectifica-columna') ).isotope('layout');
                });
        }

        function administrarEventos() {
            //alert(u);
            $.ajax({
                url: 'php/cargar.php',
                type: 'post',
                data: {admin: ''},
                success: function(response) {
                    //alert(response);
                    $("#works").html(response);
					$("#filtss").removeClass("hide");
					$("#buscador").removeClass("hide");
                    $("#cerra").removeClass("open");
                    $('.dropdown-backdrop').remove();
					window.setTimeout(function (){
						$grid.isotope('destroy');
						$grid = $('.resultado-listado__contenedor').isotope({
						  itemSelector: '.element-item',
						  //layoutMode: 'fitRows',					  
						  getSortData: {
							  fecha : '[data-time]',
							precio: '.precio parseInt',
							hora : '[time]'
							
						  }
						});
						$grid.isotope({ sortBy : 'fecha' });
						
						$('.button-group').each( function( i, buttonGroup ) {
						  var $buttonGroup = $( buttonGroup );
						  $buttonGroup.find('.is-checked').removeClass('is-checked');							
						});
						$( '#filters' ).find('.todos').addClass('is-checked');	
						$( '#ords' ).find('.fecha').addClass('is-checked');
						$( '#ords' ).find('.ascendente').addClass('is-checked');
						$( '#ords' ).find('.juntas').addClass('is-checked');
						$("#ex2").slider('setValue', 1000);
						$('#titulo').addClass('none');	
						$('#titulo').children().text("Administrar Eventos");
						$('#titulo').removeClass('none');					
                    }, 700);
					$('html, body').animate({
                        scrollTop: $('#buscador').offset().top
                    },1000);
                }
            });
        }
		
		