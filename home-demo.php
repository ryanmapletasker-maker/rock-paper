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
 
global $CORE, $settings;

if(get_option("ppt_license_key") == "" && get_option("ppt_reinstall") == ""){

include( 'framework/installation.php' ); 
 
}else{


$colors 		= $CORE->LAYOUT("captions", "all");
$categories 	= $CORE->LAYOUT("get_demo_categories", array());

?>
<style>

#mobile-bottom-bar { display:none !important; }
.elementor_header {
    
    border-bottom: 1px solid #ffffff24; padding:10px 0px;
}
.hero-large .lead { font-size: 25px; }


@media (max-width: 575.98px){
	.hero-large {
		height: 700px !important;
	}
}

@media (min-width: 1300px){
	.mainimage {position: absolute; bottom: -65px; right: -92px; }
}
@media (min-width: 1199px){ 
	.mainimage {position: absolute; bottom: -65px; right: -180px; }
}

@media (min-width: 992px) and (max-width: 1199.98px) { 
.mainimage {position: absolute; bottom: -165px;    right: -350px; }
}
@media (min-width: 0px) and (max-width: 991.98px) { 
.mainimage { width:100%; }
.mainimage img { max-width:500px; margin:auto; display: block; }

.hero-large .white-underline:after { display:none; }


}
/* mobile */
@media (max-width: 575.98px) {
.mainimage img { max-width:100%;   }

.navbar-brand { width:100%; }
.demolinks a { display:none; }
.buynowbtn { display:none; }

}


.line-height-50 { line-height:50px; }
.color1 { color:<?php echo $colors['color1']; ?> }
.color1-bg { background-color:<?php echo $colors['color1']; ?> }
.demolinks a { line-height: 80px; padding:10px 20px; color: #fff; text-transform:uppercase; font-weight:500; }
.demolinks a.active {   position:relative; font-weight:800; } 
.yellow-underline hide-mobile:after, .yellow-underline hide-mobile-big:after, .white-underline:after {
    display: block;
    content: '';
    background: url(<?php echo DEMO_IMG_PATH; ?>/yellow_underline.png) no-repeat left top;
    position: absolute;
    width: 161px;
    height: 12px;
    lefT: -7px;
    bottom: -8px;
}
.yellow-underline hide-mobile, .white-underline, .yellow-underline hide-mobile-big {
    position: relative;
    display: inline-block;
}
.white-underline:after {
    background: url(<?php echo DEMO_IMG_PATH; ?>/white_underline.png) no-repeat left top;
    left: 0;
}

.box-slider {
   width: 100%;
   position: relative;
}
.slide, .slide img {
   width: 100%;
}
.box-slider img {
   box-shadow: 0 6px 11px rgba(0,0,0,0.4);
}
.box-slider .slider { height:400px; }


#p-demos .nav {
  display: block !important;
  text-align: center;
  padding: 43px 0px 0px 0px;
}
@media (max-width: 767px) {
  #p-demos .nav {
    padding: 33px 0px 0px 0px;
  }
}
#p-demos .nav ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
}
@media (max-width: 767px) {
  #p-demos .nav ul {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: scroll;
  }
}
#p-demos .nav ul li {
  display: inline-block;
  vertical-align: top;
  padding: 10px 16px;
}
@media (max-width: 767px) {
  #p-demos .nav ul li {
    display: block;
    white-space: nowrap;
    padding: 10px 13px;
  }
}
#p-demos .nav ul li.active a {
  color: #09b4c3;
  position: relative;
}
#p-demos .nav ul li.active a:before {
  content: '';
  position: absolute;
  left: 0;
  bottom: 5px;
  right: 0;
  height: 1px;
  background: #09b4c3;
}
#p-demos .nav ul li a {
  font-size: 22px;
  color: #000;
  display: inline-block;
  font-weight: 600;
}
@media (max-width: 767px) {
  #p-demos .nav ul li a {
    font-size: 16px;
  }
}
@media (min-width: 1200px){
.hero_content h1 {
    font-size: 45px;
}
}
</style>
<?php
if(defined('WLT_DEMOMODE')){ ?>

<section class="hero-large position-relative hero-default pb-0 hero-demo">
  <div class="bg-image" data-bg="<?php echo DEMO_IMG_PATH; ?>/<?php echo THEME_KEY; ?>/demo/hero.jpg"></div>
  <div class="container-fluid text-center bg-content py-3 mb-4" style="border-bottom:1px solid #547fbf;">
    <div class="container px-0">
      <div class="row">
        <div class="col-lg-4 text-center text-lg-left"> <img data-src="<?php echo DEMO_IMG_PATH; ?>/<?php echo THEME_KEY; ?>/demo/logo.png" class="lazy" style="max-height:30px;" alt="logo"/> </div>
        <div class="col-md-8 text-center text-lg-right d-none d-lg-block"> <a href="https://www.premiumpress.com" target="_blank" class="btn btn-outline-light btn-rounded-25 btn-sm"><i class="fal fa-arrow-right mr-1">&nbsp;</i> PremiumPress</a> </div>
      </div>
    </div>
  </div>
  <div class="hero_content z-10 mt-n4 mt-lg-0" style="bottom:0;    padding-bottom: 0px !important;    margin-bottom: 0px !important;">
    <div class="container bg-content">
      <div class="row">
        <div class="col-lg-6 text-center text-lg-left mb-5">
          <div class="lead mb-4 text-white"> Premium <strong class="white-underline font-weight-bold">WordPress</strong> Theme </div>
          <h1 class="text-white"><?php echo $colors['desc']; ?></h1>
          <div class="mt-5"> <a href="#p-demos" class="btn btn-xl btn-light btn-rounded-25 shadow font-weight-bold mr-md-3 custom-scroll-link "> View Demos</a> <a href="https://www.premiumpress.com/pricing/?theme=<?php echo THEME_KEY; ?>" class="btn btn-xl  btn-outline-light btn-rounded-25 hide-mobile"> <i class="fal fa-lock-alt mr-2">&nbsp;</i> Buy Now </a> </div>
          <p class="opacity-5 text-white d-none d-xl-block my-5 small">Version <?php echo THEME_VERSION; ?>. - Updated <?php echo THEME_VERSION_DATE; ?></p>
        </div>
        <div class="mainimage"> <img src="<?php echo DEMO_IMG_PATH; ?>/<?php echo THEME_KEY; ?>/demo/hero.png" class="img-fluid" alt="<?php echo THEME_NAME; ?>" /> </div>
      </div>
    </div>
  </div>
</section>
<div class="list-single-main-container">
  <section class="position-relative shadow" style="background-color:<?php echo $colors['color1']; ?>">
    <div class="bg-gradient-smallxx">
      <div class="container">
        <nav class="scroll-nav scroll-init">
          <div class="demolinks"></div>
        </nav>
      </div>
    </div>
  </section>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-1000896786"></script>
<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-123456789');
 

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-23830719-1', 'auto');
ga('send', 'pageview');

jQuery(document).ready(function(){ 
	jQuery(".ga_v10_demo").on("click", function() {	
        ga('send', 'event', 'V10 - Demo '+ jQuery(this).attr('data-cat'), 'V10 DEMO CLICK', jQuery(this).attr('data-themename') ); 		
    });
});

</script>


  
  
  
  <section class="bg-light section-80 addtomenu"  id="p-demos" data-title="Live Demos">
    <div class="container-fluid ">
     <div class="row">
        <div class="col-12">
        
          <div class="row justify-content-center heading-title title-center">
            <div class="col-md-8 text-center">
              <h1 class="text-dark h1 mb-4">All Designs <strong class="yellow-underline hide-mobile" style="color:<?php echo $colors['color1']; ?>">Included!</strong></h1>
              <?php if(!isset($categories[THEME_KEY][1])){ ?>
              <p class="lead text-muted">You get all the designs below when you buy this theme.</p>
              <hr style="width:50px; height:3px; background:<?php echo $colors['color1']; ?>" class="mx-auto border-0 mt-5">
              <?php }else{ ?>
              <p class="lead text-muted">Click on any image below to see live preview.</p>
              <?php } ?>
            </div>
          </div>
        </div> 
          
      </div>
    </div>
  </section>  
         
<?php }else{ ?>

  <section class="bg-light section-120 pb-5 addtomenu"  id="p-demos" data-title="Live Demos">
    <div class="container-fluid ">
     <div class="row">
        <div class="col-12">
        
          <div class="row justify-content-center heading-title title-center">
            <div class="col-md-8 text-center">
              <h1 class="text-dark h1 mb-4"> Select <strong class="yellow-underline hide-mobile" style="color:<?php echo $colors['color1']; ?>">Default</strong> Design </h1>
               
              <p class="lead text-muted">Select a design to install.</p>
               
            </div>
          </div>
        </div> 
          
      </div>
    </div>
  </section>  

<?php } ?>



