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
		
    	<div id="logo-footer"><a href="<?php bloginfo('url'); ?>" class="a-logo-footer"></a></div>
		<div id="dados-footer">
	  <div id="endereco-footer"><?php echo get_option ('mo_endereco'); ?> - <?php echo get_option ('mo_bairro'); ?> - <?php echo get_option ('mo_cidade'); ?></div>
        <div id="contato-footer"><?php echo get_option ('mo_telefone'); ?> - <?php echo get_option ('mo_email'); ?></div>
		<div id="descricao-footer"><?php bloginfo( 'description' ); ?></div>
	</div>
	<div id="apoiadores">
		<h2>REDES SOCIAIS</h2>
		<div id="menu-redes-sociais">
					<a href="<?php echo stripslashes (get_option('mo_url_twitter')); ?>" class="link_twitter" target="_blank"></a>
					<a href="<?php echo stripslashes (get_option('mo_url_face')); ?>" class="link_facebook" target="_blank"></a>
					<a href="<?php echo stripslashes (get_option('mo_url_youtube')); ?>" class="link_youtube" target="_blank"></a>
			</div><!-- #menu-footer-d -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>