<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<div style="display:none;">
	<?php 
	    global $custom_fields;
	    $custom_fields = get_post_custom(the_ID());
	?></div>

	<article id="post-<?php the_ID(); ?>" <?php post_class('media'); ?>>
	
	
	
			<div class="entry-content img-polaroid pull-left" id="mapa">
            <?php 
		global $custom_fields;
		echo do_shortcode("[mapbox layers='acaoeducativa.mapadosplanos' api='' options='' lat='" . $custom_fields['lat'][0] . "' lon='" . $custom_fields['lng'][0] . "' z='7' width='250' height='250']"); ?>
			<!-- <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?> -->
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
	
	
	
		<header class="entry-header media-body">
			<?php the_post_thumbnail(); ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>



			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?> <strong>&middot;</strong> <span class="anexos"> 
					<?php
              if( function_exists( 'attachments_get_attachments' ) )
              {
                $attachments = attachments_get_attachments();
                $total_attachments = count( $attachments );
                if ($total_attachments == 0) {
                echo "Nenhum anexo";
                } else {
                	echo $total_attachments . " anexos";
                	
                }
             } ?></span>

		<!-- FIM DOS ATTACHMENTS -->
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			
					<div class="entry-summary">
			<?php  the_excerpt(); ?>
		</div><!-- .entry-summary -->
		
				<!-- EXIBICAO DOS CUSTOMFIELDS -->

        <?php
		global $custom_fields;
/*echo '<div id="fichaae" class="well fichas">';
echo '<span class="titulo" >Respostas do município </span>';
echo edit_post_link('[responder]', '<span class="edit-link">', '</span>' );
echo '<hr />';
echo '<div class="questaoae">Seu município possui plano de educação em vigência?</div> <div id="resposta" class="text-info">' . $custom_fields['Q1'][0] . '</div>';
echo '<div class="questaoae"> Quando o plano de educação foi aprovado?</div> <div id="resposta" class="text-info">' . $custom_fields['Q2'][0] . '</div>';
echo '<div class="questaoae"> O plano de educação já foi revisado nos últimos quatro anos?</div> <div id="resposta" class="text-info">' . $custom_fields['Q3'][0] . '</div>';
echo '<div class="questaoae">Seu município está elaborando um plano de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q4'][0]. '</div>';
echo '<div class="questaoae">Seu município pretende elaborar um plano de educação nesta gestão (2013-2016)?</div> <div id="resposta" class="text-info">' . $custom_fields['Q5'][0]. '</div>';
echo '<div class="questaoae">Seu município pretende revisar o plano de educação nesta gestão (2013-2016)?</div> <div id="resposta" class="text-info">' . $custom_fields['Q6'][0]. '</div>';
echo '<div class="questaoae">Em qual momento da elaboração se encontra?</div> <div id="resposta" class="text-info">' . $custom_fields['Q7'][0]. '</div>';
echo '<div class="questaoae">O município contratou ou pretende contratar algum tipo de consultoria externa para elaboração do plano de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q8'][0]. '</div>';
echo '<div class="questaoae">Quais dos órgãos/instâncias abaixo participam ou participaram da elaboração do plano de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q9'][0]. '</div>';
echo '<div class="questaoae">Quais das organizações/movimentos abaixo participam ou participaram da elaboração do plano de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q10'][0]. '</div>';
echo '<div class="questaoae">Dos segmentos da comunidade escolar descritos abaixo, quais participaram ou estão participando da elaboração do plano de educação de seu município.</div> <div id="resposta" class="text-info">' . $custom_fields['Q11'][0]. '</div>';
echo '<div class="questaoae">Quais foram ou estão sendo os dados utilizados para a elaboração do diagnóstico do município a ser utilizado no plano de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q12'][0]. '</div>';
echo '<div class="questaoae">Quais foram ou estão sendo as principais metodologias utilizadas para a elaboração do plano de educação de seu município?</div> <div id="resposta" class="text-info">' . $custom_fields['Q13'][0]. '</div>';
echo '<div class="questaoae">O processo de elaboração do plano de educação mobilizou ou vem mobilizando</div> <div id="resposta" class="text-info">' . $custom_fields['Q14'][0]. '</div>';
echo '<div class="questaoae">Houve ou há um investimento na comunicação sobre o processo de construção/revisão do Plano?</div> <div id="resposta" class="text-info">' . $custom_fields['Q15'][0]. '</div>';
echo '<div class="questaoae">Caso positivo, a comunicação do processo se deu:</div> <div id="resposta" class="text-info">' . $custom_fields['Q16'][0]. '</div>';
echo '<div class="questaoae">Seu município está preparado para cumprir a lei de acesso à informação pública (lei 12.527/2011) com relação à área de educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q17'][0]. '</div>';
echo '<div class="questaoae">Além da gestão municipal, participam ou participaram do processo de construção/revisão dos Planos</div> <div id="resposta" class="text-info">' . $custom_fields['Q18'][0]. '</div>';
echo '<div class="questaoae">A construção do plano envolveu/envolve as seguintes etapas/modalidades e níveis da educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q19'][0]. '</div>';
echo '<div class="questaoae">Houve ou há um investimento na participação de crianças e adolescentes na construção do Plano de Educação?</div> <div id="resposta" class="text-info">' . $custom_fields['Q20'][0]. '</div>';
echo '<div class="questaoae">Se sim, de que forma?</div> <div id="resposta" class="text-info">' . $custom_fields['Q21'][0]. '</div>';
echo '</div>';*/

