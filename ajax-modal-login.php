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

global $CORE;


if(!_ppt_checkfile("ajax-modal-login.php")){
?>

<div class="text-center py-3">
  <h1 class="h2"><?php echo __("Member Login","premiumpress") ?></h1>
  <?php if(get_option('users_can_register') == 1 ){  ?>
  <p class="text-muted my-3 col-md-10 mx-auto"><?php echo __("Not yet a member?","premiumpress"); ?> <a <?php if(isset($GLOBALS['flag-login']) || _ppt(array('mem','register')) == 1){ ?>href="<?php echo wp_registration_url(); ?>&membership=-1"<?php }else{ ?>href="javascript:void(0)" onclick="processRegister();"<?php } ?> class="text-primary"><u><?php echo __("sign-up here","premiumpress"); ?></u></a> </p>
  <?php } ?>
</div>
<div class="<?php if(isset($GLOBALS['flag-login'])){ ?>card shadow-sm<?php } ?>">
<div class="<?php if(isset($GLOBALS['flag-login'])){ ?>card-body p-lg-5<?php } ?>">
<?php if(defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false  ){ ?>
<div class="alert alert-success"><i class="fa fa-user-circle mr-2"></i> <strong>Username: demo  / Password : demo</strong></div>
<?php } ?>
<div id="login_form_message"></div>



<?php if(isset($_GET['checkemail'])){ ?>

<div class="alert alert-success"><i class="fa fa-envelope fa-3x mr-3 float-left"></i> <?php echo __("We have sent password recovery instructions to your email address.","premiumpress") ?></div>

<?php } ?>


<script>


function login_process(){ 

	var user_login 	= document.getElementById("user_login"); 					
	var user_pass 	= document.getElementById("user_pass");
					
	canContinue = true;
					 					
		if(user_login.value == '')
		{
				jQuery("#login_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");						
				user_login.style.border = 'thin solid red';
				canContinue = false;
		}
							
		if(user_pass.value == '')
		{
				jQuery("#login_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");
				user_pass.focus();
				user_pass.style.border = 'thin solid red';
				canContinue = false;
		}
 
  if(canContinue){
  
   var formd = jQuery("#form_user_login").serialize();
 
   jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	
		dataType: 'json',	
   		data: {
               action: "login_process", 
			   formdata: formd,			 
           },
           success: function(response) { 
		    	
				 if(response.status == "error"){				 
				 
				 	jQuery("#login_form_message").addClass('text-danger mb-4').html(response.msg);				 
				 
				 }else if(response.status == "func_mem"){				 	
					
					jQuery(".login-modal-wrap").fadeOut(400);
					processPayment(response.link, response.msg);				 				
				 
				 }else if(response.status == "reload"){
				 
				 	window.location.reload();				 
				 
				 }else if(response.status == "ok"){
					  
					window.location.href= response.link;
				 	
				 } 
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
  
  }
  
}


 
</script>
<form id="form_user_login" name="form_login" class="loginform ajax_modal" action="#" onsubmit="login_process(); return false; " method="post" >
  <div class="form-group position-relative">
    <input type="text" class="form-control" placeholder="<?php echo __("Email","premiumpress"); ?>" name="log" id="user_login"  value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; } elseif (defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false){ echo "demo"; } ?>" autocomplete="current-password">
    <i class="fal fa-envelope position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:20px;"; }else{ echo "right:20px;";  } ?> top:12px;"></i> </div>
  <div class="form-group position-relative">
    <input type="password" placeholder="<?php echo __("Password","premiumpress"); ?>" class="form-control" name="pwd" id="user_pass" value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; } elseif (defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false){ echo "demo"; } ?>" autocomplete="current-password">
    <i class="fal fa-lock position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:20px;"; }else{ echo "right:20px;";  } ?> top:12px;"></i>
    
    <i class="fa fa-eye position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:60px;"; }else{ echo "right:60px;";  } ?> top:12px;cursor:pointer;" onclick="TogglePass('user_pass');"></i>
    
    </div>
    
 
    
  <div class="form-group">
    <label class="custom-control custom-checkbox">
    <input type="checkbox" name="remember" class="custom-control-input" checked="">
    <div class="custom-control-label"><?php echo __("Remember","premiumpress"); ?></div>
    </label>
  </div>
  <?php do_action('login_form'); ?>
  <div class="form-group">
  
    <button type="submit" class="btn btn-block btn-primary py-3"><?php echo __("Sign in","premiumpress"); ?></button>
  </div>
  <input type="hidden" name="testcookie" value="1" />
  <input type="hidden"  name="rememberme" id="rememberme"  value="1" />
</form>
<?php if(  defined('WLT_DEMOMODE') || _ppt(array('register','sociallogin')) == 1 ){   ?>
<div class="divider-or"><span><?php echo __("Or","premiumpress"); ?></span></div>
<div class="row no-gutters">
  <?php 		 
		 
		 $providers = array( 
		 "Twitter" 		=> array("icon" => "fab fa-twitter"),
		 "Facebook" 	=> array("icon" => "fab fa-facebook-f"),
		 "Google"  		=> array("icon" => "fab fa-google"), 
		 "LinkedIn"  	=> array("icon" => "fab fa-linkedin"),
		 ); 		 
		 
		 foreach($providers as $key => $hh ){ if(defined('WLT_DEMOMODE') || _ppt('social_'.strtolower($key).'') == '1'){   ?>
  <div class="col-lg-6 pr-lg-1 mb-4"> <a class="btn btn-<?php echo strtolower($key); ?> btn-block text-white" 
            <?php if(defined('WLT_DEMOMODE')){ ?>
            href="javascript:void(0)" onclick="alert('Disabled in demo mode.');"
            <?php }else{ ?>
            href="<?php echo home_url(); ?>/wp-login.php?sociallogin=<?php echo $key; ?>"
            <?php } ?>
            
             rel="nofollow"> <i class="<?php echo $hh['icon']; ?>">&nbsp;</i> <?php echo $key; ?> <?php echo __("Login","premiumpress"); ?> </a> </div>
  <?php } } ?>
</div>
<?php }  ?>


<div class="text-center mt-4 mb-5 small"> <a href="<?php if(_ppt(array('links','password')) == ""){ echo wp_lostpassword_url(''); }else{ echo _ppt(array('links','password')); } ?>"><u><?php echo __("Lost password?","premiumpress"); ?></u></a> </div>

<?php if(defined('WLT_DEMOMODE') && isset($_GET['admindemo'])){  ?>
<script>
   jQuery(document).ready(function () {
       jQuery("form#loginform").submit();
   });
</script>
<?php } ?>
<?php } ?>