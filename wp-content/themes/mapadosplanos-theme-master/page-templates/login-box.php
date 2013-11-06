<?php
/**
 * Template Name: Login Template
 *
 * Description: Esse template adiciona a caixa de login logo abaixo do conteúdo da página.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('resume'); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
				<h4>Para preencher o questionário com as informações do seu município, faça login aqui</h4><p>Informando os dados do seu município, vocẽ automaticamente estará concordando com os <a href='http://deolhonosplanos.org.br/termo-de-uso/'>termos de uso</a> do site.</p>
				<form>
				Aceito os termos de uso <input id="termo-checkbox" type="checkbox" NAME="termo-de-uso" VALUE="agree" onclick="">
				</form>
				<?php
				$redirect_url = get_query_var('redirect');
				//check url
				if (! preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $redirect_url)):
					$redirect_url = admin_url();
				endif;
				
				if ( ! is_user_logged_in() ) { // Display WordPress login form:
					$args = array(
						'redirect' => $redirect_url, 
						'form_id' => 'loginform-custom',
						'label_username' => __( 'Username' ),
						'label_password' => __( 'Password' ),
						'label_remember' => __( 'Remember Me' ),
						'label_log_in' => __( 'Log In' ),
						'remember' => true
					);
					wp_login_form( $args );
				} else { // If logged in:
					wp_loginout( home_url() ); // Display "Log Out" link.
					echo " | ";
					wp_register('', ''); // Display "Site Admin" link.
				}
				?>
				<br />
				<br />
			<?php endwhile; // end of the loop. ?>
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
