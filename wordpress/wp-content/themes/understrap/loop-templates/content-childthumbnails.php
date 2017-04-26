<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */
?>

<div class="page-wrap">
<a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a>
  <?php  
  
    global $post;
    $backup = $post;
    
    

// get the feature image of all direct child pages
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

            //print_r($post);
            ?>
            <a class="thumbnail"  href="<?php the_permalink(); ?>">
                <div style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID ); ?>');">

                    <div class="content-fluid " >
                        <div class="title-box">
                            <h1 class="title-text" style="display:none;">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        
                    </div>
                </div>
            </a>


<?php
        endwhile;

    endif; wp_reset_query();
    
    $post=$backup;
    
?>
</div>

<script>

    window.onload = function () {
        setTextWithinSpan("title-text");
    };
</script> 