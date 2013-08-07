<?php
/**
Template name: Home Brasilico 
 */

get_header(); ?>

		<div id="primary">
		
				
		<div id="content-uma-coluna" role="main">
	
				<div id="slider-home">
						<?php echo do_shortcode( "[orbit-slider]" ); ?>
				</div> 
		
		
<!--welcome-->
	<div class="welcome_container">
	
		<div class="two_third welcome-box">
		
	<h1><?php if(of_get_option('welcome_text') != NULL){ echo of_get_option('welcome_text');} else echo "Write your welcome headline here. Have fun with the Hero theme." ?></h1></div>
	
	<div class="botao-download"><?php if(of_get_option('welcome_button') != NULL){ ?> 
	<a class="button large" href="<?php if(of_get_option('welcome_button_link') != NULL){ echo of_get_option('welcome_button_link');} ?>"><?php echo of_get_option('welcome_button'); ?></a> 
	<?php } else { ?> <a class="button large" href="<?php if(of_get_option('welcome_button_link') != NULL){ echo of_get_option('welcome_button_link');} ?>"> <?php echo "Download Now!" ?></a> <?php } ?></div>
<hr />
</div><!--welcome end--> 
<div class="clear"></div>	
				
            <div id="caixas-home">
            
			
			
                <?php 
				// Criando as variaveis em cima das Opções do Options FrameWork
			$box01 = of_get_option ('select_page_box1');
			$box02 = of_get_option ('select_page_box2');
			$box03 = of_get_option ('select_page_box3');
				?>

            	<div class="caixa-home">

                <?php query_posts('page_id='.$box01.''); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
				<?php endwhile; endif; wp_reset_query(); ?>
                
                </div><!-- .caixa-home-esq -->
                
                <div class="caixa-home">
                
                <?php query_posts('page_id='.$box02.''); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
				<?php endwhile; endif; wp_reset_query(); ?>
                
                </div><!-- .caixa-home -->
                
                <div class="caixa-home">
                
                <?php query_posts('page_id='.$box03.''); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
				<?php endwhile; endif; wp_reset_query(); ?>
                
                </div><!-- .caixa-home-dir -->
            
            </div><!-- #caixas-home -->
				</div><!-- #content -->

				
		</div><!-- #primary -->

<?php get_footer('home'); ?>