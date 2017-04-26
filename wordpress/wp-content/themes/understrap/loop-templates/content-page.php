<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="page-wrap">
    <a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a>

    <div class="col-md-8 col-sm-12">
        <?php the_content(); ?>
    </div>
    
    </div>
</article><!-- #post-## -->
