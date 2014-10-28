<?php
/**
 * Find the first video occurence in a post that has the 'video' format
 * and create a iframe for it
 *
 * @todo Find a way to use it strictly with registered video providers
 * 
 */
function mapadosplanos_the_video() {

	global $post;

	// Get all the post meta
	$post_meta = get_post_custom( $post->ID );

	foreach ( $post_meta as $key => $value ) {
		// Search for _oembed_ keys
		$pos = strpos($key, '_oembed_');
		if ( $pos !== false ) {

			// Remove predefined proportions
			$v = preg_replace( '/(width|height)="\d*"\s/', "", $value );
			
			if ( ! empty( $v[0] ) && $v[0] != '{{unknown}}'  ) {
				echo '<div class="wrapper-video">';
				echo $v[0];
				echo '</div>';
			}

			// We just want the first one
			break;
		}					
	}
}

/**
 * Show quick links for the Prateleira / Mão na Massa section
 */
function mapadosplanos_the_prateleira_list() {
	?>
	<div class="prateleira clearfix">
		<ul class="prateleira-list">
			<li class="prateleira-item">
				<a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">
					<h2 class="prateleira-item-title">Rede De Olho</h2>
					<p class="prateleira-item-description">Participe e troque informações com pessoas de todo o país sobre os Planos Municipais de Educação</p>
					<span class="mais">+</span>
				</a>
			</li>
			<li class="prateleira-item">
				<a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">
					<h2 class="prateleira-item-title">Coleção</h2>
					<p class="prateleira-item-description">Faça o download dos materiais do De Olho nos Planos e se junte a esta iniciativa!</p>
					<span class="mais">+</span>
				</a>
			</li>
			<li class="indicadores-qualidade prateleira-item">
				<a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">
					<h2 class="prateleira-item-title">Indicadores da Qualidade na Educação</h2>
					<p class="prateleira-item-description">Avaliação: conheça nossa proposta de autoavaliação participativa para as escolas</p>
					<span class="mais">+</span>
				</a>
			</li>
		</ul>
	</div><!-- .prateleira -->
	<?php
}