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

	$video_ID = get_post_meta( $post->ID, '_featured_video', true );

	if ( ! empty ( $video_ID ) ) {
		echo '<div class="wrapper-video">';
		//echo wp_oembed_get( $video_url, array( 'height' => 215 ) );
		echo '<iframe height="215" src="http://www.youtube.com/embed/' . $video_ID . '?feature=oembed" frameborder="0" allowfullscreen></iframe>';
		echo '</div>';
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
				<a href="http://www.rededeolhonosplanos.org.br" target="_blank">
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
				<a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/" target="_blank">
					<h2 class="prateleira-item-title">Indicadores da Qualidade na Educação</h2>
					<p class="prateleira-item-description">Avaliação: conheça nossa proposta de autoavaliação participativa para as escolas</p>
					<span class="mais">+</span>
				</a>
			</li>
		</ul>
	</div><!-- .prateleira -->
	<?php
}