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

if(!_ppt_checkfile("ajax-modal-register.php")){
?>

<div class="text-center py-3">
  <h1 class="h2"><?php echo __("New Member","premiumpress") ?></h1>
  <p class="text-muted my-3 col-md-10 mx-auto"><?php echo __("Already a member?","premiumpress"); ?> <a <?php if(isset($GLOBALS['flag-register'])){ ?>href="<?php echo wp_login_url(); ?>"<?php }else{ ?>href="javascript:void(0)" onclick="processLogin();"<?php } ?> class="text-primary modal-register-link"><u><?php echo __("login here","premiumpress"); ?></u></a> </p>
</div>
<div class="<?php if(isset($GLOBALS['flag-register'])){ ?>card shadow-sm<?php } ?>">
<div class="<?php if(isset($GLOBALS['flag-register'])){ ?>card-body p-lg-5<?php } ?>">
<div id="register_form_message"></div>
<script>

	
 
function register_process(){ 

					canContinue = true;
					
										
					
					
					<?php if(_ppt(array('register','username')) == 1){ ?>
					var username 	= document.getElementById("username");
					if(username.value == '')
					{
						jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");						
						fname.style.border = 'thin solid red';
						canContinue = false;
					}
					
					
					<?php } ?>
					
					
					<?php if(_ppt(array('register','hide_firstlast')) != 1){ ?>
					var fname 	= document.getElementById("user_fname"); 					
					var name 	= document.getElementById("user_lanme");  					
					if(fname.value == '')
					{
						jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");						
						fname.style.border = 'thin solid red';
						canContinue = false;
					}
							
					if(name.value == '')
					{
						jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");
						name.focus();
						name.style.border = 'thin solid red';
						canContinue = false;
					}
					<?php } ?>
					
					var email1 	= document.getElementById("user_email");
					
					if(email1.value == '')
					{
						jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");
						email1.focus();
						email1.style.border = 'thin solid red';
						canContinue = false;
					}
					if(!isValidEmail(email1.value))
					{
						jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Invalid email address.","premiumpress") ?>");						
						email1.focus();
						email1.style.border = 'thin solid red';
						canContinue = false;
					}
					
					<?php /* if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ }else{ ?>
					var code 	= document.getElementById("user_code"); 
					if(code.value == '')
					{
						alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
						code.focus();
						code.style.border = 'thin solid red';
						canContinue = false;
					}
					
					if(code.value !=  jQuery("#user_code").attr("data-codep")){
						
						alert('<?php echo __("Incorrect security code. Please try again.","premiumpress") ?>');
						code.focus();
						code.style.border = 'thin solid red';
						canContinue = false;
					
					}
					
					
				<?php }*/ ?>
				
				
				
	jQuery('.required').each(function(i, obj) {		
				 	
		if(jQuery(obj).val() == ""){			
			jQuery(obj).addClass('required-active').focus();	
			
			jQuery("#register_form_message").addClass('text-danger mb-4').html("<?php echo __("Please complete all required fields.","premiumpress") ?>");		
			canContinue = false;
		}		
	}); 
				
				
  if(canContinue){
  
   var formd = jQuery("#form_user_register").serialize();
   
   jQuery("#wp-submit-register").attr("disabled","disabled");
 
   jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	
		dataType: 'json',	
   		data: {
               action: "register_process", 
			   formdata: formd,			 
           },
           success: function(response) { 
		    
				 if(response.status == "error"){				 
				 
				 	jQuery("#register_form_message").addClass('text-danger mb-4').html(response.msg);
					
					jQuery("#wp-submit-register").attr("disabled", false);
				 
				 }else if(response.status == "func_mem"){				 	
					
					jQuery(".login-modal-wrap").fadeOut(400);
					
					processPayment(response.link, response.msg);
					
					jQuery("#wp-submit-register").attr("disabled", false);
					
					
				 }else if(response.status == "reload"){
				 
				 	window.location.reload();
				 
				 }else if(response.status == "ok"){
				 	
					<?php if(isset($_GET['membership']) && $_GET['membership'] == -1 && _ppt(array('mem','enable')) == 1){ ?>
					
					window.location.href= "<?php echo _ppt(array('links','memberships')); ?>";
					<?php }else{ ?>
					window.location.href= response.link;
					<?php } ?>
				 	
				 } 
   			
           },
           error: function(e) {
               console.log(e);
			   
			   jQuery("#wp-submit-register").attr("disabled", false);
           }
       });
	
	}
  
  
}


