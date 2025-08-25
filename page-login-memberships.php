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

global $CORE, $userdata; ?>
<?php if(isset($_GET['checkemail'])){ ?>

<div class="alert alert-success"><i class="fa fa-envelope fa-3x mr-3 float-left"></i> <?php echo __("We have sent password recovery instructions to your email address.","premiumpress") ?></div>
<?php } ?>
<div class="text-center py-3">
  <h1 class="h2"> <?php echo __("Get Access Now!","premiumpress") ?></h1>
  <p class="text-muted my-3 col-md-10 mx-auto"><?php echo __("Signup for a membership today!","premiumpress"); ?></p>
</div>
<div class="card shadow-sm">
  <div class="card-body p-lg-5">
    <?php foreach(  $CORE->USER("get_memberships", array() ) as $k => $n){ 

 
$btn =  $CORE->order_encode(array(  
					               
						   "uid" 					=> $userdata->ID,                
						   "amount" 				=> $n['price'], 
						   "order_id" 				=> "SUBS-mem".$n['key']."-".$userdata->ID."-".rand(),                 
						   "description" 			=> $n['name'],
						   "recurring" 				=> $n['recurring'],    
						   "recurring_days" 		=> $n['duration'],            
						   "couponcode" 			=> "", 					                 
	));
 

  ?>
    <div class="card p-2 shadow-sm mb-4 p-3 bg-light text-center text-lg-left">
      <div class="row">
        <div class="col-lg-8">
          <h4><?php echo $n['name']; ?></h4>
          <p class="mb-0"><?php echo hook_price($n['price']); ?> <?php echo __("for","premiumpress"); ?> <?php echo $n['duration_text']; ?></p>
        </div>
        <div class="col-lg-4">
          <?php if(!$userdata->ID){ ?>
          <a href="javascript:void(0)" <?php if(isset($_GET['action']) && $_GET['action'] == "register"){ ?>onclick="processRegister();"<?php }else{ ?>onclick="processLogin(1);"<?php } ?> class="btn btn-primary mt-4 mt-lg-0" ><?php echo __("Select Package","premiumpress"); ?> </a>
          <?php }else{ ?>
          <a href="javascript:void(0);" class="btn btn-primary mt-4 mt-lg-0" onclick="processPayment('<?php echo $btn; ?>','<?php echo $n['price']; ?>');"><?php echo __("Select Package","premiumpress"); ?> </a>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="text-muted my-3 text-center"><?php echo __("Already a member?","premiumpress"); ?> <a <?php if(isset($GLOBALS['flag-register'])){ ?>href="<?php echo wp_login_url(); ?>"<?php }else{ ?>href="javascript:void(0)" onclick="processLogin();"<?php } ?> class="text-primary modal-register-link"><u><?php echo __("login here","premiumpress"); ?></u></a> </div>
  </div>
</div>
<script> 

function processPayment(sid,pp){
   	
		
   	 
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   				details: sid, 
           },
           success: function(response) { 
		   
		   jQuery(".payment-modal-wrap").fadeIn(400); 
		 
		    jQuery(".payment-modal-container h3").text(pp); 			 
			 
   			jQuery('#ajax-payment-form').html(response);	
			
			UpdatePrices();		 
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
   
   }
   
</script>
