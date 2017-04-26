<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = '';//get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        
	<?php wp_head(); ?>
        
</head>

<body <?php body_class(); ?>>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1469135-3', 'auto');
  ga('send', 'pageview');

</script>

<div class="hfeed site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
		'understrap' ); ?></a>

		<nav class="navbar navbar-toggleable-md navbar-toggleable-sm navbar-fixed-top">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>
                            
                            <div class="col-md-2 col-sm-12 col-xs-12 logo-wrapper">
                                
                                <!-- Your site title as branding in the menu -->
                                <?php if ( ! has_custom_logo() ) { ?>

                                        <?php if ( is_front_page() && is_home() ) : ?>

                                                <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

                                        <?php else : ?>

                                                <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

                                        <?php endif; ?>


                                <?php } else {
                                        the_custom_logo();
                                } ?><!-- end custom logo -->
                                
                                <div class="navbar-toggler-wrapper hidden-md hidden-lg">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon fa fa-bars" id="hamburguer"></span>
                                    </button>
                                </div>
				

                            
                            
                            </div>
                            <div class="col-md-2 col-sm-8 col-xs-8 second-logo">
                                <span><?php echo _x('um projeto', 'understrap header for second brand');?></span>
                                <img class="img-responsive" src="/wp-content/uploads/logotipo_verde_novo.png">
                            </div>
                            <div class="col-md-8 menu-wrapper">
				<!-- The WordPress language Menu goes here -->
                                <div class="row">
                                    <div class="col-12">

                                        <?php wp_nav_menu(
                                                array(
                                                        'theme_location'  => '',
                                                        'container_class' => 'collapse navbar-collapse',
                                                        'container_id'    => 'navbar-lang',
                                                        'menu_class'      => 'navbar-nav',
                                                        'fallback_cb'     => '',
                                                        'menu_id'         => 'lang',
                                                        'walker'          => new WP_Bootstrap_Navwalker(),
                                                )
                                        ); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        
                                        <?php wp_nav_menu(
                                                array(
                                                        'theme_location'  => 'primary',
                                                        'container_class' => 'collapse navbar-collapse',
                                                        'container_id'    => 'navbar-main',
                                                        'menu_class'      => 'navbar-nav',
                                                        'fallback_cb'     => '',
                                                        'menu_id'         => 'main-menu',
                                                        'walker'          => new WP_Bootstrap_Navwalker(),
                                                )
                                        ); ?>

                                        
                                        <script>
                                            
                                            $ = jQuery;
                                            
                                            
                                            $(document).ready(function(){
                                            <?php
                                            
                                            $lang=get_bloginfo("language");
                                            
                                            // get menu items of current language
                                            if($lang == "pt-PT") {
                                                $menu_items = wp_get_nav_menu_items("main-menu"); 
                                            } else if($lang == "en-GB") {
                                                $menu_items = wp_get_nav_menu_items("main-menu-en"); 
                                            } else if($lang == "fr-FR"){
                                                $menu_items = wp_get_nav_menu_items("main-menu-fr"); 
                                            } else {
                                                $menu_items = wp_get_nav_menu_items("main-menu"); 
                                            }
                                            
                                            if (is_array($menu_items) || is_object($menu_items)) {
                                                // re-set the url of all items to enable the click event on menu items with submenus
                                                foreach( $menu_items as $menu_item ) {

                                                    ?>
                                                            $("#menu-item-<?php echo $menu_item->object_id;?> a").attr("href", "<?php echo $menu_item->url; ?>");<?php
                                                }
                                            }
                                            ?>
                                                });
                                            </script>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                                
                            </div>    
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- .wrapper-navbar end -->
