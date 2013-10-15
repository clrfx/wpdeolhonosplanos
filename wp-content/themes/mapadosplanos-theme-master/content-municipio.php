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
	    global $estapa;
	    if ($custom_fields['wpcf-qs_etapa01'][0] == "Sim") {
	    	$etapa = 'complano';
	    }
	    elseif ($custom_fields['wpcf-qs_etapa01'][0] == "Elaboração") {
	     	$etapa = 'elaboracao';
    	}
     	elseif ($custom_fields['wpcf-qs_etapa01'][0] == "Não") {
	      	$etapa = 'semplano';
      	}
	?>
	</div>
	
	
<div id="barra-mapa">

	<div id="content-mapa-single-municipio">

		<header class="entry-header mapas">
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title mapas"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title mapas">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			<?php if ( $etapa ) : ?>
				<div class="comments-link mapas">
					<a class="mapas" href="<?php echo admin_url('post.php?post='. get_the_ID(). '&action=edit');?>">Atualizar o questionário</a>
				</a>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		
		<div class="entry-summary">
			<?php  the_excerpt(); ?>
		</div><!-- .entry-summary -->
		
		<?php else : ?>
		<div class="img-polaroid" id="mapa">
            <?php 
			global $custom_fields;
			echo do_shortcode("[mapbox layers='acaoeducativa.mapadosplanos' api='' options='' lat='" . $custom_fields['lat'][0] . "' lon='" . $custom_fields['lng'][0] . "' z='9' width='500' height='350']"); ?>
		</div><!-- .entry-content -->

		<?php endif; ?>
		
		<div id="botao-map">
		<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="municipio-participar">
		Quer participar? preencha o Question&aacute;rio Sociedade Civil
		</a>
		</span>			
		</div>

		<?php if ( $etapa ) : ?>	
		<div id="botao-map">
			<span><a href="<?php echo admin_url('post.php?post='. get_the_ID(). '&action=edit');?>">Gestor, atualize aqui suas informações</a></span>
		</div>
		
		<?php else: ?>
		<div id="botao-map">
			<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="link-p-aba2">Gestor Municipal, preencha o Questionário</a></span>
		</div>
		
		<?php endif; ?>		
		
		<?php if ( comments_open() ) : ?>
		<div id="botao-map">
			<span id="comment-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Coment&aacute;rio', 'twentytwelve' ), __( '% Coment&aacute;rios', 'twentytwelve' ) ); ?>
			</span>			
		</div>
		<?php endif; // comments_open() ?>
		
		<div id="botao-map">
		<span><a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>"> Entenda o Portal</a></span>
		</div>
		
	</div>
</div>

