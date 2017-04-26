<?php
/**
 * Partial template for content in home.php
 *
 * @package understrap
 */

    global $post;
    $backup = $post;
    
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    
    <div class="init row" >
        
        
        
        
    <?php
    
    if(get_the_post_thumbnail_url( $post->ID )) {
        ?>
        
        
        <div class="col-md-12 homepage" style="background:url('<?php echo get_the_post_thumbnail_url( $post->ID ); ?>') no-repeat 100% transparent;background-position-y: bottom;background-position-x: center;" >
            
            <?php if(get_the_title() != "") { ?>
            <div class="content-fluid " >
                <div class="title-box">
                    <h1 class="title-text" style="display:none;">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
            <?php } ?>
        </div>
        
        
    <?php } else { ?>
        
        <div class="col-md-12 homepage no-img" >
            <bloquote><?php the_title(); ?></bloquote>
        </div>
        
    <?php } ?>
        
        
        
        
    </div>
    
    <div class="page-wrap">
    <a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a>
    
    <div class="row page-content" style="display:none;">
        
        <div class="col-md-12" >
            
            <div class="content-fluid " >
                <div class="content-box">
                    
                        <?php
                        
                        //print_r($post);
                        
                        get_template_part( 'loop-templates/content', get_post_custom_values('homepage_template')[0] );
                        
                        
                        
                        
                        if(!get_post_custom_values('hide_children')[0] && get_post_custom_values('homepage_template')[0] != "childthumbnails") {
                            
                            // if page has submenus, display those pages also
                            $args = array(
                                'post_type'      => 'page',
                                'posts_per_page' => -1,
                                'post_parent'    => $post->ID,
                                'order'          => 'ASC',
                                'orderby'        => 'menu_order'
                             );

                            $parent = new WP_Query( $args );

                            if ( $parent->have_posts() ) : 

                                while ( $parent->have_posts() ) : $parent->the_post();

                                    get_template_part( 'loop-templates/content', get_post_custom_values('homepage_template')[0] );

                                endwhile;

                            endif; wp_reset_query();

                            $post=$backup;
                        }
                        
                        
                        
                        ?>
                    
                    </p>
                </div>
            </div>
            
        </div>
    </div>
    <div class="close-page"><i class="fa fa-chevron-circle-down"></i></div>
    
    </div>
    
    
    
        <?php if(get_the_title() != "") { ?>
    <script>

        window.onload = function () {
            setTextWithinSpan("title-text");
        };
    </script> 
        <?php } ?>

    <?php
    /**
	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->
**/
    ?>
</article><!-- #post-## -->