</script>
<form  id="form_user_register" class="registerform" name="registerform" action="#" onsubmit="register_process(); return false;"  method="post">
  <?php if(isset($_GET['redirect'])){ ?>
  <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_GET['redirect']); ?>" />
  <?php }elseif(isset($_GET['redirect_to']) && $_GET['redirect_to'] != ""){ ?>
  <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_GET['redirect_to']); ?>" />
  <?php } ?>
  <div class="row">
    <?php if(_ppt(array('register','username')) == 1){ ?>
    <div class="col-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="text" name="username" id="username"  tabindex="1" value="<?php if(isset($_POST['username'])){ echo esc_html(strip_tags($_POST['username'])); } ?>" class="form-control required" placeholder="<?php echo __("Username","premiumpress") ?>">
            <i class="fal fa-smile position-absolute" style="right:30px; top:12px;"></i> </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(in_array(THEME_KEY, array("pj","jb","ex")) && _ppt(array('register','loginswitch')) != "1" ){  ?>
    <div class="col-12 regswitch">
      <div class="btn-group btn-group-toggle btn-block mb-4 shadow-sm border" data-toggle="buttons" onclick="<?php if( THEME_KEY == "ex"){ ?>switchlabel();"<?php } ?>>
        <label class="btn rounded-0 active">
        <input type="radio" name="user_type" value="user_fr" autocomplete="off" checked>
        <span>
        <?php if(THEME_KEY == "ex"){ echo __("User","premiumpress"); }elseif(THEME_KEY == "jb"){ echo __("Job Seeker","premiumpress"); }else{ echo __("Freelancer","premiumpress"); } ?>
        </span> </label>
        <label class="btn rounded-0">
        <input type="radio" name="user_type" value="user_em" autocomplete="off">
        <span>
        <?php if(THEME_KEY == "ex"){ echo __("Teacher","premiumpress"); }else{ echo __("Employer","premiumpress"); } ?>
        </span> </label>
      </div>
    </div>
    <?php if( THEME_KEY == "ex"){ ?>
    <script>
function switchlabel(){

 
	if(jQuery('input[name=user_type]:checked').val() == "user_fr"){
	txt = "<?php echo __("I can teach","premiumpress"); ?>";
	}else{
	txt = "<?php echo __("I'm want to learn","premiumpress"); ?>";
	}
	jQuery("#da-seeking2-label").html(txt);
}
</script>
    <?php } ?>
    <?php } ?>
    
    
    
    
    
    
    
    <?php if( THEME_KEY == "es"){ 
	
	global $CORE_ESCORTTHEME;
	
	$accountTypes = $CORE_ESCORTTHEME->_escort_types();
	
	
	?>
    
    <div class="col-12 mb-4">
    
    <div class="border p-3 rounded">
    
    <div class="row"> 
    <div class="col-12 col-md-6">
    
    
    
      <div class="form-group mb-0 pb-0">
        
          <label class="small text-uppercase font-weight-bold mb-4"><?php  echo __("Create account as","premiumpress"); ?>;</label>
          
          <div class="ml-4">
          <?php foreach($accountTypes as $k => $g){ ?>          
         <div>
        <label class="custom-radio custom-checkbox small">
      <input type="radio"  value="<?php echo $k; ?>" name="user_type" class="custom-control-input" onclick="switchtypedata(<?php echo $k; ?>)"  data-type="radio" <?php if( $k == 1){ ?>checked=checked<?php } ?>>
      <div class="custom-control-label "> 
	  
	  <?php echo $g; ?>
      
      </div>
      
      </label>
      </div>
          
		  <?php } ?>  
          
          </div>  
        
           
          
 </div>
        
      </div>
      
      <div class="col-12 col-md-6">
      
      
      </ul>
      
      <div id="typedataid"></div>
      
      </div>
      
      
    </div> </div> </div>
    
    <script>
	
	function switchtypedata(thisid){
		
		jQuery("#typedataid").html("");
		
		package = [];
		package["1"] = ["<?php  echo __("Free Sign up","premiumpress"); ?>","<?php  echo __("Add reviews","premiumpress"); ?>","<?php  echo __("Manage favorites","premiumpress"); ?>","<?php  echo __("Contact Escorts","premiumpress"); ?>"];
		package["2"] = ["<?php  echo __("Free Sign up","premiumpress"); ?>","<?php  echo __("Manage profile","premiumpress"); ?>","<?php  echo __("Promote yourself","premiumpress"); ?>","<?php  echo __("Contact members","premiumpress"); ?>"];
		package["3"] = ["<?php  echo __("Free Sign up","premiumpress"); ?>","<?php  echo __("Manage profile","premiumpress"); ?>","<?php  echo __("Promote yourself","premiumpress"); ?>","<?php  echo __("Contact members","premiumpress"); ?>"];
		package["4"] = ["<?php  echo __("Free Sign up","premiumpress"); ?>","<?php  echo __("Manage profile","premiumpress"); ?>","<?php  echo __("Promote yourself","premiumpress"); ?>","<?php  echo __("Contact members","premiumpress"); ?>"];
 
		
		var thispak = package[thisid];
		
		text = '<ul class="list-group list-group-flush small mb-0">';
		
		jQuery.each(thispak, function(key, value) {
			
			   text +=  '<li class="list-group-item pl-0"><i class="fal fa-check text-success mr-3"></i>'+value+'</li>';
			 
		});
		
		text += '</ul>';
		
		jQuery("#typedataid").html(text);
	
		
	
	}
	
	jQuery(document).ready(function(){ 
	switchtypedata(1);
	});
	
	</script>
    
    <?php } ?>
    
    <?php if( THEME_KEY == "ex"){ ?>
    <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <select name="da-seek2" class="form-control rounded-0 bg-white required">
              <option value="" id="da-seeking2-label">
              <?php  echo __("I'm want to learn","premiumpress"); ?>
              </option>
              <?php
                  $count = 1;
                  $cats = get_terms( 'listing', array( 'hide_empty' => 1, 'parent' => 0  ));
                  if(!empty($cats)){
                  foreach($cats as $cat){ 
                  if($cat->parent != 0){ continue; } 
                   
                  ?>
              <option value="<?php echo $cat->term_id; ?>"> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
              <?php $count++; } } ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if( THEME_KEY == "da"){ ?>
    <div class="col-xs-12 col-md-6">
      <div class="form-group" <?php if(_ppt(array('register','da_reggender')) == "1"){ echo 'style="display:none;"'; } ?>>
        <div class="row">
          <div class="col-md-12 position-relative">
            <select name="da-seek1" class="form-control <?php if(_ppt(array('register','da_reggender')) != "1"){ echo 'required'; } ?>" >
              <option value=""> <?php echo __("I'm a","premiumpress"); ?></option>
              <?php
$count = 1;
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
              <option value="<?php echo $cat->term_id; ?>"> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
              <?php $count++; } } ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group" <?php if(_ppt(array('register','da_seeking')) == "1"){ echo 'style="display:none;"'; } ?>>
        <div class="row">
          <div class="col-md-12 position-relative">
            <select name="da-seek2" class="form-control <?php if(_ppt(array('register','da_seeking')) != "1"){ echo 'required'; } ?>" >
              <option value=""><?php echo __("Seeking a","premiumpress"); ?></option>
              <?php