<?php foreach($categories[THEME_KEY] as $cid => $cat){  ?>
      
        
        
        
<section class="bg-light" id="listing3-carousel-<?php echo $cid; ?>" >
  <div class="container">
    <div class="row">
    
    <div class="col-12 mb-4">
    
            <div class="float-right">
        
        <a class="btn bg-white btn-sm text-muted prev px-2 mt-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a> 
        <a class="btn bg-white btn-sm text-muted next px-2 mt-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a> 
        
        </div>
        
        <h4><?php echo $cat; ?></h4>
        
	 
    
    
    </div>
      <div class="col-12">
        

        <div  class="owl-carousel owl-theme">
        
		
        
        <?php
		 	
			$g = $CORE->LAYOUT("load_designs_by_theme", $cid); ?>
      
        
        
        
        <?php $i = 1; foreach($CORE->multisort($g, array('order')) as $key => $h){ ?>
      <div class="card-top-image card-zoom mb-5 shadow-sm shadow-sm conceptidea">
          
      
      
      <?php if(defined('WLT_DEMOMODE')){ ?>
      <figure  style="min-height:250px;">
      <a href="<?php echo home_url(); ?>/?design=<?php echo $h['key']; ?>"  class="ga_v10_demo"  data-cat="<?php echo strtoupper(THEME_KEY); ?>" data-themename="<?php echo $h['key']; ?>" target="_blank"> 
      <img src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="demo">
              <div class="read_more"><span class="bg-dark text-white">view design</span></div>
      
      </a>      
      
      </figure>
      <?php }else{ ?>
      <figure> <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=design&defaultdesign=<?php echo $h['key']; ?>" target="_blank"> <img src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="demo">
            <div class="read_more"><span class="bg-dark text-white"><i class="fal fa-upload"></i> <?php echo __("Install Design","premiumpress"); ?></span></div>
            </a>
            <div class="read_more" style="top:30%"> <a href="<?php echo home_url(); ?>/?design=<?php echo $h['key']; ?>" target="_blank"><span class="bg-dark text-white"><i class="fal fa-search"></i> <?php echo __("View Design","premiumpress"); ?></span></a> </div>
          </figure>
      <?php } ?>
      
      
      
      
              
      </div>
        <?php $i++; } ?>
        
        
        
        </div>
      </div>
    </div>
  </div>
</section>

        
        

<script> 
jQuery(document).ready(function(){ 
		 
	var owl = jQuery("#listing3-carousel-<?php echo $cid; ?> .owl-carousel").owlCarousel({
        loop: false,
        margin: 20,
        nav: false,
        dots: false,		
        responsive: {
            0: {
                items: 2
            },
			 
            600: {
                items: 2
            },
			
			 
			
            1000: {
                items: 4
            }
        },        
    }); 
	
	owl.owlCarousel();
	
	// REFRESH	
	setTimeout(function(){	
   		owl.trigger('refresh.owl.carousel');
	}, 2000); 
 
  jQuery("#listing3-carousel-<?php echo $cid; ?> .next").click(function(){
    owl.trigger('next.owl.carousel');
	owl.trigger('refresh.owl.carousel');
  })
  jQuery("#listing3-carousel-<?php echo $cid; ?> .prev").click(function(){
    owl.trigger('prev.owl.carousel');
	owl.trigger('refresh.owl.carousel');
  })
	
	
});
	 
</script>
        
        
<?php } // end category loop ?>        
        
        
        
        
        


