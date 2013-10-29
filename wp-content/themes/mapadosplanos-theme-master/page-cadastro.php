<?
/**
 * Template Name: Cadastro
 */

global $messages, $postdata;

?>
<?php get_header('resume'); ?>

	<div id="primary" class="cadastro">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php if ( !empty( $messages ) && is_array( $messages ) ) : ?>
                    <ul class="messages">
                        <?php foreach ( $messages as $m ) : ?>
                            <li class="<?php echo $m['class']; ?>"><?php echo $m['content']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="." id="recadastro-form" method="POST">

					
				  <p><label for="s-recadastro" class="bolder">Procure pelo seu Município</label>
				  <input type="text" placeholder=" " autocomplete="off" id="s-recadastro" name="s" value="" class="ui-state-valid">
				  <div id="autocomplete"></div>
				  <?php $selected = !empty( $postdata ) && $p = get_post_id_from_ibge( $postdata['municipio'] ); ?>
				  <div id="selected"<?php echo $selected ? ' class="show"' : ''; ?>>
				  <?php if ( $selected ) : ?>
				  <?php $post = get_post( $p ); ?>
				  Município selecionado: <a><?php echo $post->post_title; ?></a>
				  <input type="hidden" name="municipio" value="<?php echo $postdata['municipio']; ?>" />
				  <?php endif; ?>
				  </div></p>

                    <p><label for="responsavel" class="bolder">Informe seu Nome Completo</label>
                    <input type="text" id="responsavel" name="responsavel" value="<?php echo !empty( $postdata['responsavel'] ) ? $postdata['responsavel'] : ''; ?>" /></p>

                    <p><label for="email" class="bolder">Cadastre seu E-mail</label>
                    <input type="text" id="email" name="email" value="<?php echo !empty( $postdata['email'] ) ? $postdata['email'] : ''; ?>" /></p>

                    <p class="bolder">Selecione o seu Cargo ou função</p>

                    <p>
                    <label for="funcao1"><input type="radio" value="1" id="funcao1" name="funcao"<?php echo !empty( $postdata['funcao'] ) && 1 == $postdata['funcao'] ? ' checked="checked"' : ''; ?>>Dirigente Municipal de Educação</label>
                    <label for="funcao2"><input type="radio" value="2" id="funcao2" name="funcao"<?php echo !empty( $postdata['funcao'] ) && 2 == $postdata['funcao'] ? ' checked="checked"' : ''; ?>>Assessor(a) do(a) Dirigente Municipal de Educação</label>
                    <label for="funcao3"><input type="radio" value="3" id="funcao3" name="funcao"<?php echo !empty( $postdata['funcao'] ) && 3 == $postdata['funcao'] ? ' checked="checked"' : ''; ?>>Coordenador(a) de área/programa da Secretaria</label>
                    <label for="funcao4"><input type="radio" value="4" id="funcao4" name="funcao"<?php echo !empty( $postdata['funcao'] ) && 4 == $postdata['funcao'] ? ' checked="checked"' : ''; ?>>Diretor(a) regional de ensino</label>
                    <label for="funcao5"><input type="radio" value="5" id="funcao5" name="funcao"<?php echo !empty( $postdata['funcao'] ) && 5 == $postdata['funcao'] ? ' checked="checked"' : ''; ?>>&nbsp;Outras</label>
                    </p>

                    <p class="btn-cadastro"><input type="hidden" name="recadastro" value="1" />
                    <input type="submit" value="Enviar" /></p>

                </form>

            <?php endwhile; ?>

		</div>
	</div>
<?php get_footer(); ?>
