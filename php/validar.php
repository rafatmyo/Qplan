<?php
SESSION_START();
include("conectar.php");
$con = conectar();

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

function eliminarDir($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        echo $archivos_carpeta;

        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
}


if(isset($_REQUEST['aprobar'])) {
    $status = $_REQUEST['status'];
    $sql = $con->prepare("UPDATE eventos SET estatus='$status' WHERE ideventos=:x");
    $sql->bindParam(":x", $_REQUEST['aprobar']);
    $sql->execute();
}

if(isset($_REQUEST['eliminar'])) {
    $user = $_SESSION['user'];
    $carpeta = '../images/'.$user.'/'.$_REQUEST['eliminar'];
    eliminarDir($carpeta);
    $sql = $con->prepare("DELETE FROM eventos WHERE ideventos=:x");
    $sql->bindParam(":x", $_REQUEST['eliminar']);
    $sql->execute();
}

if(isset($_SESSION['user']) && isset($_REQUEST['a1'])) {
    $user = $_SESSION['user'];

    $res = $con->query('SELECT max(ideventos)+1 as num FROM eventos');
    $row = $res->fetch(PDO::FETCH_ASSOC);
    if ($row['num'] == ""){
        $id = 0;
    }else{
        $id = $row['num'];
    }

    //crear la carpeta
    $carpeta = '../images/'.$user.'/'.$id;
    mkdir($carpeta);
    $file = $_FILES['f1'];
    $ruta_temp = $file['tmp_name'];
    //Mover imagen a la carpeta
    move_uploaded_file($ruta_temp, $carpeta.'/'.$file['name']);
    $img0 = resize_image($carpeta.'/'.$file['name'], 854, 554);
    //Reemplazar imagen con nuevas dimensiones
    imagejpeg($img0, $carpeta.'/'.$file['name']);
    // Liberar memoria
    imagedestroy($img0);
    
    $img = 'images/'.$user.'/'.$id.'/'.$file['name'];
    $sql = $con->prepare("INSERT INTO eventos (ideventos, titulo, precio, descripcionCorta, descripcion, ciudad, lugar, fecha, horaInicio, horaFin, categoria, img, estatus, idusuario) VALUES ('$id',?,?,?,?,?,?,?,?,?,?,'$img','0','$user')");
    $sql->bindParam(1, $_REQUEST['a1']);
    $sql->bindParam(2, $_REQUEST['b2']);
    $sql->bindParam(3, $_REQUEST['b3']);
    $sql->bindParam(4, $_REQUEST['b4']);
    $sql->bindParam(5, $_REQUEST['a2']);
    $sql->bindParam(6, $_REQUEST['a3']);
    $sql->bindParam(7, $_REQUEST['a4']);
    $sql->bindParam(8, $_REQUEST['a5']);
    $sql->bindParam(9, $_REQUEST['a6']);
    $sql->bindParam(10, $_REQUEST['b1']);
    //echo $sql->queryString;
    $sql->execute();
    /*echo $_REQUEST['a1'].PHP_EOL;
    echo $_REQUEST['a2'].PHP_EOL;
    echo $_REQUEST['a3'].PHP_EOL;
    echo $_REQUEST['a4'].PHP_EOL;
    echo $_REQUEST['a5'].PHP_EOL;
    echo $_REQUEST['a6'].PHP_EOL;
    echo $_REQUEST['b1'].PHP_EOL;
    echo $_REQUEST['b2'].PHP_EOL;
    echo $_REQUEST['b3'].PHP_EOL;
    echo $_REQUEST['b4'].PHP_EOL;
    echo $img.PHP_EOL;*/
}
$con = null;