<?php if(defined('WLT_DEMOMODE')){ ?> 
        
        
<section class="bg-white section-100 border-top" id="carousel-langs" >
  <div class="container">
    <div class="row">
    
    <div class="col-12 mb-4">
    
            <div class="float-right">
            
            
        
        <a class="btn bg-white btn-sm text-muted prev px-2 mt-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a> 
        <a class="btn bg-white btn-sm text-muted next px-2 mt-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a> 
        
        </div>
        
        <h2>Multiple Languages! <a href="https://www.youtube.com/watch?v=4yoCSvH8xjU" target="_blank" class="btn btn-sm btn-danger ml-2"><i class="fa fa-video"></i> Watch Video</a></h2>
        
	 	<p>This theme comes with 10+ language files + easily add your own!</p>
    
    
    </div>
      <div class="col-12">
        

        <div  class="owl-carousel owl-theme">
        
		<?php  $g = $CORE->LAYOUT("load_designs_by_theme", "lang");   ?>
     
      <?php $i = 1; foreach($CORE->multisort($g, array('order')) as $key => $h){ ?>
     
        <div class="card-top-image card-zoom mb-5 shadow-sm shadow-sm">
          <figure  style="min-height:250px;">
          
         <a href="<?php echo home_url(); ?>/?design=<?php echo $h['key']; ?>&l=<?php echo $h['lang']; ?>" target="_blank">
           <img src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="demo">
            
          
            <div class="read_more" style="top:40%"> 
            
            
            <span class="bg-light text-dark"><i class="fal fa-search"></i> Video Demo </span> </div>
            
            </a>
          </figure>
          
           <div class="text-center bg-dark text-light py-2 position-absolute w-100" style="bottom:0px;"><?php echo $h['name']; ?></div>
         
        </div>
      
      <?php } ?>
      
        
   
        
        
        
        </div>
      </div>
    </div>
  </div>
</section>

        
        

<script> 
jQuery(document).ready(function(){ 
		 
	var owl = jQuery("#carousel-langs .owl-carousel").owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,		
        responsive: {
            0: {
                items: 2
            },
			 
            600: {
                items: 2
            },
			
			 
			
            1000: {
                items: 4
            }
        },        
    }); 
	
	owl.owlCarousel();
	
	// REFRESH	
	setTimeout(function(){	
   		owl.trigger('refresh.owl.carousel');
	}, 2000); 
 
  jQuery("#carousel-langs .next").click(function(){
    owl.trigger('next.owl.carousel');
	owl.trigger('refresh.owl.carousel');
  })
  jQuery("#carousel-langs .prev").click(function(){
    owl.trigger('prev.owl.carousel');
	owl.trigger('refresh.owl.carousel');
  })
	
	
});
	 
</script>
         
 <?php } ?>  
         
  
 
 <div class="scroll-nav-wrapper"></div>
  <section class="section-40 bg-black text-white text-center">
    <p class="mb-3">Made with love <i class="fa fa-heart text-danger mx-2">&nbsp;</i> by PremiumPress</p>
  </section>

<?php } // end install ?>