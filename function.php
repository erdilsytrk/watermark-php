<?php
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




// Memory limit option
ini_set('memory_limit', '128M');

// what a lovely function :))
function watermark($image,$logo,$location,$position,$customvariable){
    // location
    $loc = $location;
    // define maxsize for files i.e 10MB
    $maxsize = 10 * 1024 * 1024;
    // allowed types
    $allowed_types = array('jpg', 'png', 'jpeg');
    // center, top-left, top-right, bottom-left, bottom-right, bottom, top
    $pos = $position;
    // custom variable, you can use it according to your specific needs. i.e id for SQL
    $id = $customvariable;
    // mysql connection. Activate here and go LINE 145-153 notice: include sql config file
    $sql = "";
    //$sql = "INSERT INTO images(names,id)";

    // array uploaded
    $uploaded = array();

    // image name, tmp_name, size variables
    $imgname = $image["name"];
    $imgtmp  = $image["tmp_name"];
    $imgsize = $image["size"];

    // logo name, tmp_name, size variables
    $logoname = $logo["name"];
    $logotmp  = $logo["tmp_name"];
    $logosize = $logo["size"];

    // Checks if user sent an empty form
    if(!empty(array_filter($imgname)) && !empty($logoname)){

        // logo upload for imagecreate process
        if(file_exists($loc.$logoname)){
            $logoname = time().$logoname;
            $logotmp = move_uploaded_file($logotmp,$loc.$logoname);
        }else{
            $logotmp = move_uploaded_file($logotmp,$loc.$logoname);
        }
        
        // allowed logo file type
        $logotype = explode('.', $logoname);
        $logotype = end($logotype);
        if($logotype == "jpeg" || $logotype == "jpg"){ $logocreate = imagecreatefromjpeg($loc.$logoname); }
        if($logotype == "png"){ $logocreate = imagecreatefrompng($loc.$logoname); }

        // Loop all images
        foreach ($imgtmp as $key => $value){
            $imgname = $image["name"][$key];
            $imgtmp  = $image["tmp_name"][$key];
            $imgsize = $image["size"][$key];
            $img_ext = pathinfo($imgname, PATHINFO_EXTENSION);

            // Check file type is allowed
            if(in_array(strtolower($img_ext), $allowed_types)){
                // Verify image size
                if($imgsize > $maxsize){
                    echo "Image size not supported.";
                }else{

                    // if file name already exist
                    if(file_exists($loc.$imgname)){
                        $imgname = time().$imgname;
                        if(move_uploaded_file($imgtmp,$loc.$imgname)){
                            $send   = process($loc,$imgname,$logocreate,$pos,$id,$sql);
                            array_push($uploaded, "$imgname");
                        }else {                    
                            echo "Error {$imgname} <br />";
                        }
                    }else{
                        if(move_uploaded_file($imgtmp,$loc.$imgname)){
                            $send   = process($loc,$imgname,$logocreate,$pos,$id,$sql);
                            array_push($uploaded, "$imgname");
                        }else {                    
                            echo "Error {$imgname} <br />";
                        }
                    }
                }
            }else {
                 
                // If file extension not valid
                echo "Error {$imgname} ";
                echo "({$img_ext} type not supported)<br / >";
            }

        }
        // Remove logo
        unlink($loc.$logoname);
        return $uploaded;
    }else {                    
        echo "No files selected!";
    }
}

function process($getloc, $getimgname, $getlogocreate, $position, $getid, $getsql){
    $loc        = $getloc;
    $imgname    = $getimgname;
    $logocreate = $getlogocreate;
    $pos        = $position;
    $id         = $getid;
    $sql        = $getsql;
    $imgtype    = explode('.', $imgname);
    $imgtype    = end($imgtype);

    // image file type
    if($imgtype  == "jpeg" || $imgtype == "jpg"){ $imagecreate = imagecreatefromjpeg($loc.$imgname); }
    if($imgtype  == "png"){ $imagecreate = imagecreatefrompng($loc.$imgname); }


    // get image and logo width-height
    $imageWidth  = imagesx($imagecreate);
    $imageHeight = imagesy($imagecreate);
    $logoWidth   = imagesx($logocreate);
    $logoHeight  = imagesy($logocreate);


    // position options
    switch ($pos){
        case 'center': $pos1 = ($imageWidth-$logoWidth)/2; $pos2 = ($imageHeight-$logoHeight)/2; break;
        case 'top-left': $pos1 = 10; $pos2 = 10; break;
        case 'top-right': $pos1 = ($imageWidth-$logoWidth); $pos2 = 10; break;
        case 'bottom-right': $pos1 = ($imageWidth-$logoWidth); $pos2 = ($imageHeight-$logoHeight); break;
        case 'bottom-left': $pos1 = 10; $pos2 = ($imageHeight-$logoHeight); break;
        case 'top': $pos1 = ($imageWidth-$logoWidth)/2; $pos2 = 10; break;
        case 'bottom': $pos1 = ($imageWidth-$logoWidth)/2; $pos2 = ($imageHeight-$logoHeight); break;
        default: $pos1 = ($imageWidth-$logoWidth)/2; $pos2 = ($imageHeight-$logoHeight)/2; break;

    }

    imagecopy(
        // destination
        $imagecreate, 
        // source
        $logocreate, 
        // destination x and y
        $pos1, $pos2,
        //10, ($imageHeight-$logoHeight), sol alt
        // source x and y
        0, 0,
        // width and height of the area of the source to copy
        $logoWidth, $logoHeight);
                                
    // Set type of image and save
    imagePng($imagecreate, $loc.$imgname);

    /*
    $sql .=  " VALUES ('$imgname','$id')";
    if (mysqli_query($conn, $sql)) {
        //success 
        echo "{$imgname} SQL Upload Success! <br />";
    }else{
        // error
        echo "Error {$imgname} ";
    }*/

    // Release memory and remove logo
    imageDestroy($imagecreate);
    imageDestroy($logocreate);
                                
    //success 
    echo "{$imgname} Upload Success! <br />";
    

}

?>