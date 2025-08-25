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

global $CORE;  ?>
<div class="row no-gutters filters_listing mb-4">
   <div class="col-md-12 col-lg-8">
   
    
    <div class="show-mobile mobile-filters-bar">
    <a  data-toggle="collapse" href="#filters-extra" id="filerbuttonclick" class="btn btn-block btn-system btn_filt small"><span> <i class="fal fa-sliders-h mr-2"></i> <?php echo __("Filters","premiumpress"); ?></span></a>
    </div>
   
   
      <div class="filter_sortby t1">
      
       	<?php if(_ppt(array('search', 'latest')) == "" || _ppt(array('search', 'latest')) == 1){ ?>
        
         <a href="javascript:void(0);" <?php if(!isset($_GET['sortby'])){ ?>class="active"<?php } ?> data-key="id"><span><?php echo __("Latest","premiumpress"); ?><i></i></span></a>
         <?php } ?>
         
         <?php if(_ppt(array('search', 'pop')) == "" || _ppt(array('search', 'pop')) == 1){ ?>
         <a href="javascript:void(0);" data-key="pop" <?php if($CORE->LAYOUT('captions','maps') && _ppt(array('maps','enable')) == 1 && _ppt(array("maps","provider")) != "basic"  && _ppt(array('search','filters_distance')) == 1 ){ ?>class="hide-mobile"<?php } ?>><span><?php echo __("Popular","premiumpress"); ?><i></i></span></a>
         <?php } ?>
        
         <?php if(in_array(THEME_KEY, array('mj'))){ ?>
      
          <a href="javascript:void(0);" data-key="price"><span><?php echo __("Price","premiumpress"); ?><i></i></span></a>       
         
            
         
         <?php if(_ppt(array('search','filters_rating')) == 1){ ?>
         <a href="javascript:void(0);" data-key="rating" <?php if($CORE->LAYOUT('captions','maps') && _ppt(array('maps','enable')) == 1 && _ppt(array("maps","provider")) != "basic"  && _ppt(array('search','filters_distance')) == 1 ){ ?>class="hide-mobile"<?php } ?>><span><?php echo __("Rating","premiumpress"); ?><i></i></span></a>
         <?php } ?>
         
         <?php }elseif(in_array(THEME_KEY, array('dt'))){ ?>
       
            
         
         <?php if(_ppt(array('search','filters_rating')) == 1){ ?>
         <a href="javascript:void(0);" data-key="rating" <?php if(_ppt(array('maps','enable')) == 1 && _ppt(array('search','filters_distance')) == 1 ){ ?>class="hide-mobile"<?php } ?>><span><?php echo __("Rating","premiumpress"); ?><i></i></span></a>
         <?php } ?>
         
         <?php if(_ppt(array('search', 'featured')) == "" || _ppt(array('search', 'featured')) == 1){ ?>
         <a href="javascript:void(0);" data-key="featured"><span><?php echo __("Featured","premiumpress"); ?><i></i></span></a>
       	<?php } ?>
         
         
		 <?php }elseif(in_array(THEME_KEY, array('at'))){ ?>
         
         <a href="javascript:void(0);" data-key="expiry" class="hide-mobile"><span><?php echo __("Ending","premiumpress"); ?><i></i></span></a>
         <a href="javascript:void(0);" data-key="price"><span><?php echo __("Price","premiumpress"); ?><i></i></span></a>        
        
        <?php }elseif(in_array(THEME_KEY, array('da'))){ ?>
        
        <a href="javascript:void(0);" data-key="age"><span><?php echo __("Age","premiumpress"); ?><i></i></span></a>
        
        <?php if(_ppt(array('search', 'featured')) == "" || _ppt(array('search', 'featured')) == 1){ ?>
        <a href="javascript:void(0);" data-key="featured"><span><?php echo __("Featured","premiumpress"); ?><i></i></span></a>
        <?php } ?>
        
        <?php }elseif(in_array(THEME_KEY, array('ct'))){ ?>
        
        <?php if(_ppt(array('search', 'featured')) == "" || _ppt(array('search', 'featured')) == 1){ ?>
        <a href="javascript:void(0);" data-key="featured" class="hide-mobile"><span><?php echo __("Featured","premiumpress"); ?><i></i></span></a>
        <?php } ?>
        
        <a href="javascript:void(0);" data-key="price"><span><?php echo __("Price","premiumpress"); ?><i></i></span></a>
        
        <?php }elseif(in_array(THEME_KEY, array('cp'))){ ?>
        
         <a href="javascript:void(0);" data-key="expiry"><span><?php echo __("Ending","premiumpress"); ?><i></i></span></a>
         
         <a href="javascript:void(0);" data-key="lastused" class="hide-mobile"><span><?php echo __("Last Used","premiumpress"); ?><i></i></span></a>
          
          
         <?php }elseif(in_array(THEME_KEY, array('sp'))){ ?>
            
           <a href="javascript:void(0);" data-key="price"><span><?php echo __("Price","premiumpress"); ?><i></i></span></a>
          
           <?php }elseif(in_array(THEME_KEY, array('pj'))){ ?>
            
           <a href="javascript:void(0);" data-key="price"><span><?php echo __("Budget","premiumpress"); ?><i></i></span></a>
           
		  <?php }elseif(in_array(THEME_KEY, array('so'))){ ?>
            
             <a href="javascript:void(0);" data-key="price"><span><?php echo __("Price","premiumpress"); ?><i></i></span></a>
          
          
           <a href="javascript:void(0);" data-key="downloads"><span><?php echo __("Downloads","premiumpress"); ?><i></i></span></a>
          
           <?php }elseif(in_array(THEME_KEY, array('ph'))){ ?>
          
           <a href="javascript:void(0);" data-key="downloads"><span><?php echo __("Downloads","premiumpress"); ?><i></i></span></a>
          
          
         <?php } ?>
                  
        
         
        <?php if($CORE->LAYOUT('captions','maps') && _ppt(array('maps','enable')) == 1 && _ppt(array("maps","provider")) != "basic" && _ppt(array('search','filters_distance')) == 1 ){ ?>
        
         <?php if( isset($_GET['zipcode']) && strlen($_GET['zipcode'] > 2) || ( isset($_SESSION['mylocation']) && is_numeric($_SESSION['mylocation']['log']) && is_numeric($_SESSION['mylocation']['lat']) ) ){ ?>
         
          <a href="javascript:void(0);" data-key="distance" <?php if(isset($_GET['sortby']) && $_GET['sortby'] == "distance"){ ?>class="active up"<?php } ?> class="distancef"><span><?php echo __("Distance","premiumpress"); ?><i></i></span></a>
         
         <?php }else{ ?>
          <a href="javascript:void(0);" onclick="jQuery('#zipcodesearch').css('border-color', 'red').focus();" class="distance-filter-click"><span><?php echo __("Distance","premiumpress"); ?><i></i></span></a>
         
         
         <?php } ?>
                 
          
         <?php } ?> 
           
      </div>
      
       
      
      <input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" />
   </div>
   <div class="col-md-4 col-lg-4  d-none d-lg-block text-right">
   
   
  <?php if(_ppt(array('search','cardswicth')) != 1){ ?>
      <div class="filter_sortby t2">
      	
       
         <a class="btn_filt px-3"  <?php if(isset($GLOBALS['flag-search-style']) && $GLOBALS['flag-search-style'] != 7){ ?> style="display:none !important;" <?php } ?> data-toggle="collapse" href="#filters-extra"><i class="fal fa-sliders-h"></i> <?php echo __("Filters","premiumpress"); ?></a> 
        
          <?php if(isset($GLOBALS['flag-search-style']) && $GLOBALS['flag-search-style'] != 7){ ?>
          
          <?php if(in_array(THEME_KEY, array('pj','ph'))){ ?>
          
          <?php }else{ ?>
          
             <a href="javascript:void(0);" class="active" onclick="jQuery(this).addClass('activex');_updatecardlayout('grid4')"><i class="fa fa-th"></i></a>
             <?php if($CORE->LAYOUT("captions","perrow") == 4){ ?>
             <a href="javascript:void(0);" onclick="jQuery(this).addClass('activex');_updatecardlayout('grid3')"><i class="fal fa-grip-horizontal"></i></a>
             <?php } ?>  
             <a href="javascript:void(0);" onclick="jQuery(this).addClass('activex');_updatecardlayout('list2')"><i class="fal fa-grip-vertical"></i></a>
             <a href="javascript:void(0);" onclick="jQuery(this).addClass('activex');_updatecardlayout('list1')"><i class="fal fa-list"></i></a>
             <?php if($CORE->LAYOUT('captions','maps') && isset($GLOBALS['flag-search']) && _ppt(array("maps","enable")) == 1 && _ppt(array("maps","provider")) != "basic"  && !isset($GLOBALS['set-searchmap'])  ){ ?>
             <a  onclick="jQuery(this).addClass('activex');" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" class="loadmainmap"><i class="fa fa-map-marker"></i></a>
             <?php } ?>
             
             <?php } ?>
         
         <?php } ?>
         
      </div>
      <?php } ?>
   </div>
