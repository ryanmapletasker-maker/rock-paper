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
if (!defined('THEME_VERSION')) {	footer('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $CORE; ?>




<?php if( in_array(_ppt(array("comchat","msg_enable")), array("1")) && !isset($GLOBALS['COMCHATSET']) ){  ?>
<script>
  var chat_appid = '<?php echo _ppt(array("comchat","appid")); ?>';
  var chat_auth = '<?php echo _ppt(array("comchat","authkey")); ?>';
    var chat_id = '<?php echo $userdata->ID; ?>';
    var chat_name = '<?php echo $CORE->USER("get_username", $userdata->ID); ?>';
    var chat_avatar = '<?php echo $CORE->USER("get_avatar", $userdata->ID); ?>';
    var chat_link = '<?php echo $CORE->USER("get_user_profile_link", $userdata->ID); ?>';
</script>
<script>
  (function() {
    var chat_css = document.createElement('link'); chat_css.rel = 'stylesheet'; chat_css.type = 'text/css'; chat_css.href = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.css';
    document.getElementsByTagName("head")[0].appendChild(chat_css);
    var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.js'; var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
  })();
</script>

<?php } ?>





<?php if( _ppt(array('design','loadinline')) == 0 && !is_admin() && (  _ppt(array('gdpr','enable')) == 1 ) ){ ?>

<script>

jQuery(document).ready(function(){ 

	 
    jQuery(document).gdprCookieLaw({
        moreLinkHref: '<?php echo _ppt(array('links','privacy')); ?>',
		theme: 'theme-dark',
		desc: "<?php echo __("We use cookies to ensure that we give you the best experience on our website. By continuing to use our site, you accept our cookie policy.","premiumpress"); ?>",
		moreLinkText: "<?php echo __("Privacy Policy","premiumpress"); ?>",
		btnAcceptText: "<?php echo __("Accept","premiumpress"); ?>",
		animationStatus: true,
        animationDuration: 500,
        animationName: 'fade-slide',
		cookName: 'cookielaw1',
		expire: 1,
    });	
	
});
</script>

<?php } ?>

<?php if( _ppt(array('design','loadinline')) == 0 && !is_admin() && ( _ppt(array('adultwarning','enable')) == 1   ) ){  ?>
<script>
jQuery(document).ready(function(){ 
    jQuery(document).gdprCookieLaw({
        moreLinkHref: '<?php echo _ppt(array('links','terms')); ?>',
		theme: 'theme-1',
		desc: "<?php echo __("Adult content warning. By continuing to use our site, you accept you are over the age of 18","premiumpress"); ?>",
		moreLinkText: "",
		btnAcceptText: "<?php echo __("Accept","premiumpress"); ?>",
		animationStatus: true,
        animationDuration: 500,
        animationName: 'fade-slide',
		cookName: 'adultwarning1',
		expire: 1,
    });	 
});


</script>
<?php } ?>


<?php wp_footer(); ?>

<?php echo $CORE->LAYOUT("load_js", array()); ?>
<?php

	// CUSTOM JQUERY
	if(strlen(get_option('custom_js')) > 10){ echo stripslashes(get_option('custom_js')); }
 
	// GOOGLE ANALYTICS
	if(_ppt(array('analytics','enable')) == '1'){
 	
		ob_start();
		?>
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');		
		  ga('create', '<?php echo stripslashes(_ppt(array('analytics','uakey'))); ?>', 'auto');
		  ga('send', 'pageview');		
		</script>
<?php
		echo ob_get_clean(); 
	}
	
?>
<?php if(_ppt(array('maps','enable')) == 1){ ?>
<!--map-modal -->
<div class="map-modal-wrap shadow hidepage" style="display:none;">
  <div class="map-modal-wrap-overlay"></div>
  <div class="map-modal-item">
    <div class="map-modal-container">
      <div class="map-modal">
        <div id="singleMap"  data-latitude="54.2890174" data-longitude="-0.4024484"></div>
      </div>
      <div class="card-body">
        <h3><a href="#" class="text-dark">Title</a></h3>
        <div class="address text-muted small letter-spacing-1"></div>
        <div class="map-modal-close bg-primary text-center"><i class="fal fa-times">&nbsp;</i></div>
      </div>
    </div>
  </div>
</div>

<!--map-locationMap -->
<div class="location-modal-wrap shadow hidepage" style="display:none;">
  <div class="location-modal-wrap-overlay"></div>
  <div class="location-modal-item">
    <div class="location-modal-container">
      <div class="location-modal">
        <div id="locationMap"></div>
        
        <?php /*
      <div class="position-absolute locationmapgeromapbox" style="top:10px; left:10px;" id="locationmapgeromapbox">
        <input type="text"   placeholder="<?php echo __("Enter country, city or zipcode.","premiumpress"); ?>"  id="location-setaddress" class="form-control" style="margin-right:50px;">
         <span id="searchlocationbit"  style="top: 10px; right: 10px; position: absolute;    z-index: 100;"> <i class="fa fa-search " style="cursor:pointer;" ></i>  </span>
        </div>
        
        <input type="hidden" id="location-mylog" value="<?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['log']; }else{ echo "-60.1"; } ?>" />
        <input type="hidden" id="location-mylat" value="<?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['lat']; }else{ echo "30.7"; }  ?>" />
        <input type="hidden" id="location-country" value="<?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['country']; } ?>" />
        <input type="hidden" id="location-address" value="<?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['address']; } ?>" />
        <input type="hidden" id="location-zip" value="<?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['zip']; } ?>" />
        
		*/ ?>
		
      </div>
      
         <div class="card-body">
        <h3><?php echo __("Where are you now?","premiumpress"); ?></h3>
        <div class="address text-muted small letter-spacing-1" id="location-address-display"><?php if(isset($_SESSION['mylocation'])){ echo $_SESSION['mylocation']['address']; } ?></div>
        <div class="location-modal-close bg-primary text-center"><i class="fal fa-times">&nbsp;</i></div>
      </div>
 
    </div>
  </div>
</div>
<!--map-modal end -->

<?php //_ppt_template( 'ajax-modal-location' );  ?>
<?php } ?>
<!--payment modal -->
<div class="payment-modal-wrap shadow hidepage" style="display:none;">
  <div class="payment-modal-wrap-overlay"></div>
  <div class="payment-modal-item">
    <div class="payment-modal-container">
      <div id="ajax-payment-form"></div>
      <div class="card-body">
        <h3 class="<?php echo $CORE->GEO("price_formatting",array()); ?>">$0</h3>
        <div class="payment-modal-close bg-primary text-center"><i class="fal fa-times">&nbsp;</i></div>
      </div>
    </div>
  </div>
</div>
<!--login modal -->
<div class="login-modal-wrap shadow hidepage" style="display:none;">
  <div class="login-modal-wrap-overlay"></div>
  <div class="login-modal-item">
    <div class="login-modal-container"> 
      <div class="card-body">
         <div id="ajax-login-form"></div>
        <div class="login-modal-close text-center"><i class="fal fa-times">&nbsp;</i></div>
      </div>
    </div>
  </div>
</div>
<!--msg model -->
<div class="msg-modal-wrap shadow hidepage" style="display:none;">
  <div class="msg-modal-wrap-overlay"></div>
  <div class="msg-modal-item">
    <div class="msg-modal-container"> 
      <div class="card-body p-0">
         <div id="ajax-msg-form"></div>
        <div class="msg-modal-close text-center"><i class="fa fa-times">&nbsp;</i></div>
      </div>
    </div>
  </div>
</div>

<!--msg model -->
<div class="upgrade-modal-wrap shadow hidepage" style="display:none;">
  <div class="upgrade-modal-wrap-overlay"></div>
  <div class="upgrade-modal-item">
    <div class="upgrade-modal-container"> 
      <div class="card-body p-0">
         <div id="ajax-upgrade-form"></div>
        <div class="upgrade-modal-close text-center"><i class="fa fa-times">&nbsp;</i></div>
      </div>
    </div>
  </div>
</div>




 
<?php if(!isset($GLOBALS['NOFOOTERSTYLES'])){ ?>
<noscript id="deferred-styles">

<?php if(isset($GLOBALS['footer-css']) && is_array($GLOBALS['footer-css'])){ foreach($GLOBALS['footer-css'] as $k => $path){  ?>
<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>?v=<?php echo THEME_VERSION; ?>" <?php if($k == "bootstrap"){ ?>rel="preload"<?php } ?>/>
<?php } } ?>

<?php if(isset($GLOBALS['footer-css-extra']) && is_array($GLOBALS['footer-css-extra'])){ foreach($GLOBALS['footer-css-extra'] as $k => $path){  ?>
<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>?v=<?php echo THEME_VERSION; ?>"/>
<?php } } ?>

 
<style><?php echo $CORE->LAYOUT("load_css", array()); ?></style> 

 
</noscript>
<script>

var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
};
var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
          window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
      if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
      else window.addEventListener('load', loadDeferredStyles);

</script>
<?php } ?>

<script>
var ajax_site_url = "<?php echo $CORE->_ppt_home_url(); ?>/index.php";  
var ajax_framework_url = "<?php echo get_template_directory_uri(); ?>/"; 
var ajax_googlemaps_key = "<?php echo trim( _ppt(array('maps','apikey')) ); ?>"; 
 

<?php if($CORE->GEO("is_right_to_left", array() ) ){ ?>
jQuery(document).ready(function(){

	jQuery("html[lang=ar]").attr("dir", "rtl").find("body").addClass("rtl right-to-left");	
 
});
<?php } ?>

jQuery(window).on('load',function () {
	
setTimeout(
  function() 
  {
   
	jQuery("#wrapper").addClass('d-flex').removeClass('hidepage').addClass('preload-hide');
	
	jQuery('#page-loading').html('').hide();
	 
	jQuery(".hidepage").each(function() {
	  jQuery( this ).removeAttr("style").removeClass('hidepage').addClass('preload-hide');
	});
	
	
	jQuery(".gdpr-cookie-law").css("display", "block");
	
	tinyScroll();	
	 
	  // Trigger window resize event to fix resize size issues.
	  // Don't use jquery trigger event since that only triggers
	  // methods hooked to events, and not the events themselves.
	  if ( typeof( Event ) === 'function' ) {
		window.dispatchEvent( new Event( 'resize' ) );
	  } else {
		var event = window.document.createEvent( 'UIEvents' );
		event.initUIEvent( 'resize', true, false, window, 0 );
		window.dispatchEvent( event );
	  }
	  
	  

<?php if(( defined('THEME_KEY') && !in_array(THEME_KEY, array("dt","sp","cm","ct","vt","rt","so","jb","cp","ph","es")) ) && $userdata->ID &&  in_array(_ppt(array('user','friends')), array("","1")) && _ppt(array("comchat","msg_enable")) != 1 ){ 

// COUNT ONLINE USERS
 $gg = $CORE->USER("get_subscribers_followers", $userdata->ID);
 
  ?>

 
jQuery("#ppt_livechat_window").pptChat({
	cookie: false,
	sound: false,
	changeBrowserTitle: false,
	
	accountLink: "<?php echo _ppt(array('links','myaccount')); ?>/?showtab=messages",
	accountText: "<?php echo __("My Message","premiumpress"); ?>",
	
	button: {
		speechBubble: "<?php echo __("My Friends","premiumpress"); ?>",
		src: '<i class="fal fa-comment"></i>',
		notificationNumber: '<?php echo count($gg); ?>',
	},
	popup: {
		
		outsideClickClosePopup: false,
		
		persons: [
		
		<?php if(count($gg) > 0){ foreach($gg as $p){ ?>
		{
			avatar: {
				src: "<?php echo $CORE->USER("get_avatar", $p); ?>",
			},
			text: {
				title: "<?php echo $CORE->USER("get_username", $p); ?>",
				description: "",
				status: false,
				count: <?php if($CORE->USER("get_online_status", $p)){ echo 1; }else{ echo 0; } ?>,
			},
			 
			link: {
				desktop: "<?php echo $p; ?>"
			},
			day: {
				sunday: '00:00-23:59',
				monday: '00:00-23:59',
				tuesday: '00:00-23:59',
				wednesday: '00:00-23:59',
				thursday: '00:00-23:59',
				friday: '00:00-23:59',
				saturday: '00:00-23:59'
			}
		},
		<?php } } ?>
		]
	},
});
 
<?php   } ?>
  
   
  }, 1000);

});

 

</script>

<div id="ppt_livechat_window"></div>

<?php $rec = _ppt(array('user','notify')); if($rec == "" || $rec == 1){ }else{ ?>
<input type="hidden" name="notify-stop" class="notify-stop" id="notify-stop" />
<?php } ?> 