<div id="page" class="hfeed site">

	<div id="main" class="wrapper">

		<div id="content" class="full-width">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( is_single() ) : ?>

		<!-- EXIBICAO DOS CUSTOMFIELDS -->
		<div id="fichaae" class="well fichas">
			

		<ul class="nav nav-tabs">
  			<li <?php echo ($custom_fields['wpcf-qs_etapa01'][0] != "Sim" && $custom_fields['wpcf-qs_etapa01'][0] != "Elaboração" && $custom_fields['wpcf-qs_etapa01'][0] != "Não" ? 'class="active"' : '');  ?>><a href="#parte1" data-toggle="tab">Dados Educacionais</a></li>
  			<li <?php echo ($custom_fields['wpcf-qs_etapa01'][0] != "Sim" && $custom_fields['wpcf-qs_etapa01'][0] != "Elaboração" && $custom_fields['wpcf-qs_etapa01'][0] != "Não" ? '' : 'class="active"');  ?>><a href="#parte2" data-toggle="tab">Gestão Municipal</a></li>
  			<li><a href="#parte3" data-toggle="tab">Dados Sociedade Civil</a></li>
			<li><a href="#parte4" data-toggle="tab">Questionário Sociedade Civil</a></li>
		</ul>

		
		<!-- TABS -->
		<div class="tab-content">
			<!-- IBGE -->
			<div class="tab-pane <?php echo ($etapa != "complano" && $etapa != "elaboracao" && $etapa != "semplano" ? 'active' : '');  ?>" id="parte1">
				<span class="titulo">Dados do IBGE</span><br><span>Perfil dos Municípios Brasileiros (Munic/2011)</span>
				<hr />
				<table class="table table-bordered">
					<tr>
						<th>Tem plano?</th>
						<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a172'][0]; ?>"><?php echo $custom_fields['wpcf-a172'][0]; ?></span></td>
					</tr>
					<tr><th><b><div>Modalidades abrangidas</div></b></th>
					<td><?php
						//Exibe os niveis do plano
						if ($custom_fields['wpcf-a173'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Ensino fundamental</span>";
						    endif;
						if ($custom_fields['wpcf-a174'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Infantil</span>";
						    endif;
						if ($custom_fields['wpcf-a175'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>EJA</span>";
						    endif;
						if ($custom_fields['wpcf-a176'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Especial</span>";
						    endif;
						if ($custom_fields['wpcf-a177'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Ensino médio</span>";
						    endif;
						if ($custom_fields['wpcf-a178'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Profissional</span>";
						    endif;
						if ($custom_fields['wpcf-a179'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Ensino superior</span>";
						    endif;
						if ($custom_fields['wpcf-a180'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>No campo</span>";
						    endif;
						if ($custom_fields['wpcf-a181'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Indigena</span>";
						    endif;
						if ($custom_fields['wpcf-a182'][0] == "Sim") :
						    echo "<span class='label label-info ibge-Multi'>Ambiental</span>";
						    endif;
				    ?>
					</td>
					</tr>
				</table>
			
				<table class="table table-bordered">
				<tr><th colspan="2">Instâncias de Gestão Democrática</th></tr>
				<tr>
					<td>Sistema Municipal de Ensino</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a164'][0]; ?>"><?php echo $custom_fields['wpcf-a164'][0]; ?></span></td>
				</tr>
				<tr>
					<td>Fundo Municipal de Educação</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a195'][0]; ?>"><?php echo $custom_fields['wpcf-a195'][0] ?></span></td>
				</tr>
				<tr>
					<td>Conselho Municipal de Educação</td> 
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a188'][0]; ?>"><?php echo $custom_fields['wpcf-a188'][0] ?></span></td>
				</tr>
				<tr>
					<td>Conselho de Controle e Acompanhamento Social do FUNDEB</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a183'][0]; ?>"><?php echo $custom_fields['wpcf-a183'][0] ?></span></td>
				</tr>
				<tr>
					<td>Conselhos Escolares</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a184'][0]; ?>"><?php echo $custom_fields['wpcf-a184'][0] ?></span></td>
				</tr>
				<tr>
					<td>Conselho de Alimentação Escolar</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a185'][0]; ?>"><?php echo $custom_fields['wpcf-a185'][0] ?></span></td>
				</tr>
				<tr>
					<td>Conselho do Transporte Escolar</td>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a186'][0]; ?>"><?php echo $custom_fields['wpcf-a186'][0] ?></span></td>
				</tr>
				</table>

				<table class="table table-bordered">
				<tr>
					<th>No município, há programa ou ações de educação em direitos humanos?</th>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a489'][0]; ?>"><?php echo $custom_fields['wpcf-a489'][0] ?></span></td>
				</tr>
				</table>

				<table class="table table-bordered">
				<tr>
					<th colspan="2">Na rede municipal de ensino há programas e ações de:</th>
				</tr>
				<tr>
					<td>Combate à discriminação</td> <td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a168'][0]; ?>"><?php echo $custom_fields['wpcf-a168'][0] ?></span></td>
				</tr>
				<tr>
					<td>Combate à violência</td> <td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a169'][0]; ?>"><?php echo $custom_fields['wpcf-a169'][0] ?></span></td>
				</tr>
				<tr>
					<td>Formação Continuada de professores na educação especial</td> <td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a167'][0]; ?>"><?php echo $custom_fields['wpcf-a167'][0] ?></span></td>
				</tr>
				</table>

				<table class="table table-bordered">
				<tr>
					<th>Na rede municipal de ensino existem escolas aptas a receber pessoas com deficiência?</th>
					<td><span class="resposta label label-info ibge-<?php echo $custom_fields['wpcf-a187'][0]; ?>"><?php echo $custom_fields['wpcf-a187'][0] ?></span></td>
				</tr>
				</table>
			</div>
		
			<!-- Questionário Gestor -->
			<div class="tab-pane <?php echo ($etapa == "complano" || $etapa == "elaboracao" || $etapa == "semplano" ? 'active' : '');  ?>" id="parte2">
			<?php if ($etapa == "complano" || $etapa == "elaboracao") : ?>
				<span class="titulo">Questionário respondido por gestor/a do município</span><br>
				<hr />
				<table class="table table-bordered">
					<tr><th colspan="2">Gestão e planejamento da educação</th></tr>
					<tr>
						<td>Sistema municial de ensino</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano01'); ?>"><?php echo types_render_field('qs_plano01'); ?></span></td>
					</tr>
					<tr>
						<td>Conselho Municipal de Educação</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano02'); ?>"><?php echo types_render_field('qs_plano02'); ?></span></td>
					</tr>
					<tr>
						<td>Plano de carreira e de remuneração para o magistério</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano03'); ?>"><?php echo types_render_field('qs_plano03'); ?></span></td>
					</tr>
					<tr>
						<td>Secretário(a) é ordenador(a) de despesas</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano04'); ?>"><?php echo types_render_field('qs_plano04'); ?></span></td>
					</tr>
					<tr>
						<td>Já respondeu demanda baseada na Lei de Acesso à Informação</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano26'); ?>"><?php echo types_render_field('qs_plano26'); ?></span></td>
					</tr>
				</table>
				<table class="table table-bordered">
					<tr><th colspan="2">Plano de Educação</th></tr>
					<tr>
						<td>Tem plano?</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_etapa01'); ?>"><?php echo types_render_field('qs_etapa01'); ?></span></td>
					</tr>
					<?php if ($etapa == 'complano') : ?>
					<tr>
						<td>Data de aprovação</td>
						<td><span class="resposta label label-info ibge-Multi"><?php echo types_render_field('qs_plano06_complano'); ?></span></td>
					</tr>
					<tr>
						<td>Metas contempladas no Plano Plurianual(PPA) e leis orçamentárias</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano08_complano'); ?>"><?php echo types_render_field('qs_plano08_complano'); ?></span></td>
					</tr>
					<?php endif; ?>
				</table>
				<table class="table table-bordered">
					<tr><th colspan="2">Processo de elaboração do Plano de Educação</th></tr>
					<tr>
						<td>Investimento em comunicação</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano09'); ?>"><?php echo types_render_field('qs_plano09'); ?></span></td>
					</tr>
					<tr>
						<td>Assessoria externa</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano12'); ?>"><?php echo types_render_field('qs_plano12'); ?></span></td>
					</tr>
					<?php if ($custom_fields['wpcf-qs_plano12'][0] == 'Sim') : ?>
					<tr>
						<td>Quais assessores:</td>
						<td><?php echo types_render_checkboxes($custom_fields["wpcf-qs_plano13"][0], 'resposta label label-info ibge-Multi'); ?></span></td>
					</tr>
					<?php endif; ?>
					<tr>
						<td>Instituições participantes</td>
						<td><?php echo types_render_checkboxes($custom_fields["wpcf-qs_plano14"][0], 'resposta label label-info ibge-Multi'); ?></span></td>
					</tr>
					<tr>
						<td>Participação da comunidade escolar</td>
						<td><?php echo types_render_checkboxes($custom_fields["wpcf-qs_plano15"][0], 'resposta label label-info ibge-Multi'); ?></span></td>
					</tr>
					<tr>
						<td>Participação de crianças e adolescentes</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano21'); ?>"><?php echo types_render_field('qs_plano21'); ?></span></td>
					</tr>
				</table>
				
				<table class="table table-bordered">
					<tr><th colspan="2">Avaliação do plano</th></tr>
					<?php if ($etapa == 'complano') : ?>
					<tr>
						<th>Já foi avaliado nos últimos quatro anos?</th>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano07_complano'); ?>"><?php echo types_render_field('qs_plano07_complano'); ?></span></td>
					</tr>
					<? endif; ?>
					<tr>
						<th>Ano desta gestão em que pretende avaliá-lo</th>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano23'); ?>"><?php echo types_render_field('qs_plano23'); ?></span></td>
					</tr>
					<tr>
						<th>Quem avalia a implantação de suas metas</th>
						<td><?php echo types_render_checkboxes($custom_fields["wpcf-qs_plano24"][0], 'resposta label label-info ibge-Multi'); ?></span></td>
					</tr>
				</table>

			<?php elseif ($etapa == 'semplano') : ?>
				<span class="titulo">Questionário respondido por gestor/a do município</span><br>
				<hr />
				<table class="table table-bordered">
					<tr><th colspan="2">Gestão e planejamento da educação</th></tr>
					<tr>
						<td>Sistema municial de ensino</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano01'); ?>"><?php echo types_render_field('qs_plano01'); ?></span></td>
					</tr>
					<tr>
						<td>Conselho Municipal de Educação</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano02'); ?>"><?php echo types_render_field('qs_plano02'); ?></span></td>
					</tr>
					<tr>
						<td>Plano de carreira e de remuneração para o magistério</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano03'); ?>"><?php echo types_render_field('qs_plano03'); ?></span></td>
					</tr>
					<tr>
						<td>Secretário(a) é ordenador(a) de despesas</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano04'); ?>"><?php echo types_render_field('qs_plano04'); ?></span></td>
					</tr>
					<tr>
						<td>Já respondeu demanda baseada na Lei de Acesso à Informação</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_plano26'); ?>"><?php echo types_render_field('qs_plano26'); ?></span></td>
					</tr>
				</table>
				<table class="table table-bordered">
					<tr><th colspan="2">Plano de Educação</th></tr>
					<tr>
						<td>Tem plano?</td>
						<td><span class="resposta label label-info ibge-<?php echo types_render_field('qs_etapa01'); ?>"><?php echo types_render_field('qs_etapa01'); ?></span></td>
					</tr>
					<tr>
						<td>Ano desta gestão em que pretende elaborá-lo</td>
						<td><span class="resposta label label-info ibge-Multi"><?php echo types_render_field('qs_plano23'); ?></span></td>
					</tr>
					</table>
			
			<?php else : ?>
				<span class="titulo"><p>O(A) Gestor(a) da área de educação de seu município ainda não compartilhou informações sobre o processo de construção do Plano de Educação local.</p></span>
				<p>Se você é gestor, colabore conosco nesta coleta de informações e <a href="<?php echo admin_url('post.php?post='. get_the_ID(). '&action=edit');?>">preencha o questionário</a> sobre a elaboração do Plano de Educação do seu Município. </p>
				<p>É da sociedade civil e quer nos ajudar organize uma campanha em seu município para que a administração local participe desta iniciativa.</p>
				<p>Confira também como a população e os(as) gestores(as) públicos podem se organizar em outras esferas para garantir a participação de todos(as) na construção  dos planos de educação em <a href="/mobilizacao-popular/">Mobilização Popular</a> e <a href="/processos-participativos/">Processos Participativos</a></p>
				<p>Faça <a href="/download">download do questionário</a> a ser preenchido pela administração pública e conheça quais são as perguntas desse diagnóstico que tem por objetivo entender como os municípios vêm se preparando para elaborar ou revisar seus Planos de Educação.</p>

			<?php endif; ?>
			</div>
			<!-- Questionário Sociedade -->
			
			
			<div class="tab-pane" id="parte3">
				<?php 
					//Visualização dos questionários. Falta preparar o resto do HTML. Ainda tem um bug nas questões de multipla escolha!!.

					$resultados = mapadosplanos_select_questionarios(get_the_ID()); 
					//print_r($resultados);
					$total = $resultados['post_id'][get_the_ID()];
					$respondido = 'nao-respondido';

					if ($total > 0) {
						$respondido = 'respondido';
					}
				?>
				<div id="respostas-sociedade" class="<?php echo $respondido; ?>">
				<p>O Portal De Olho nos Planos é também um espaço de troca de experiências e você tem lugar especial neste instrumento. Quer colaborar conosco neste levantamento sobre a construção e revisão dos planos de educação em sua cidade? <a id="link-p-aba4" href="#questionario-sociedade">Responda aqui o questionário</a> e compartilhe sua opinião sobre este processo de mobilização em defesa de uma educação de qualidade.</p>
				<strong>Número de respondentes: <?php echo $total; ?></strong>
				<table class="table table-bordered tab1">
					<tr>
						<th>Plano de Educação</th>
						<td>
							<div class="bar-container">
								<label>Sim</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01']['Sim']/$total*100)?>%</label>
								<div class="progress">
								  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_01']['Sim']/$total*100)?>%;"></div>
								</div>

							</div>
							<div class="bar-container">
								<label>Não</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01']['Não']/$total*100)?>%</label>
								<div class="progress">									
								  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_01']['Não']/$total*100)?>%;">
								  </div>
								</div>
							</div>
							<div class="bar-container">
								<label>Em elaboração</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01']['Em elaboração']/$total*100)?>%</label>
								<div class="progress">
								  <div class="bar bar_elab" style="width: <?php echo intval($resultados['qs_01']['Em elaboração']/$total*100)?>%;"></div>
								</div>
							</div>
							<div class="bar-container">
								<label>Não sabe</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01']['Não sabe']/$total*100)?>%</label>
								<div class="progress progress-warning">
								  <div class="bar" style="width: <?php echo intval($resultados['qs_01']['Não sabe']/$total*100)?>%;"></div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>Participação no processo<br />
						<span class="lighter">Se houver plano de educação ou se estiver em elaboração</span>
						</th>
						<td>
							<div class="bar-container">
								<label>Sim</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01_1']['Sim']/$total*100)?>%</label>
								<div class="progress">
								  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_01_1']['Sim']/$total*100)?>%;"></div>
								</div>
							</div>
							<div class="bar-container">
								<label>Não</label>
								<label class="bar-porcentagem"><?php echo intval($resultados['qs_01_1']['Não']/$total*100)?>%</label>
								<div class="progress">
								  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_01_1']['Não']/$total*100)?>%;"></div>
								</div>
							</div>
						</td>
					</tr>
				</table>
				<table class="table table-bordered">
					<tr><td style="font-weight: bold;">Como o Plano pode ajudar a melhorar a educação no município</td>
					<td>
					<span class="pouco-importante">Pouco<br />Importante</span>
					<span class="muito-importante">Muito<br />Importante</span>
					</td>
					</tr>
					<tr>
						<td>Permite que boas iniciativas de uma gestão governamental
							perdurem entre diferentes mandatos</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval($resultados['qs_02_1']/$total/5*100)?></label>
							<div class="bola-menos azul">-</div>
							<div class="progress">
							  <div class="regua">
								  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_02_1']/$total/5*100); ?>%;">
								  </div>
							   </div>
							</div>
							<div class="bola-mais azul">+</div>
						</td>
					</tr>
					<tr>
						<td>Colabora com a construção de parcerias e articulações entre as
							escolas de diferentes redes no município (municipal, estadual e
							federal)</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval['qs_02_2']/$total/5*100)?></label>
							<div class="bola-menos azul">-</div>
							<div class="progress">
								<div class="regua">
									  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_02_2']/$total/5*100); ?>%;">
									  </div>
								</div>
							</div>
							<div class="bola-mais azul">+</div>
						</td>
					</tr>
					<tr>
						<td>Permite identificar os problemas a serem enfrentados, ao se realizar
							um estudo/diagnóstico sobre a situação educacional local</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval['qs_02_3']/$total/5*100)?></label>
                            <div class="bola-menos azul">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_02_3']/$total/5*100); ?>%;"></div>
									</div>
								</div>
							<div class="bola-mais azul">+</div>
						</td>
					</tr>
					<tr>
						<td>Permite o acompanhamento e fiscalização do cumprimento dos
							objetivos e metas presentes no Plano de Educação</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval($resultados['qs_02_4']/$total/5*100)?></label>
							<div class="bola-menos azul">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_02_4']/$total/5*100); ?>%;"></div>
									</div>
								</div>
							<div class="bola-mais azul">+</div>
						</td>
					</tr>
					<tr>
						<td>Possibilita a participação das escolas (professores/as, funcionários/as, 
							alunos/as e pais) na definição dos rumos da política educacional local</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval($resultados['qs_02_5']/$total/5*100)?></label>
							<div class="bola-menos azul">-</div>
								<div class="progress">
									<div class="regua">
										<div class="bar bar_complano" style="width: <?php echo intval($resultados['qs_02_5']/$total/5*100); ?>%;"></div>
									</div>
								</div>
							<div class="bola-mais azul">+</div>
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
					<tr>
					
					<td style="font-weight: bold;">Principais aspectos que dificultam a participação da 
						sociedade civil na construção e revisão do Plano de Educação no município
					</td>
					<td>
					<span class="pouco-importante">Pouco<br />Importante</span>
					<span class="muito-importante">Muito<br />Importante</span>
					</td>
					
					</tr>
					<tr>
						<td>Grandes distâncias e dificuldade de locomoção no município</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Grandes distâncias e dificuldade de locomoção no município']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
										<div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Grandes distâncias e dificuldade de locomoção no município']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de conhecimento sobre os Planos de Educação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de conhecimento sobre os Planos de Educação']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de conhecimento sobre os Planos de Educação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de tempo</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de tempo']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de tempo']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de interesse</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de interesse']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de interesse']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Dificuldade de acesso à informação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Dificuldade de acesso à informação']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Dificuldade de acesso à informação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de divulgação dos eventos relacionados ao processo de
							construção do Plano</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de divulgação dos eventos relacionados ao processo de construção do Plano']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de divulgação dos eventos relacionados ao processo de construção do Plano']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de diálogo entre as escolas e as famílias</td>
						<td>
						    <label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de diálogo entre as escolas e as famílias']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de diálogo entre as escolas e as famílias']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
					<tr>
						<td>Falta de diálogo entre o poder público e a sociedade</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_03']['Falta de diálogo entre o poder público e a sociedade']/$total*100)?></label>
							<div class="bola-menos vermelho">-</div>
								<div class="progress">
									<div class="regua">
									  <div class="bar bar_semplano" style="width: <?php echo intval($resultados['qs_03']['Falta de diálogo entre o poder público e a sociedade']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais vermelho">+</div>
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
					<tr>
					<td style="font-weight: bold;">Principais aspectos que facilitam a participação da 
						sociedade civil na construção e revisão do Plano de Educação no município
					</td>
					<td>
					<span class="pouco-importante">Pouco<br />Importante</span>
					<span class="muito-importante">Muito<br />Importante</span>
					</td>
					</tr>
					<tr>
						<td>Reuniões na escola e/ou outros espaços públicos existentes na comunidade para discutir o que é um Plano de Educação e por que é importante participar de sua construção</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Reuniões na escola e/ou outros espaços públicos existentes na comunidade para discutir o que é um Plano de Educação e por que é importante participar de sua construção']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Reuniões na escola e/ou outros espaços públicos existentes na comunidade para discutir o que é um Plano de Educação e por que é importante participar de sua construção']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Ampla divulgação dos eventos realizados para a construção de
							Planos de Educação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Ampla divulgação dos eventos realizados para a construção de Planos de Educação']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Ampla divulgação dos eventos realizados para a construção de Planos de Educação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Facilitação do acesso às informações sobre a situação educacional
							no município</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Facilitação do acesso às informações sobre a situação educacional no município']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Facilitação do acesso às informações sobre a situação educacional no município']/$total*100) ?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Ações realizadas em escolas próximas à residência / local de estudo</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Ações realizadas em escolas próximas à residência / local de estudo']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Ações realizadas em escolas próximas à residência / local de estudo']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Apoio para transporte</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Apoio para transporte']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Apoio para transporte']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Apoio para alimentação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Apoio para alimentação']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Apoio para alimentação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Apoio com o cuidado dos(as) filhos(as) durante os eventos e
							reuniões</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Apoio com o cuidado dos(as) filhos(as) durante os eventos e reuniões']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Apoio com o cuidado dos(as) filhos(as) durante os eventos e reuniões']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Envolvimento da escola onde estudo ou onde o(a) filho(a) estuda no
							processo de construção ou revisão do Plano de Educação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Envolvimento da escola onde estudo ou onde o(a) filho(a) estuda no processo de construção ou revisão do Plano de Educação']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Envolvimento da escola onde estudo ou onde o(a) filho(a) estuda no processo de construção ou revisão do Plano de Educação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Envolvimento do poder público local no processo de construção ou revisão do Plano de Educação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Envolvimento do poder público local no processo de construção ou revisão do Plano de Educação']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Envolvimento do poder público local no processo de construção ou revisão do Plano de Educação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
					<tr>
						<td>Participação da população nos espaços destinados à construção do Plano de Educação</td>
						<td>
							<label class="bar-spacer"><?php // echo intval($resultados['qs_04']['Participação da população nos espaços destinados à construção do Plano de Educação']/$total*100)?></label>
							<div class="bola-menos verde">-</div>
								<div class="progress progress-success">
									<div class="regua">
									  <div class="bar" style="width: <?php echo intval($resultados['qs_04']['Participação da população nos espaços destinados à construção do Plano de Educação']/$total*100)?>%;"></div>
									</div>
								</div>
							<div class="bola-mais verde">+</div>
						</td>
					</tr>
				</table>
		
				<hr>
				</div>
				<?php 
					if ($total == 0) {
					echo " Ainda n&atilde;o temos nenhum question&aacute;rio preenchido. <a id=\"link-p-aba4b\" href=\"#questionario-sociedade\">Responda agora</a> ";
					}
				?>
				</div>
			<div class="tab-pane" id="parte4">				
				<div id="questionario-sociedade">
					<?php 
						if (function_exists('mapadosplanos_submit_form')) {
					?>
					
					<?php
							mapadosplanos_submit_form(get_the_ID()); 
						} 
					?>
				</div>
			</div>
	</div>

        <?php endif; ?>
		<!-- FIM DA EXIBICAO DOS CUSTOMFIELDS -->
		
				<!-- EXIBICAO DOS ATTACHMENTS -->
        
            <?php

              if( function_exists( 'attachments_get_attachments' ) )
              {
                $attachments = attachments_get_attachments();
                $total_attachments = count( $attachments );
                if( $total_attachments ) : ?>
                
                  <?php 
                  	echo '<div class="anexos well">';
                              echo '<h4>Anexos - Faça o download</h4>';
                        echo '<ul class="thumbnails">';
                  
                  for( $i=0; $i<$total_attachments; $i++ ) : ?>
                  <li id="arquivo-<?php echo $i; ?>" class="thumbnail arquivo <?php echo substr($attachments[$i]['mime'], -3); ?>">
                  <a class="img-ico" href="<?php echo $attachments[$i]['location'] ?>">a</a>
                    <h5><small><?php echo '<a href="' . $attachments[$i]['location'] . '">'.$attachments[$i]['title'].'</a>'; ?></small></h5>
                    <p><small><?php echo $attachments[$i]['caption']; ?></small></p>
                    <p><?php echo '<a class="btn" href="' . $attachments[$i]['location'] . '">Download</a>'; ?></p>
                    <p><small><?php echo $attachments[$i]['filesize']; ?></small></p>
                  </li>
                  <?php endfor; ?>
                <?php 
                echo '</ul></div>';
                endif; 
                
                ?>
                
            <?php } ?>
        
		<!-- FIM DOS ATTACHMENTS -->
	</article><!-- #post -->
	
	

