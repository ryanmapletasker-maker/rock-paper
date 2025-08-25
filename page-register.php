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

global $CORE, $errortext, $errorStyle, $userdata; 

	$GLOBALS['flag-register'] = 1;
	
	
	// + ADD IN CAPECHA
	function _hook_head(){
	?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php }
	
	if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){
	add_action('wp_head','_hook_head');
	} 
 
if(!_ppt_checkfile("page-register.php")){ ?>

<?php get_header(); ?>
<?php _ppt_template( 'page', 'top' ); ?>

<section class="section-60 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-6 mx-auto">
        <?php if( _ppt(array('mem','register'))  == '1' && !isset($_GET['membership']) && strlen($errortext) < 1 ){  ?>
        <?php _ppt_template( 'page-login-memberships' ); ?>
        <?php }else{ ?>
        <?php _ppt_template( 'ajax', 'modal-register' ); ?>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php _ppt_template( 'page', 'bottom' ); ?>
<?php get_footer(); ?>
<?php } ?>
