<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */

?>

  
<div class="row page-wrap">
    
<a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a> 

    <div class="col-md-4 hidden-sm-down">
        
        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
            <div class="sidebar">
                    <?php dynamic_sidebar( 'left-sidebar' ); ?>
            </div>
        <?php endif; ?>
        
    </div>
    
    <div class="col-md-8 col-sm-12">
        <?php the_content(); ?>
    </div>
    
    
    <div class="col-md-12 hidden-md-up">
        
        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
            <div class="sidebar">
                    <?php dynamic_sidebar( 'left-sidebar' ); ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>
