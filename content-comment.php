<?php global $comment, $settings, $args, $post_authorID; 
   
   if(!is_array($args)){ $args = array(); }
   
   // CHECK FOR PHOTO
   $photo = get_comment_meta( $comment->comment_ID, 'photo', true );
    
   
   ?>
<div class="comment-single">
   <div class="row">
      <div class="col-12">
         <div class="row">
            <div class="col-2 text-center">
              
               
               
                 <?php if(isset($comment->comment_ID)){ ?>
                  <?php if(get_comment_meta( $comment->comment_ID, 'rating1', true ) != ""){  
                     $rating = get_comment_meta( $comment->comment_ID, 'ratingtotal', true );  ?>
                  <div class="review-score-user mt-3">
                     <span>
                     <?php echo number_format($rating,1); ?></span>
                     <?php 
                        if($rating == 5){
                        echo '<i class="fal fa-laugh-beam"></i>';
                        }elseif($rating > 2){
                        echo '<i class="fal fa-smile"></i>';
                        }else{
                        echo '<i class="fal fa-frown"></i>';
                        }
                        ?>
                        <?php /*
                     <strong><?php 
                        if($rating == 5){
                        echo __("Very Good","premiumpress");
                        }elseif($rating > 2){
                        echo __("Good","premiumpress");
                        }else{
                        echo __("Bad","premiumpress");
                        }
                        ?></strong> */ ?>
                  </div>
                  <?php } ?> 
               
            </div>
            <div class="col-10">
               <div class="comment-area">
               
                <?php if(!in_array(THEME_KEY, array("sp","cm","vt")) ){ ?>
                     <div class="author">
                  <a href="<?php echo get_author_posts_url( $post_authorID ); ?>">
                  <?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?>
                  </a>
               </div>
               <?php } ?>
                  <?php if(!in_array(THEME_KEY, array("sp","cm")) ){ ?>
                  <h5 class="pb-0">
                     <?php comment_author(); ?>
                     <?php  /*if(isset($authora->ID) && $authora->ID == $post_authorID){ ?>
                     <span class="badge badge-success float-right"><?php echo __("Author","premiumpress"); ?></span>					
                     <?php }  */ ?>
                  </h5>
                  <?php } ?>
                  <div class="<?php if(!in_array(THEME_KEY, array("sp","cm","vt")) ){ ?>small<?php } ?>">&quot; <?php echo $comment->comment_content; ?> &quot;</div>
                  <?php if(is_array($photo) && strlen($photo['src']) > 1){ ?>
                  <div class="attachment">
                     <a href="<?php echo $photo['src']; ?>" data-toggle="lightbox" data-type="image"><img src="<?php echo $photo['thumb']; ?>" alt="attachment" /></a>
                  </div>
                  <?php } ?>
                  <?php if ($comment->comment_approved == '0') : ?>
                  <p class="small">Your comment is awaiting moderation.</p>
                  <?php endif; ?>
                  <?php } ?>
               </div>
               <?php if(!in_array(THEME_KEY, array("mj","ct","sp","cm","vt")) ){ ?>
               <div class="bottom pt-3">
                  <?php  edit_comment_link(__("Edit Comment","premiumpress"),'',''); ?>
                  <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => 1,   'max_depth' => 5)), $comment->comment_ID) ?> 
                  <div class="small text-muted"><i class="fal fa-calendar mr-2"></i> <?php if(isset($comment->comment_ID)){ echo get_comment_date(); } ?></div>
               </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>