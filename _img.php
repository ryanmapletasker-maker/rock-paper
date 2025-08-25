<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
 
global $CORE, $userdata, $settings;

 	$te = explode("wp-content",$_SERVER['SCRIPT_FILENAME']);
	$SERVER_PATH_HERE = $te[0];
	
	if(file_exists($SERVER_PATH_HERE.'/wp-config.php')){
				 
		require( $SERVER_PATH_HERE.'/wp-config.php' );
	
	}else{
	
		die('<h1>Server Path Incorrect</h1>
		<p>The script could not generate the correct server path to your invoice file.</p>
		<p>Please edit the file below and manually set the correct server path.</p>
		<p>'.$_SERVER['SCRIPT_FILENAME'].'</p>');
	
	}
	
	if(!isset($_GET['pid']) && !is_numeric($_GET['pid']) && !isset($_GET['aid']) && !is_numeric($_GET['aid']) ){
	
	die("who are you?");
	
	}


$path = "";

$g = get_post_meta($_GET['pid'], 'image_array', true);

// GET FILE PATH FROM ARRAY
if(is_array($g)){

	foreach($g as $file){
	
		if($file['id'] == $_GET['aid']){
			 
			$path = $file['filepath'];	
			$type = $file['type'];
		
		}	
	}

}

// NO IMAGE FOUND
if($path == ""){
	die("whopps, I dont know you..");
}

// GET SIZES
$default_size = $CORE->MEDIA_SIZES();

// DEFAULTS
$constrain = 0; 
if(isset($_GET['constrain'])){
$constrain = 1;
}

$perc = 0;
if(isset($_GET['percent'])){
$perc = 1;
}

$w = $default_size['w'];
if(isset($_GET['w']) && is_numeric($_GET['w']) ){
$w = $_GET['w'];
}

$h = $default_size['h'];
if(isset($_GET['h']) && is_numeric($_GET['h']) ){
$h = $_GET['h'];
}
 
$canvus_w = $w;
$canvus_h = $h; 

// get image size of img
$x = getimagesize($path); 
if($type == ""){
	$type = 'image/jpeg';
}

// image width
$sw = $x[0];

// image height
$sh = $x[1];

if ($percent > 0) {

    // calculate resized height and width if percent is defined
    $percent = $percent * 0.01;
    $w = $sw * $percent;
    $h = $sh * $percent;
	
} else {

    if (isset ($w) AND !isset ($h)) {
        // autocompute height if only width is set
        $h = (100 / ($sw / $w)) * .01;
        $h = @round($sh * $h);
    } elseif (isset ($h) AND !isset ($w)) {
        // autocompute width if only height is set
        $w = (100 / ($sh / $h)) * .01;
        $w = @round($sw * $w);
    } elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
        // get the smaller resulting image dimension if both height
        // and width are set and $constrain is also set
        $hx = (100 / ($sw / $w)) * .01;
        $hx = @round($sh * $hx);

        $wx = (100 / ($sh / $h)) * .01;
        $wx = @round($sw * $wx);

        if ($hx < $h) {
            $h = (100 / ($sw / $w)) * .01;
            $h = @round($sh * $h);
        } else {
            $w = (100 / ($sh / $h)) * .01;
            $w = @round($sw * $w);
        }
    }
}


// CENTER AND FIX IMAGE
$crop_w     =   0;
$crop_h     =   0; 

$new_w = 0;
$new_h = 0; 


if(isset($_GET['fix']) ){ 	
	
	

	$scale1 = round($canvus_h/$h); 
	$scale2 = round($canvus_w/$w); 
	
	
	// IF THE ORGINAL IS THE SAME
	// AS THE CANVUS
	
	if($sw == $canvus_h){
		
		$new_w = 0;
		$new_h = 0;
		$h = $canvus_h * 103 / 100; //120 zoom will increase the image by 20%
		$w = $canvus_w * 100 / 100; //120 zoom will increase the image by 20%
		
		
	}else{
	
			// CENTERS IMAGE
			if( ($canvus_w / $canvus_h) < ($w/$h) ){ // NEEDS ZOOM	
			
				$scale = $w/$canvus_w;
				$new_w = 0;
				$new_h = - ($scale * $h - $canvus_h) / 2;
			
			}else{ // DOESNT NEED ZOOM
			
				$scale = $h/$canvus_h;
				$new_w = - ($scale * $w - $canvus_w) / 2;
				$new_h = 0;	
			}
			
			// ZOOM IMAGE
			
			if( ($canvus_w / $canvus_h) < ($w/$h) ){ // NEEDS ZOOM	
			
				
			
			}else{
			
				
			}
			
			/*
			$new_h = 0;
				$new_w = 0;
				
				$w = $canvus_w * 100 / 100; //120 zoom will increase the image by 20%
				$h = $canvus_h * 165 / 100; //120 zoom will increase the image by 20%
				*/
			
	
	}
	
}else{

	$canvus_w = $w;
	$canvus_h = $h;

}
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
 
// BUILD CANVUS
switch($type){
	case "image/jpeg": {
		$im = imagecreatefromjpeg($path); //jpeg file
	   } break;
	case "image/gif": {
		$im = imagecreatefromgif($path); //gif file
	   } break;
	case "image/png": {
		$im = imagecreatefrompng($path); //png file
	   } break;
	default: {
	 $im=false;
	} break;
} 

if (!$im) {

    // We get errors from PHP's ImageCreate functions...
    // So let's echo back the contents of the actual image.
	header('Content-Type:'.$type);
    header('Content-Length: ' . filesize($path));
    readfile($path);
	die();
	
} else {

    // CREATE CANVUS
    $thumb = imagecreatetruecolor($canvus_w, $canvus_h);	
	
	// WHITE BACKGROUND
	$g = _ppt(array('lst', 'default_crop_bg'));
	if($g == 1){ }else{
	imagefill($thumb, 0, 0, imagecolorallocate($thumb, 255, 255, 255));  // white background;
	}		

 	//die($new_w." -- ". $new_h." -- ".$crop_w." -- ".$crop_h." -- (". $w." -- ". $h.") -- (". $sw." -- ". $sh.") ");
    // Copy from image source, resize it, and paste to image destination
    imagecopyresampled($thumb, $im, 
	$new_w, // a
	$new_h, // b
	$crop_w, // c
	$crop_h, // d
	 $w, // e
	 $h, // f
	 $sw, // g
	 $sh // h
	 );
	 
	 /*
	 a,b - start pasting the new image into the top-left of the destination image
c,d - start sucking pixels out of the original image at 200,134
e,f - make the resized image 75x75 (fill up the thumbnail)
g,h - stop copying pixels at 600x402 in the original image
	 */
 
    header("Content-type: image/jpeg");
    imagejpeg( $thumb, null, 99);
    die();
}

?>