//ficha IBGE

echo '<div id="fichaibge" class="well fichas">';
echo '<span class="titulo">IBGE Munic 2009</span>';
echo '<hr /><div class="ladoa">
<table class="table table-bordered">';
echo '<tr>
<th>Tem plano?</th>
<td><span class="resposta label label-info">' . $custom_fields['A187'][0] . '</span></td>
</tr></table>';

echo '<table class="table table-bordered">
<tr><th colspan="2">Instâncias de Gestão Democrática</th></tr>';
echo '<tr><td>Sistema Municipal de Ensino</td> 
	<td>
	<span class="resposta label label-info">' . $custom_fields['A171'][0]. '</span>
	</td></tr>';
echo '<tr>
	<td>Fundo Municipal de Educação</td> <td>
		<span class="resposta label label-info">' . $custom_fields['A219'][0]. '</span>
	</td>
</tr>';
echo '<tr>
	<td>Conselho Municipal de Educação</td> <td>
		<span class="resposta label label-info">' . $custom_fields['A211'][0]. '</span>
	</td>
</tr>';
echo '<tr>
	<td>Conselho de Controle e Acompanhamento Social do FUNDEF</td> <td>
		<span class="resposta label label-info">'. $custom_fields['A181'][0]. '</span>
	</td>
</tr>';
echo '<tr>
	<td>Conselhos Escolares</td> <td>
		<span class="resposta label label-info">' . $custom_fields['A182'][0]. '</span>
	</td>
</tr>';
echo '<tr>
	<td>Conselho de Alimentação Escolar</td> <td>
		<span class="resposta label label-info">' . $custom_fields['A183'][0]. '</span>
	</td>
</tr>';
echo '<tr>
	<td>Conselho do Transporte Escolar</td> <td>
		<span class="resposta label label-info">' .	$custom_fields['A184'][0]. '</span>
	</td>
</tr></table>
</div>' /*ladoa*/ ;

echo '<div class="ladob"><table class="table table-bordered"><tr><th>O Plano Municipal de Educação incorpora educação em direitos humanos no currículo?</th></tr><tr><td> <span class="resposta label label-info">'. $custom_fields['A188'][0]. '</span></td></tr></table>';

echo '<table class="table table-bordered">
<tr><th colspan="2">Na rede municipal de ensino existe capacitação de professores em:</th></tr>';
echo '<tr><td>Direitos Humanos</td> <td><span class="resposta label label-info">' . $custom_fields['A189'][0]. '</span></td></tr>';
echo '<tr><td>Gênero</td> <td><span class="resposta label label-info">' . $custom_fields['A190'][0]. '</span></td></tr>';
echo '<tr><td>Raça/etnia</td> <td> <span class="resposta label label-info">' . $custom_fields['A191'][0]. '</span></td></tr>';
echo '<tr><td>Orientação Sexual</td> <td> <span class="resposta label label-info">' . $custom_fields['A192'][0]. '</span></td></tr>';

echo '<table class="table table-bordered"><tr><th>Na rede municipal de ensino existem escolas aptas a receber pessoas com deficiência?</th></tr><tr><td> <span class="resposta label label-info">' . $custom_fields['A194'][0]. '</span></td></tr></table>';
echo '</table><br style="clear:both;" />
</div></div>' /*ladob e fichaibge*/;
        ?>
		<!-- FIM DA EXIBICAO DOS CUSTOMFIELDS -->
		
			
		</header><!-- .entry-header -->


		

</article><!-- #post -->
