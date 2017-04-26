<?php
/**
 * Template Name: HOME Page Template
 *
 * Template for displaying a blank page.
 *
 * @package understrap
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title"
	      content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body>

    <?php get_header(); ?>
    
<?php 

$parentPages = new WP_Query();
while ( have_posts() ) : the_post(); 

    global $post;
    $backup = $post;
    
    /** header for home page **/ 
    ?>
    
    <div class="row">
        <div style="background:url('<?php echo get_the_post_thumbnail_url( $post->ID ); ?>') no-repeat 100%;" class="col-md-12 homepage" >

        </div>
    </div>
    
    
        <div class="row">
            <div class="col-md-12">
                <?php if(get_the_title() != "") { ?>
                <header class="entry-header">

                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                </header><!-- .entry-header -->
                <?php } ?>
                <div class="entry-content">

                        <?php the_content(); ?>


                </div><!-- .entry-content -->
            </div>
        </div>

    <?php /** load nested pages in home for each page **/  
    
    
   
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

            get_template_part( 'loop-templates/content', 'homepage' );

        endwhile;

    endif; wp_reset_query();
    
    $post=$backup;
    
    ?>
    
<?php endwhile; // end of the loop. ?>
<?php wp_footer(); ?>
</body>
</html>