$count = 1;
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
              <option value="<?php echo $cat->term_id; ?>" > <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
              <?php $count++; } } ?>
            </select>
            <i class="fal fa-heart position-absolute" style="right:40px; top:12px;"></i> </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(_ppt(array('register','hide_firstlast')) != 1){ ?>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="text" name="first_name" id="user_fname"  tabindex="2" value="<?php if(isset($_POST['first_name'])){ echo esc_html(strip_tags($_POST['first_name'])); } ?>" class="form-control required" placeholder="<?php echo __("First Name","premiumpress") ?>">
            <i class="fal fa-user position-absolute" style="right:30px; top:12px;"></i> </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="text" name="last_name" id="user_lanme" tabindex="3" value="<?php if(isset($_POST['last_name'])){ echo esc_html(strip_tags($_POST['last_name'])); } ?>" class="form-control required" placeholder="<?php echo __("Last Name","premiumpress") ?>" >
            <i class="fal fa-user position-absolute" style="right:30px; top:12px;"></i> </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="text" name="user_email" id="user_email" tabindex="4" value="<?php if(isset($_POST['user_email'])){ echo esc_html(strip_tags($_POST['user_email'])); } ?>" class="form-control required" placeholder="<?php echo __("Email","premiumpress"); ?>" autocomplete="off">
            <i class="fal fa-envelope position-absolute" style="right:30px; top:12px;"></i> </div>
        </div>
      </div>
    </div>
    <?php echo $CORE->user_fields(); ?>
    <?php if( _ppt(array('register','password')) == '1'){  ?>
    <div class="col-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="password" name="pass1" id="pass1" value="<?php if(isset($_POST['pass1'])){ echo esc_html(strip_tags($_POST['pass1'])); } ?>" tabindex="5" class="form-control required" placeholder="<?php echo __("Password","premiumpress"); ?>" autocomplete="off">
            <i class="fal fa-lock position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:20px;"; }else{ echo "right:30px;";  } ?> top:12px;"></i> </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-12 position-relative">
            <input type="password" name="pass2" id="pass2" value="<?php if(isset($_POST['pass2'])){ echo esc_html(strip_tags($_POST['pass2'])); } ?>" tabindex="6" class="form-control required" placeholder="<?php echo __("Confirm Password","premiumpress"); ?>" autocomplete="off">
            <i class="fal fa-lock position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:20px;"; }else{ echo "right:30px;";  } ?> top:12px;"></i> <i class="fa fa-eye position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:60px;"; }else{ echo "right:60px;";  } ?> top:12px;cursor:pointer;" onclick="TogglePass('pass1');TogglePass('pass2');"></i> </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>
    <div class="g-recaptcha my-3 ml-3" data-sitekey="<?php echo stripslashes(_ppt(array('captcha','sitekey'))); ?>"></div>
    <?php }else{ $reg_nr1 = rand("0", "9"); $reg_nr2 = rand("0", "9"); ?>
    <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12">
            <label class="text-muted"> <i class="fal fa-shield mr-2"></i> <?php echo __("Security Question","premiumpress") ?> </label>
          </div>
          <div class="col-md-12">
            <div class="input-group">
              <input type="text" name="reg_val" id="user_code" data-codep="<?php echo ($reg_nr1+$reg_nr2); ?>" tabindex="7" class="form-control required"  placeholder="<?php echo $reg_nr1; ?> + <?php echo $reg_nr2; ?> =">
              <input type="hidden" name="reg1" value="<?php echo $reg_nr1; ?>" />
              <input type="hidden" name="reg2" value="<?php echo $reg_nr2; ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php //do_action('register_form'); ?>
  </div>
  <div class="form-group my-1 small">
    <label class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="agreepp1" value="1" onchange="jQuery('#agreepp1').prop('disabled', true);jQuery('#wp-submit-register').prop('disabled', false);">
    <div class="custom-control-label"> <?php echo __("Accept","premiumpress") ?> <a href="<?php echo _ppt(array('links','terms')); ?>" target="_blank"><?php echo __("Terms &amp; conditions","premiumpress") ?></a> </div>
    </label>
  </div>
  <button type="submit" name="wp-submit" id="wp-submit-register" class="btn btn-primary btn-block rounded-0 py-3"  disabled><?php echo __("Register","premiumpress"); ?></button>
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
<?php } ?>
