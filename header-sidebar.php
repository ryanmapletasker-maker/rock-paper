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
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   // DONT DISPLAY FOR PREVIEW
   if(isset($_GET['ppt_live_preview'])){ return ""; } 
   
   global $CORE, $userdata; 
   
   	// LANGUAGES
	$languages =  $CORE->GEO("get_languagelist",array()); 
   
   
    ?>

<div class="sidebar-content"> <a href="<?php echo home_url(); ?>" class="sidebar-logo btn-block mt-4"> <?php echo str_replace("-primary","-light",$CORE->LAYOUT("get_logo","light"));  ?> </a>
  <div class="sidebar-heading text-center  mt-4">
    <button class="navbar-toggler menu-toggle">
    <div class="fal fa-bars text-light">&nbsp;</div>
    </button>
    <hr>
  </div>
  <?php echo do_shortcode('[MAINMENU class="navbar-nav" mobile=1]');  ?>
  <hr />
  <?php if(!$userdata->ID){ ?>
  <a class="btn btn-light btn-md btn-block" href="<?php echo wp_login_url(); ?>"><?php echo __("Sign In","premiumpress"); ?></a>
  <?php if(get_option('users_can_register') == 1){ ?>
  <a class="btn btn-outline-light btn-md btn-block mt-4" href="<?php echo wp_registration_url(); ?>"><?php echo __("Register","premiumpress"); ?></a>
  <?php } ?>
  <?php }else{ ?>
  <a class="btn btn-light btn-md btn-block" href="<?php echo _ppt(array('links','myaccount')); ?>"> <?php echo __("My Account","premiumpress"); ?></a> <a href="<?php echo wp_logout_url(); ?>" class="btn btn-outline-light btn-md btn-block mt-4"><i class="fa fa-sign-out"></i> <?php echo __("Logout","premiumpress"); ?></a>
  <?php } ?>
  <?php if(is_array($languages) && !empty($languages)){ ?>
  <hr />
  <select class="form-control w-100" id="mobilelangselect">
  <option><?php echo __("Language","premiumpress"); ?></option>
    <?php foreach($languages as $h){ ?>
    <option value="<?php echo $h['link']; ?>"><?php echo $h['name']; ?></option>
    <?php } ?>
  </select>
  <script>
		 
		 jQuery(function () {
			 
			jQuery("#mobilelangselect").change(function () {
				location.href = jQuery(this).val();
			})
		})
		 </script>
  <?php } ?>
</div>