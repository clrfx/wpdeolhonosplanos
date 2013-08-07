<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		
			<div>
	
			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				
				if ( ! is_404() )
					get_sidebar( 'footer' );
				
			?>
			</div>
 
    	<div id="logo-footer"><a href="<?php bloginfo('url'); ?>" class="a-logo-footer"></a></div>
		<div id="dados-footer">
	  <div id="endereco-footer"><?php echo get_option ('mo_endereco'); ?> - <?php echo get_option ('mo_bairro'); ?> - <?php echo get_option ('mo_cidade'); ?></div>
        <div id="contato-footer"><?php echo get_option ('mo_telefone'); ?> - <?php echo get_option ('mo_email'); ?></div>
		<div id="descricao-footer"><?php bloginfo( 'description' ); ?></div>
	</div>
	<div id="apoiadores">
		<h2>Footer com Widgets</h2>
		<p></p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>