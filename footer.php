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

global $CORE, $userdata, $post; 


/*
	FOOTER ADVERTISING
*/
 
if( $CORE->ADVERTISING("check_exists","footer") && !isset($GLOBALS['flag-account']) ){ ?>

<section id="advertising_footer" class="bg-light border-top mobile-mb-4 mobile-pb-4">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center py-4"> <?php echo $CORE->ADVERTISING("get_banner","footer"); ?> </div>
    </div>
  </div>
</section>
<?php } ?>
<?php

if(isset($GLOBALS['flag-blankpage'])){

}else{

	_ppt_template( 'footer', 'menu' ); 
}

?>
</main>
</div>
 
<div id="page-loading" style="height:400px; text-align:center; padding-top:300px;"> <img src="<?php echo get_template_directory_uri(); ?>/framework/images/loading.svg" alt="loading page" /> </div>
<?php _ppt_template( 'footer', 'mobilemenu' );  ?>
<?php _ppt_template( 'footer', 'codes' );  ?>
</body></html>