<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Disculpa, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Disculpa, tu foto es demasiado larga.";
    $uploadOk = 0;
}
// Allow certain file formats
    if($imageFileType != "jpg" 
    && $imageFileType != "JPG" 
    && $imageFileType != "png" 
    && $imageFileType != "PNG" 
    && $imageFileType != "jpeg"
    && $imageFileType != "JPEG"
    && $imageFileType != "gif"
    && $imageFileType != "GIF"
    ) {
    echo "Disculpa, solo JPG, JPEG, PNG & GIF son permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Disculpa, tu foto no fue subida";
// if everything is ok, try to upload file
} else {
    if (
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "La imagen ". basename( $_FILES["fileToUpload"]["name"]). " se ha subido correctamente";

        
        $data = $_FILES["fileToUpload"]["name"];

        $inp = file_get_contents('dir.json');
        $tempArray = json_decode($inp);
        
        array_push($tempArray, $data);
        //echo $data;
        
        //echo json_encode($tempArray);
        $jsonData = json_encode($tempArray);
        file_put_contents('dir.json', $jsonData);
        // $rows = array();
        // while($r = mysqli_fetch_assoc($resultado)) {
        //     $rows[] = $r;
        // }
        print json_encode($_FILES["fileToUpload"]["name"]);
        //Convertir
        //Push
    } else {
        echo "Disculpa, hubo un error subiendo tu imagen.";
    }
}
?>