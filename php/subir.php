<?php
include("conectar.php");
$con = conectar();
?>
<h1 class="text-center">Crear Evento <span></span></h1>
<form id="formuedith" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div id="big-form" class="well auth-box">
                <!-- Form Name -->
                <legend>Datos del evento</legend>

                <div class="control-group">
                    <label class="control-label" for="input">Título del evento</label>
                    <div class="controls">
                        <input name="a1" type="text" placeholder="Título del evento"  class="form-control">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="select">Ciudad</label>
                    <div class="controls">
                        <!--<input name="a2" type="text" placeholder="Ciudad"  class="form-control">
                        <p class="help-block"></p>-->
                        <select name="a2" data-placeholder="Ciudad" class="form-control chosen-select"  tabindex="8">
                            <option value=""></option>
                            <?php
                            $resultado = $con->query('SELECT nom_mun FROM municipio');
                            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                if($row["nom_mun"] == "Cuernavaca"){
                                    echo "<option value='".$row["nom_mun"]."' selected>" . $row["nom_mun"] . "</option>";
                                }else{
                                    echo "<option value='".$row["nom_mun"]."'>" . $row["nom_mun"] . "</option>";
                                }

                            }
                            ?>
                        </select>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="input">Lugar</label>
                    <div class="controls">
                        <input name="a3" type="text" placeholder="Lugar"  class="form-control">
                        <p class="help-block">Ej. Teatro Ocampo</p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="input">Fecha</label>
                    <div class="controls input-group datepic">
                        <input name="a4" type="text" class="form-control" placeholder="yyyy-mm-dd">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>

                    </div>
                    <p class="help-block"></p>
                </div>

                <div class="control-group">
                    <label class="control-label" for="input">Hora Inicio</label>
                    <div class="controls input-group clockpicker">
                        <input name="a5" type="text" class="form-control" placeholder="24h format">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </div>

                    </div>
                    <p class="help-block"></p>
                </div>

                <div class="control-group">
                    <label class="control-label" for="input">Hora Fin</label>
                    <div class="controls input-group clockpicker">
                        <input name="a6" type="text" class="form-control" placeholder="24h format">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </div>

                    </div>
                    <p class="help-block">Puede no haber hora de fin</p>
                </div>

            </div>
            <div class="clearfix">
            </div>
        </div>

        <div class="col-md-6">
            <div id="big-form" class="well auth-box">
                <legend>Descripción del evento</legend>

                <div class="control-group">
                    <label class="control-label" for="select">Categoría</label>
                    <div class="controls">
                        <select id="b1" name="b1" data-placeholder="Categoria" class="form-control chosen-select"  tabindex="8">
                            <option value=""></option>
                            <option value="musica">Música</option>
                            <option value="cultural">Cultural</option>
                            <option value="deportes">Deportes</option>
                            <option value="universitarios">Universitarios</option>
                            <option value="negocios">Negocios</option>
                            <option value="otros">Otros</option>
                        </select>
                        <p class="help-block">Ej. Deportes, Cultural, Música</p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="input">Precio</label>
                    <div class="controls">
                        <input name="b2" type="number" placeholder="0" value="0" class="form-control">
                        <p class="help-block">0 se mostrará como entrada libre</p>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="control-group">
                    <label class="control-label" for="textarea">Descripción Corta</label>
                    <div class="controls">
                        <textarea id="textarea" name="b3" class="form-control"></textarea>
                    </div>
                    <p class="help-block"></p>
                </div>

                <div class="control-group">
                    <label class="control-label" for="textarea">Descripción Completa</label>
                    <div class="controls">
                        <textarea id="textarea" name="b4" class="form-control"></textarea>
                    </div>
                    <p class="help-block"></p>
                </div>

                <!-- File Button -->
                <div class="control-group">
                    <label class="control-label" for="filebutton">Foto de portada</label>
                    <div class="controls">
                        <input id="file" name="f1" class="input-file" type="file" onchange="imag(this)">
                        <div class="prev">
                        </div>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="control-group">
                    <label class="control-label" for="button1id"></label>
                    <div class="controls">
                        <button id="button1id" name="button1id" onClick="subir()" class="btn btn-success">Subir</button>
                        <button id="button2id" name="button2id" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        $('.datepic input').datepicker({
            format: "yyyy-mm-dd",
            startDate: "today",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
        $("#button1id").click(function(e){
            e.preventDefault();
        });
        $("#button2id").click(function(e){
            e.preventDefault();
            location.reload();
        });
        $('.control-group').on('focus', 'input.red', function(){
            $(this).removeClass('red');
        });
        $('.control-group').on('click', 'span.red2', function(){
            $(this).removeClass('red2');
        });
		$('button').prop('disabled', false);
    });

    function subir(){
        var formData = new FormData($('#formuedith')[0]);
        var ruta = 'php/validar.php';
        var validado = true;
        if (formData.get("a1") == ""){
            $('input[name=a1]').addClass("red");
            validado = false;
        }
        if (formData.get("a3") == ""){
            $('input[name=a3]').addClass("red");
            validado = false;
        }
        if (formData.get("a4") == ""){
            $('input[name=a4]').addClass("red");
            validado = false;
        }
        if (formData.get("a5") == ""){
            $('input[name=a5]').addClass("red");
            validado = false;
        }
        if (formData.get("b1") == ""){
            //alert("Error en la categoria");
            $('#b1_chosen').children().children().addClass("red2");
            validado = false;
        }
        if (formData.get("b2") < 0 || formData.get("b2") == ""){
            //alert("Error en el precio");
            $('input[name=b2]').addClass("red");
            validado = false;
        }
        if ($('input[name=f1]').val() == ""){
            //alert("Error en la imagen");
            $('input[name=f1]').addClass("red2");
            validado = false;
        }
        if(validado){
			$('button').prop('disabled', true);
            $.ajax({
                url: ruta,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                    //alert(datos);
                    location.reload();					
                }
            });
        }else{
            //alert(formData.get("f1")['name']);
            alert("Verificar los datos");
        }
    }
</script>