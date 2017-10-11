<?php	
	function conectar(){
        $DBH = new PDO("mysql:host=localhost;dbname=qplan;charset=UTF8", "root", "");
			return $DBH;
	}