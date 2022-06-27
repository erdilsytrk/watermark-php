<!-- 
/*
 *	Watermark Function PHP
 *
 *	Flexible, configurable, SQL connectable, upload location selectable,
 *  watermark position selectable, multi-image processing PHP Watermark Function
 *
 *	author: Erdil Soyturk
 *	version: 1.0
 *	license: MIT - free to use, modify
 */    
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watermark by Erdil Soyturk</title>
    <style>
    form{
        background: lightblue;
        display: inline-block;
        padding: 30px;
        border-radius: 10px;
    }
    input[type="file"] {
        margin-bottom: 20px;
        cursor: pointer !Important;
    
    }
    input[type="file"]::-webkit-file-upload-button
    {
        background: white;
        color: black;
        border: 0;
        padding: 12px 25px;
        cursor: pointer;
        border-radius: 10px;
    }
    
    input[type="file"]::-ms-browse {
        border-radius: 10px;
        background: white;
        color: black;
        border: 0;
        padding: 12px 25px;
        cursor: pointer;
    }

    select[name=pos]{
        border: 0px;
        height: 30px;
        border-radius: 5px;
        
    }
    input[name=Upload]{
        margin-left: 45px;
        height: 30px;
        color: white;
        background: blue;
        border: 0px;
        border-radius: 5px;
        width: 70%;
        display: inline;
        margin-right: 0px;
    }
    </style>
</head>
<body>


<?php

include("function.php");

if(isset($_POST["Upload"])){

    //       function (Posted images    ,posted logo    ,folder loc  ,posted pos   , variable)
    $array = watermark($_FILES["images"],$_FILES["logo"],'./gallery/',$_POST["pos"],'example');
    // get uploaded images array, you can use for showing images
    print_r($array);
}

?>

<br>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <input type="file" name="logo"> <br>
    <select name="pos">
        <option value="center" selected>Center</option>
        <option value="top-left">Top Left</option>
        <option value="top-right">Top Right</option>
        <option value="bottom-left">Bottom Left</option>
        <option value="bottom-right">Bottom Right</option>
        <option value="bottom">Bottom</option>
        <option value="top">Top</option>
    </select>
    <input type="submit" name="Upload" value="Upload">
</form>
    

</body>
</html>