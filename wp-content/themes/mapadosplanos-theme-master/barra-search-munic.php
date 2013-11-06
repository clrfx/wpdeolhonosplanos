<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<div id="barra-mapa" class="search">

		<div id="content-mapa">
		
			<div id="box-below-map">
			<span><a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>"> Como Usar?</a></span>
			</div>
			
			<div id="box-below-map">
			<span><a href="<?php echo esc_url( home_url( '/participe/' ) ); ?>"> Participe!</a></span>
			</div>
			
			<div id="box-below-map" class="last">
			<span class="box-busca-mapa">Pesquisa no Mapa</span>
			<?php get_template_part( 'searchform-munic' ); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	