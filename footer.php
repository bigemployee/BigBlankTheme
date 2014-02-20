<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Big_Blank
 * @since Big Blank 2.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
				<?php do_action( 'bigblank_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://bigblanktheme.com/', 'bigblank' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'bigblank' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>