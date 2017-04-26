<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */

?>
<div class="page-wrap">
<a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a> 
  
<div class="row">
    <div class="txt-col-2">
        <?php the_content(); ?>
    </div>
</div>
</div>