<?php
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

if(isset($_FILES['f1'])){
    $file = $_FILES['f1'];
    if($file['tmp_name']!=''){
        $nombre = $file['name'];
        $tipo = $file['type'];
        $size = $file['size'];
        $ruta_temp = $file['tmp_name'];
        $dimensiones = getimagesize($ruta_temp);
        //echo $dimensiones[0]." x ".$dimensiones[1];
        $width = $dimensiones[0];
        $height = $dimensiones[1];
        $carpeta = '../images/tmp/';
        $carpeta2 = 'images/tmp/';

        if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
            echo 'El archivo no es una imagen';
        }
        else if($size > (1024*1024*5)){
            echo 'El tamaño maximo es 5MB';
        }else if($width > 2500 && $width < 200 && $height > 1300 && $height < 200){
            echo 'Error con las dimensiones de la imagen';
        }else{
            $src = $carpeta.$nombre;
            $src2 = $carpeta2.$nombre;
            //chmod("C:\\wamp64\\tmp\\", 0777);
            move_uploaded_file($ruta_temp, $src);
            $img = resize_image($src, 854, 554);
            //echo gettype($img);
            imagejpeg($img, $src);
            // Liberar memoria
            imagedestroy($img);
            echo "<img src='$src2' width='300'>";
            //echo $nombre.$tipo;
        }
    }
}else{
    echo "No se recibio f1";
}