</div>

<?php if($CORE->ADVERTISING("check_exists", "search_top") ){ ?>
<div class="mb-3 mt-n4 text-center ">
   <hr />
   <?php echo $CORE->ADVERTISING("get_banner", "search_top" );  ?> 	
   <hr />
</div>
<?php } ?>



<?php /*************************************/ ?>

<div class="bg-white p-4 border text-center font-weight-bold text-muted" id="noresults" style="display:none;">
<div class="py-5"><?php echo __("No Results Found","premiumpress"); ?></div> 
</div>

<?php /*************************************/ ?>
<div id="ajax-sponsor-output" class="mb-2"></div>
<div id="ajax-search-output" class="mb-2"></div>
<?php if($CORE->ADVERTISING("check_exists", "search_bottom") ){ ?>
<div class="mb-3 text-center ">
   <hr />
   <?php echo $CORE->ADVERTISING("get_banner", "search_bottom" );  ?> 	
</div>
<?php } ?>
<div id="ajax-navbar-showhide">
   <div class="d-flex justify-content-center align-items-center py-2 small text-muted letter-spacing-1  my-4 pt-3">
      <?php /*<div><span class="ajax-search-found">100</span> <?php echo __("results","premiumpress"); ?> </div> */ ?>
      <div class="ajax-search-pagenav pagination-md"><div class="text-center my-5 py-5 w-100"><i class="fa fa-spinner fa-5x fa-spin text-primary"></i></div> </div>
      <?php /* <div><?php echo __("Page","premiumpress"); ?>  <span class="ajax-search-page">1</span>/<span class="ajax-search-pageof">10</span></div>*/ ?>
   </div>
   <div class="text-center small opacity-5 mt-n4 tiny text-uppercase"><span class="ajax-search-found">100</span> <?php echo __("results found","premiumpress"); ?> </div>
</div>


<?php /*************************************/ ?>
<script>
   jQuery(document).ready(function(){ 
   	
   	_updateselected('no');
   
   });  
</script>

<?php /*************************************/ ?>

<?php if(!defined('WLT_DEMOMODE') && isset($GLOBALS['flag-taxonomy']) && strlen(_ppt('category_description_'.$GLOBALS['flag-taxonomy-id'])) > 1){  ?>
<div class="mt-4">
<?php echo wpautop(_ppt('category_description_'.$GLOBALS['flag-taxonomy-id'])); ?>
</div>
<?php } ?>

 