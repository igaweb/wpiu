<?php
/**
 * Template Name: Left Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */


    global $post;
    $backup = $post;
    

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>


<?php

// if page has submenus, display those pages also
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );

$parent = new WP_Query( $args );

$featImg = "";
$sidebarContent = "";
if ( $parent->have_posts() ) : 

    while ( $parent->have_posts() ) : $parent->the_post();

        $sidebarContent = wpautop(get_the_content());
        $featImg = get_the_post_thumbnail_url( $post->ID );

    endwhile;

endif; wp_reset_query();

$post=$backup;

$backImg = sizeof($featImg) > 0 ? $featImg :get_the_post_thumbnail_url( $post->ID );
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php /** header for home page **/ ?>
                <div class="row" >
                    <div class="col-md-12 page-feat-img"style="background:url('<?php echo $backImg; ?>') no-repeat 100%;background-position-y: bottom;" >

                        <?php if(get_the_title() != "") { ?>
                        <div class="content-fluid " >
                            <div class="title-box">
                                <h1 class="title-text" style="display:none;">
                                    
                                    <?php
                                        echo get_the_title( $post->post_parent );
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
		<div class="row page-content">
                    <div class="col-md-4 col-sm-12">
                        <div class="sidebar">
                            
                            <?php echo $sidebarContent; ?>
                            
                            </div>
                        </div>
			<div
				class="<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
                                                the_content();
						?>

					<?php endwhile; // end of the loop. ?>
                                    
                                    <div class="col-md-12 text-center">
                                        <?php
                                        
                                        // get all page children to get previous and next link
                                        $pagelist = get_pages(
                                                ['child_of' => $post->post_parent,
                                                'parent' => $post->post_parent,
                                                'sort_column'   => 'menu_order',
                                                'sort_order'   => 'ASC']);
                                        $pages = array();
                                        foreach ($pagelist as $page) {
                                           $pages[] += $page->ID;
                                           
                                           if($post->ID == $page->ID) {
                                               $current = sizeof($pages) - 1;
                                           }
                                        }
                                        
                                        $prevID;
                                        if($current > 0) {
                                            $prevID = $pages[$current-1];
                                        }
                                        
                                        $nextID;
                                        if(sizeof($pages) > ($current+1) ) {
                                            $nextID = $pages[$current+1];
                                        }
                                        
                                        $nextLink = "";
                                        $previousLink = "";
                                        
                                        if (isset($prevID)) {
                                            $previousLink = get_permalink($prevID);
                                        }
                                        
                                        if (isset($nextID)) {
                                            $nextLink = get_permalink($nextID);
                                        }
                                        
                                        
                                        
                                        if(!empty($previousLink)) {
                                            ?>
                                            <a href="<?php echo $previousLink; ?>" class="previous-post active"><i class="fa fa-chevron-circle-left"></i></a>
                                            <?php
                                        } else {
                                            
                                            ?>
                                            <span class="previous-post disabled"><i class="fa fa-chevron-circle-left"></i></span>
                                            <?php
                                        }
                                        
                                        // find menu item to set action to get back to previous page
                                        $anchor = get_post_custom_values('homepage_anchor', $post->post_parent)[0];
                                        $menuId = understrap_get_menu_ID_with_containing_url($post->post_parent, $anchor);

                                        ?>
                                            <button onclick="triggerClick('<?php echo "menu-item-" .$menuId; ?>');" class="all-posts active"><i class="fa fa-th"></i></button>
                                        <?php
                                        
                                        if(!empty($nextLink)) {
                                            ?>
                                            <a href="<?php echo $nextLink; ?>" class="next-post active"><i class="fa fa-chevron-circle-right"></i></a>
                                            <?php
                                        } else {
                                            
                                            ?>
                                            <span class="next-post disabled"><i class="fa fa-chevron-circle-right"></i></span>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

</article>
<?php get_footer(); ?>


<?php if(get_the_title() != "") { ?>
    <script>
        
        function triggerClick (menuId) {
            $("#" + menuId + " a")[0].click();
        }
        
        window.onload = function () {
            setTextWithinSpan("title-text");
        };
    </script> 
<?php } ?>
