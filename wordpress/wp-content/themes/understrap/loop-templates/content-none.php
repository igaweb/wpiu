<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */
?>

<div class="page-wrap">
<a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a>

<section class="no-results not-found">

	<header class="page-header">

		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'understrap' ); ?></h1>

	</header><!-- .page-header -->

	<div class="page-content">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'understrap' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'understrap' ); ?></p>
			<?php
				get_search_form();
		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'understrap' ); ?></p>
			<?php
				get_search_form();
		endif; ?>
	</div><!-- .page-content -->
	
</section><!-- .no-results -->
</div>