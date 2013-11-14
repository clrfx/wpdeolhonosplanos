<?php
/**
 * @package Mensagem de Cadastro
 * @version 0.1
 */
/*
Plugin Name: Mensagem de Cadastro
Plugin URI: http://wordpress.stackexchange.com/questions/15304/how-to-change-the-default-registration-email-plugin-and-or-non-plugin
Description: Redefine a mensagem para novos usu&aacute;rios Cadastrados
Author: Brasa
Version: 0.1
Author URI: http://brasa.art.br/
*/

//
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('Novo usu&aacute;rio registrado no Site %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Usu&aacute;rio: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] Novo cadastro no site'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Caro(a) gestor(a), o seu cadastro no De Olho nos Planos foi efetuado com sucesso.') . "\r\n\r\n";
        $message .= __('Seja bem-vindo(a)!') . "\r\n\r\n";
		$message .= __('Para responder o question&aacute;rio, ou melhor dizendo, contribuir com nossa miss&atilde;o de mapear e estimular a participa&ccedil;&atilde;o na elabora&ccedil;&atilde;o dos Planos de Educa&ccedil;&atilde;o pelos munic&iacute;pios brasileiros, seguem seus dados cadastrais. Contamos com voc&ecirc; para ampliar e pluralizar o debate p&uacute;blico sobre a importância da participa&ccedil;&atilde;o de todos(as) na constru&ccedil;&atilde;o de Planos! Para entrar no sistema, voc&ecirc; dever&aacute; acessar o endere&ccedil;o ') ;
        $message .= wp_login_url();
		$message .= __(' e informar os seguintes dados:') . "\r\n\r\n";
        $message .= sprintf(__('Usu&aacute;rio: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Senha: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('Sugerimos que voc&ecirc; guarde os dados acima em local seguro, pois eles garantem acesso ao preenchimento e atualiza&ccedil;&atilde;o das informa&ccedil;&otilde;es de seu munic&iacute;pio. Estamos &agrave; disposi&ccedil;&atilde;o para esclarecer quaisquer d&uacute;vidas por meio do e-mail %s ou do telefone (11) 3151-2333 ramal 108 ou 130.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Atenciosamente, ') . "\r\n\r\n";
		 $message .= __('Equipe do De Olho nos Planos.') ;

        wp_mail($user_email, sprintf(__('[%s] Cadastro realizado com sucesso!'), get_option('blogname')), $message);

    }
}

?>
