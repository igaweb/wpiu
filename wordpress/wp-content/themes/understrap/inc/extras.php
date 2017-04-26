<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function understrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'understrap_body_classes' );

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'adjust_body_class' );

if ( ! function_exists( 'adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'change_logo_class' );

if ( ! function_exists( 'change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-responsive"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"' , $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'understrap_post_nav' ) ) :

	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<div class="row">
			<div class="col-md-12">
				<nav class="navigation post-navigation">
					<h2 class="sr-only"><?php _e( 'Post navigation', 'understrap' ); ?></h2>
					<div class="nav-links">
						<?php

							if ( get_previous_post_link() ) {
								previous_post_link( '<span class="nav-previous float-xs-left">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'understrap' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<span class="nav-next float-xs-right">%link</span>',     _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'understrap' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
			</div>
		</div>
		<?php
	}
endif;



/**
 * Get menu ID with containing url
 * 
 * 
 * @param integer $id Post ID
 * @param String $urlToSearch String to search in menus urls
 * @param string $theme_location Menu location. If not sent, primary will be used
 */
if ( ! function_exists( 'understrap_get_menu_ID_with_containing_url' ) ) {

        function understrap_get_menu_ID_with_containing_url($id, $urlToSearch = '', $theme_location = 'primary') {
            
            if ( $urlToSearch != '' && ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
                $locations = get_nav_menu_locations();
                $menu = get_term( $locations[$theme_location], 'nav_menu' );
                $menu_items = wp_get_nav_menu_items($menu->term_id);

                foreach ($menu_items as $menu_item) {

                    if( strpos($menu_item->url, $urlToSearch) ) {
                        $menuId = $menu_item->ID;
                        
                        return $menuId;
                    }
                }
            }
        }
}


/**
 * Code to be executed for the gallery shortcode
 * 
 * This function is applied once, in wp-includes/media.php - in gallery_shortcode() on line 1648
 * 
 * @param string $output (required) The current output - the WordPress core passes an empty string. Default: ""
 * @param array $atts (required) The attributes from the gallery shortcode. Default: None
 * @param int $instance (required) Unique numeric ID of this gallery shortcode instance. Default: None
 * @return type
 */
if ( ! function_exists( 'understrap_gallery_shortcode' ) ) {

    function understrap_gallery_shortcode( $output = '', $atts, $instance ) {
            $return = $output; // fallback

            // retrieve content of your own gallery function
            $my_result = get_my_gallery_content( $atts );

            
            // boolean false = empty, see http://php.net/empty
            if( !empty( $my_result ) ) {
                $return = $my_result;
            }
            
            return $return;
    }

    add_filter( 'post_gallery', 'understrap_gallery_shortcode', 10, 3 );
}
