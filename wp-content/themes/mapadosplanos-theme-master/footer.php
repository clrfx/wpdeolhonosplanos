<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="row-fluid">
		<div id="footer-a">
			<?php if ( is_active_sidebar( 'footer-a' ) ) : ?>
				<?php dynamic_sidebar( 'footer-a' ); ?>
			<?php endif; ?>
		</div>
		
		<div id="footer-b">
			<?php if ( is_active_sidebar( 'footer-b' ) ) : ?>
				<?php dynamic_sidebar( 'footer-b' ); ?>
			<?php endif; ?>
		</div>
		
		<div id="footer-c">
			<?php if ( is_active_sidebar( 'footer-c' ) ) : ?>
				<?php dynamic_sidebar( 'footer-c' ); ?>
			<?php endif; ?>
		</div>
		
		</div>
			<div class="site-info">
				<?php bloginfo( 'name' ); ?> <?php echo date('Y'); ?> - 
				Sob uma Licen&ccedil;a <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.pt" target="_blank">Creative Commons</a> - 
				<a href="<?php echo esc_url( home_url( '/creditos/' ) ); ?>">Cr&eacute;ditos</a> - 
				<a href="<?php echo esc_url( __( 'http://br.wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Desenvolvido com WordPress', 'twentytwelve' ); ?>"><?php printf( __( 'Desenvolvido com %s', 'twentytwelve' ), 'WordPress' ); ?></a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
