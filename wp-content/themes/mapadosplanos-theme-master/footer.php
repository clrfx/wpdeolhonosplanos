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

		<div class="site-info clearfix">
			<div class="site-info-general site-info-col">
				<span class="site-name"><?php bloginfo( 'name' ); ?></span>
				<br/>
				Telefone: (11) 3151-2333 - Ramais 130 e 170
				<br/><a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>">Entre em contato</a>
				<br/>
				<ul class="site-credits">
					<a href="<?php echo esc_url( home_url( '/termo-de-uso/' ) ); ?>">Termo de uso</a> &bull; 
					<a href="<?php echo esc_url( home_url( '/creditos/' ) ); ?>">Créditos</a> &bull; 
					<a href="<?php echo esc_url( __( 'http://br.wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Desenvolvido com WordPress', 'twentytwelve' ); ?>">WordPress</a>
				</ul><!-- .site-credits -->
			</div>
			<div class="site-info-cc site-info-col">
				Este trabalho está licenciado com uma Licença <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons &ndash; Atribuição 4.0 Internacional</a>.<br/>
				Esta licença permite que outros distribuam, remixem, adaptem e criem a partir do seu trabalho, mesmo para fins comerciais, desde que lhe atribuam o devido crédito pela criação original.
				<br/><br/><a rel="license" href="http://creativecommons.org/licenses/by/3.0/br/" title="Este obra está licenciado com uma Licença Creative Commons Atribuição 3.0 Brasil"><img alt="Licença Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/3.0/br/80x15.png" /></a>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
