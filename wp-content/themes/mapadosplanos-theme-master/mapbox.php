<?php
/**
 * Mapa da Home
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 */
?>
<?php 

$semplano = do_shortcode( "[mapa_respostas etapa='semplano']" );
$complano = do_shortcode( "[mapa_respostas etapa='complano']" );
$elaboracao = do_shortcode( "[mapa_respostas etapa='elaboracao']" );

$total = $complano + $semplano + $elaboracao;

if ($total > 0) {
$totalmunicipio = round(($complano+$elaboracao)/$total*100);

$complano = round(($complano/$total)*100, 0);
$elab = round(($elaboracao/$total)*100, 0);
} else {$totalmunicipio = 0;};
$semplano = 100 - $totalmunicipio;

?>
<div id="map" class="img-polaroid">
	<a href="#" class="zoomer zoomin">+</a>
	<a href="#" class="zoomer zoomout">-</a>
	<ul id="map-ui">
		<a href='#' id='acaoeducativa.mapadosplanos' class='active'>Munícipios</a>
		<a href='#' id='acaoeducativa.mapadosplanos-estados'>Estados</a>
	</ul>
	<div class="termometro">
		<span>Termômetro dos planos</span>
		<div>Estados
			<span><?php echo round((10/26)*100); ?>%</span>
			<div class="progress">
			  <div class="bar bar_complano" style="width: <?php echo round((10/26)*100, 0); ?>%"></div>
			  <div class="bar bar_elab" style="width: <?php echo round((0/26)*100, 0); ?>%"></div>
			  <!-- <div class="bar bar_semplano" style="width: <?php //echo round((16/26)*100, 0); ?>%"></div> -->
			</div>
		</div>
		<div>Municípios
			<span><?php echo $totalmunicipio; ?>%</span>
			<div class="progress">
			  <div class="bar bar_complano" style="width: <?php echo $complano; ?>%"></div>
			  <div class="bar bar_elab" style="width: <?php echo $elab; ?>%"></div>
			  <!-- <div class="bar bar_semplano" style="width: <?php // echo $semplano; ?>%"></div> -->
			</div>
		</div>
			
	</div>
	<div class="map-legends">
		<div class="map-legend">
			<div class="legenda">
				<span>Planos de educação</span>
				<div class="leg_elab">
					<span class="marker"></span>
					<span>Em elaboração</span>
				</div>
				<div class="leg_complano">
					<span class="marker"></span>
					<span>Com plano</span>
				</div>
				<div class="leg_semplano">
					<span class="marker"></span>
					<span>Sem plano</span>
				</div>
				<div class="leg_gestor">
					<span class="marker"></span>
					<span>Resposta do/a gestor/a</span>
				</div>
			</div>
		</div>
	</div>
</div>
