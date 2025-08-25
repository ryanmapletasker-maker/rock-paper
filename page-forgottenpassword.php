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


	global $CORE, $errortext;
 
	get_header(); 

	_ppt_template( 'page', 'top' ); ?>     
    
<section class="bg-light section-100">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-lg-6 mx-auto">
            <?php if(strlen($errortext) > 1){ ?>
            <div class="alert alert-danger <?php echo $errorStyle; ?> text-center"><?php echo $errortext; ?></div>
            <?php } ?> 
                    <div class="text-center py-3">
                     <h1 class="h2"><?php echo __("Password Reset","premiumpress") ?></h1>
                     <p class="text-muted my-3 col-md-10 mx-auto"><?php echo __("Enter your account username or email address below.","premiumpress"); ?></p>
                  </div>
            <div class="card shadow-sm">
               <div class="card-body p-lg-5">
          
                  <span class="clearfix"></span>
                  <form class="lostpasswordform" name="lostpasswordform" id="loginform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post'); ?>" method="post">
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-white"><i class="fa fa-user"></i></span>
                           </div>
                           <input type="text" name="user_login" id="user_login" placeholder="<?php echo __("My account username is...","premiumpress") ?>" 
                              value="<?php echo esc_attr(stripslashes($_POST['user_login'])); ?>" class="form-control"/> 
                        </div>
                     </div>
                     <?php do_action('login_form'); ?>
                     <div class="mt-4">
                        <button type="submit" class="btn btn-block btn-primary py-3"><?php echo __("Continue","premiumpress") ?></button>
                     </div>
                  </form>
               </div>
            </div>
            
                  <div class="d-block d-sm-flex justify-content-between align-items-center mt-4 mb-5">
      <?php if( _ppt(array('mem','register'))  != 1){ ?>
       <span> <span class="text-muted"><?php echo __("Not registered?","premiumpress"); ?></span> <a href="<?php if(_ppt(array('links','register')) != ""){ echo _ppt(array('links','register')); }else{ echo wp_registration_url(); } ?>"><?php echo __("Create account","premiumpress"); ?></a> </span> 
       
       <?php } ?>
       
       <a href="<?php echo wp_login_url(); ?>"><?php echo __("Member Login","premiumpress"); ?></a> </div>
   
            
            
         </div>
      </div>
   </div>
</section>

<?php _ppt_template( 'page', 'bottom' ); ?>  
 
<?php get_footer();  ?>