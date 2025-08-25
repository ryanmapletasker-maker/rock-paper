<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } 

//die(print_r(_ppt_elementor_defaultvalue('title_show')));

 
global $CORE;
	
	$GLOBALS['flag-home'] = 1;	
	 
	$pageLinkingID = _ppt_pagelinking("homepage");	
	 
 	if( substr($pageLinkingID ,0,9) == "elementor" && !isset($_GET['design']) ){ 
		 
		 
		// CHECK ELMENTOR CANVUS		
		if(get_post_meta(substr($pageLinkingID,10,100), "_wp_page_template", true) != "elementor_header_footer"){		
			define('NOHEADERFOOTER', 1);		
		}		
			 	
		get_header(); 	
		
		echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");	
			
		get_footer();
		
	}else{
 
 
 		if(_ppt(array('design','slot1_style')) == "elementor" && defined('ELEMENTOR_VERSION') && isset($_SESSION['design_preview']) && strlen($_SESSION['design_preview']) > 1){ // CHILD THEME PREVIEWS
		 
			_ppt_template( 'home', 'elementor' ); 		
		
		}elseif(!_ppt_checkfile("home.php")){
		 
 			
			get_header(); 
		 	  
			if( ( ( _ppt(array('design','slot1_style')) == "" && _ppt(array('design','slot2_style')) == "" ) || _ppt(array('design','slot1_style')) == "elementor") &&  strlen(_ppt(array('pageassign','homepage'))) < 3){
			
			_ppt_template( 'home', 'demo' ); 
			 
		 	}else{
			 	 
			_ppt_template( 'home', '1' ); 
			_ppt_template( 'home', '2' );
			_ppt_template( 'home', '3' );
			_ppt_template( 'home', '4' );
			_ppt_template( 'home', '5' );
			_ppt_template( 'home', '6' );
			_ppt_template( 'home', '7' );
			_ppt_template( 'home', '8' );
			_ppt_template( 'home', '9' ); 
			
			}
			
			get_footer();	
			 
		} 

	}
 
?>