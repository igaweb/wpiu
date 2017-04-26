<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */

?>

<div class="row page-wrap">
    
    <a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a> 
  
    <div class="col-md-4 col-sm-12 col-sm-12">
        
        <?php if ( is_active_sidebar( get_post_custom_values('sidebar_name')[0] ) ) : ?>
            <div class="sidebar">
                    <?php dynamic_sidebar( get_post_custom_values('sidebar_name')[0] ); ?>
            </div>
        <?php endif; ?>
        
    </div>
    
    <div class="col-md-8 col-sm-12">
        <?php the_content(); ?>
    </div>
</div>
