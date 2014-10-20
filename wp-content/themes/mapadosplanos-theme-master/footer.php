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
				<strong><?php bloginfo( 'name' ); ?></strong>
				<br/>
				Telefone: (11) 3151-2333 - Ramais 130 e 170 &bull; <a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>">Entre em contato</a>
				<br/> 
				<a href="<?php echo esc_url( home_url( '/termo-de-uso/' ) ); ?>">Termo de uso</a> &bull; 
				<a href="<?php echo esc_url( home_url( '/creditos/' ) ); ?>">Créditos</a> &bull; 
				<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.pt" target="_blank">Creative Commons</a> &bull; 
				<a href="<?php echo esc_url( __( 'http://br.wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Desenvolvido com WordPress', 'twentytwelve' ); ?>">WordPress</a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
