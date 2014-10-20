<?php
/**
 * Child Theme Post Formats
 *
 * Child Themes inherit the post formats defined by the parent theme. Calling add_theme_support()
 * for post formats in a child theme must be done at a later priority than that of the parent
 * theme and will override the existing list, not add to it.
 *
 * @link http://codex.wordpress.org/Post_Formats#Formats_in_a_Child_Theme
 */
function mapadosplanos_childtheme_formats() {
	add_theme_support( 'post-formats', array( 'video' ) );
}
add_action( 'after_setup_theme', 'mapadosplanos_childtheme_formats', 11 );

//Modo de manutenção
function maintenace_mode() {
  if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
    die('<div style="text-align: center;"><h1>Em manutenção</h1><p>Por favor volte em 30 minutos.</p><p>Enquanto isso, acesse o site da <a href="http://www.acaoeducativa.org/">Ação Educativa</a>.</p></div>');
  }
}
// Comente a seguinte linha para sair no "Modo de manutenção"
//add_action('get_header', 'maintenace_mode');

//Filtro para tirar campos do Perfil de usuários abaixo de administradores

if( !current_user_can('administrator') ) {
add_filter('user_contactmethods','remove_profile_fields', 10, 1);
add_action( 'admin_enqueue_scripts', 'mapadosplanos_admin_stylesheet' );
	function remove_profile_fields($contactmethods) {
		   unset($contactmethods['aim']);
		   unset($contactmethods['jabber']);
		   unset($contactmethods['yim']);
		   return $contactmethods;
	} 
	
	// Customizing Admin
function mapadosplanos_admin_stylesheet() { 
	wp_enqueue_style('mapadosplanos_admin_css', get_bloginfo( 'stylesheet_directory' ) . '/style-admin.css');
}

	//ocultar campos ao editar profile e ao criar novo usuario para  usuários abaixo de administradores
	function hide_personal_options(){
	echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) {

	$(\'form#your-profile > h3\').hide();
	$(\'form#your-profile\').show();
	$(\'form#your-profile > h3:first\').hide();
	$(\'form#your-profile > table:first\').hide();
	$(\'form#your-profile label[for=first_name], form#your-profile input#first_name, #first_name\').hide();
	$(\'form#your-profile label[for=last_name], form#your-profile input#last_name, #last_name\').hide();
	$(\'form#your-profile label[for=nickname], form#your-profile input#nickname, #nickname\').hide();
	$(\'form#your-profile label[for=ea_sub_publish_post], form#your-profile input#ea_sub_publish_post, #ea_sub_publish_post\').hide();
	$(\'form#your-profile label[for=ea_sub_pending_post], form#your-profile input#ea_sub_pending_post, #ea_sub_pending_post\').hide();
	$(\'form#your-profile label[for=display_name], form#your-profile input#display_name, #display_name\').hide();
	$(\'form#your-profile label[for=url], form#your-profile input#url\').hide();
	$(\'form#your-profile label[for=description], form#your-profile textarea#description\').hide();
	$(\'form#createuser label[for=role], form#createuser select#role\').hide();
	$(\'form#createuser label[for=url], form#createuser input#url\').hide();
	$(\'form#createuser label[for=nickname], form#createuser input#nickname\').hide();
	$(\'form#createuser label[for=display_name], form#your-profile input#display_name, #display_name\').hide();
	});
	</script>' . "\n";
	}
	add_action('admin_head','hide_personal_options');
		
}

// Chamando o LigthBox Magnific!
wp_enqueue_script( 'jquery.magnific-popup', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'), '', true );
wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() . '/js/magnific-popup.css' );

// Filtrando a navegação do twenty twelve
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">← Anteriores</span>', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( '<span class="meta-nav">Próximos →</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}

//require_once(dirname(__FILE__).'/embedded-types/types.php');
define('child_template_directory', dirname(get_bloginfo('stylesheet_url')));

// AJAX SEARCH
add_action('wp_ajax_ae_search', 'quicksearch');
add_action('wp_ajax_nopriv_ae_search', 'quicksearch');

function quicksearch() {
	global $wpdb;

	if (strlen($_POST['s'])>2) {
		$limit=10;
		$s=strtolower(addslashes($_POST['s']));
		//dar um tweak nisso
        $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE
			$wpdb->posts.post_type='municipio'
			AND lower($wpdb->posts.post_title) like '%$s%'
			ORDER BY $wpdb->posts.post_date DESC
			LIMIT $limit;
		 ";

	 	$pageposts = $wpdb->get_results($querystr, OBJECT);
		echo '<ul>';
		$x=0;
 		while ($pageposts[$x]) {
			$post=$pageposts[$x];
			$lat = get_post_meta($post->ID, "lat", true);
			$lng = get_post_meta($post->ID, "lng", true);
			echo '<li>';
			echo '<a href="'.$post->guid.'" data-lat="' . $lat . '" data-lng="' . $lng . '">'.$post->post_title.'</a>';
			echo '</li>';
			$x++;
		}

		echo '</ul>';

	}
	else echo '';
	die();

}

function mapadosplanos_search_override($query) {
    if ($query->is_search) {
    	if(isset($_GET['search-type'])) {
    		$query->set('post_type',array('municipio'));
    	}
    	else {
        	$query->set('post_type',array('post'));
    	}
    }
	return $query;
}

add_filter('pre_get_posts','mapadosplanos_search_override');

//Registrando Sidebares especificas

register_sidebar( array(
		'name' => __( 'Sidebar Destaques Home', 'twentytwelve' ),
		'id' => 'sidebar-destaques-home',
		'description' => __( 'Sidebar Destaques Home', 'twentytwelve' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

register_sidebar( array(
		'name' => __( 'Sidebar Noticias', 'twentytwelve' ),
		'id' => 'sidebar-noticias-widget',
		'description' => __( 'Sidebar Noticias', 'twentytwelve' ),
		'before_widget' => '<div id="%1$s" class="sidebar-noticias %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );


//Footer widgets

register_sidebar( array(
		'name' => __( 'Rodap&eacute;', 'twentytwelve' ),
		'id' => 'footer-a',
		'description' => __( 'Rodap&eacute;', 'twentytwelve' ),
		'before_widget' => '<div id="%1$s" class="span2 widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

// Registrando Menu para categorias da Biblioteca	
register_nav_menu( 'biblioteca-menu', __( 'Menu da Biblioteca', 'twentytwelve' ) );

// admin favicon	
function admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/favicon-admin.png" />';
}
add_action('admin_head', 'admin_favicon');


//redirect query var
add_filter('query_vars', 'redirect_var');
function redirect_var($public_query_vars) {
	$public_query_vars[] = 'redirect';
	return $public_query_vars;
	}


//Helper functions for checkbox

function types_render_checkboxes($checkboxes, $classes) {
	$html = '';
	foreach (unserialize($checkboxes) as $key => $value) {
		$html = $html . '<span class="' . $classes . '">' . $value . '</span>';
	}
	return $html;
}


// Customizing Login

function mapadosplanos_login_stylesheet() { 
	?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
	<?php 
}
add_action( 'login_enqueue_scripts', 'mapadosplanos_login_stylesheet' );

function mapadosplanos_login_footer() { 
	?>
	<script type='text/javascript' src='<?php echo get_bloginfo( 'stylesheet_directory' ) . '/js/wp-login.js'; ?>'></script>

	<?php
}

	add_filter('login_footer', 'mapadosplanos_login_footer');


// Filtro para criar class do CPT no body do Admin
	
add_filter ('admin_body_class', 'mapadosplanos_body_class');
function mapadosplanos_body_class ($body_class) { 
	$post_type = get_post_type ();
	$body_class .=  ' post-type-' . $post_type;
	return $body_class;
}
	

//Cleaning up admin area

function remove_menu_items() {
	global $menu;
	global $submenu;
    unset($submenu['edit.php?post_type=municipio'][10]);
	$restricted = array(__('Dashboard'),__('Posts'),__('Links'), __('Comments'), __('Media'),
	__('Plugins'), __('Tools'),__('Users'), "Contato");
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)) {
			unset($menu[key($menu)]);
		}
	}
}


function mapadosplanos_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
}

function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

function hide_that_stuff() {
    if('municipio' == get_post_type())
  echo '<style type="text/css">
    #favorite-actions {display:none;}
    .add-new-h2{display:none;}
    .tablenav{display:none;}
    </style>';
}

//Cleaning up Municipios Post interface
function mapadosplanos_remove_post_meta_boxes() {
	remove_meta_box('slugdiv', 'municipio', 'normal');
	remove_meta_box('wpcf-marketing', 'municipio', 'side');
	remove_meta_box('munic2011', 'municipio', 'normal');
}

if ( !is_super_admin() ) {
	add_action('admin_menu', 'remove_menu_items');
	add_action( 'wp_before_admin_bar_render', 'mapadosplanos_admin_bar_render' );
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
	add_action('admin_head', 'hide_that_stuff');
	add_action( 'add_meta_boxes', 'mapadosplanos_remove_post_meta_boxes' );
}

// Redirect by IBGE

function ibge_redirect() {
  if (isset($_GET['ibge'])) {
  	global $wpdb;
    $sql = "SELECT post_id FROM {$wpdb->postmeta} " . "WHERE meta_key='ibge' AND meta_value='%s'";
    $sql = $wpdb->prepare($sql,$_GET['ibge']);
    $post_id = $wpdb->get_var($sql);
    if ($post_id) {
      $permalink = get_permalink($post_id);
      if ($permalink) {
        wp_safe_redirect($permalink,301);
        exit;
      }
    }
  }
}
add_action('parse_request','ibge_redirect',0);  // 0=before (most) 'parse_request' calls


//Pega os Markers novos do DB
function get_markers_json() {
	global $wpdb;
	$limit=10;
	//dar um tweak nisso
    $querystr = "
		SELECT post_id 
		FROM $wpdb->postmeta
		WHERE meta_key='wpcf-qs_etapa01';
	 ";

 	$metaposts = $wpdb->get_results($querystr, OBJECT);
 	$json = '[';
 	foreach ($metaposts as $p) {
 		$post = get_post_custom($p->post_id);
 		$json = $json . '{';
 		$json = $json . 'ibge:"' . $post['ibge'][0] . '",';
 		$json = $json . 'lat:"' . $post['lat'][0] . '",';
 		$json = $json . 'lng:"' . $post['lng'][0] . '",';
 		$json = $json . 'qs_etapa01:"' . $post['wpcf-qs_etapa01'][0] . '"';
 		$json = $json . '},';
 	}
 	$json = $json . '{}]';
 	return $json;
}


//Categorias

//Arruma sort order das categorias
function mapasdosplanos_categories_order( $query ) {
	$last_sticky = get_option( 'sticky_posts' );
    if ( $query->is_category() && $query->is_main_query() ) {
        $query->set( 'ignore_sticky_posts', 1 );
        $query->set('post__not_in', array_slice($last_sticky,-1));
    }
}
add_action( 'pre_get_posts', 'mapasdosplanos_categories_order' );

//Adiciona tipos de imagem
if ( function_exists( 'add_theme_support' ) ) { 
	add_image_size( 'category-sticky', 640, 480, true);
	add_image_size( 'category-regular', 256, 192, true);
	add_image_size( 'thumbnail-mini', 90, 90, true);
}

//Remove 'site' dos comentários
add_filter('comment_form_default_fields', 'mapadosplanos_comment_filter');
function mapadosplanos_comment_filter($fields)
{
if(isset($fields['url']))
unset($fields['url']);
return $fields;
}

//Redirect on save_post
add_filter('redirect_post_location', 'redirect_to_post_on_publish_or_save');

function redirect_to_post_on_publish_or_save($location)
{
    global $post;

    if (
        !current_user_can('administrator') && current_user_can('edit_published_posts') &&
        (isset($_POST['publish']) || isset($_POST['save'])) &&
        preg_match("/post=([0-9]*)/", $location, $match) &&
        $post &&
        $post->ID == $match[1] &&
        (isset($_POST['publish']) || $post->post_status == 'publish') && // Publishing draft or updating published post
        $post->post_type == 'municipio' &&
        $pl = get_permalink($post->ID)
    ) {
        // Always redirect to the post
        $location = get_bloginfo('url') . "/obrigado?post=" . $post->ID;
    }

    return $location;

}


//Redirect to Questionario on Admin
add_action('load-index.php', 'dashboard_Redirect');

function dashboard_Redirect(){
	global $current_user;
	$args = array(
			'author' => $current_user->ID,
			'post_type' => 'municipio',
			'posts_per_page' => 1
		);
	$posts = get_posts($args);
	wp_redirect(admin_url("post.php?post=".$posts[0]->ID."&action=edit"));
}

//Shortcode para Voltar ao post
//[foo]
function mapadosplanos_shortcode_voltapost( $atts ){
    // get attibutes and set defaults
        extract(shortcode_atts(array(
                'texto' => 'Voltar para página do Munícipio'
       ), $atts));
 	   return "<a href='#' id='voltaPost'>".$texto."</a>";
}

add_shortcode( 'voltaPost', 'mapadosplanos_shortcode_voltapost' );


//Adicionando filtro para quantidade de caracteres do the_excerpt
// Muda o limite do the_excerpt no child theme do TwentyTwelve
function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return nl2br($excerpt);
}


//Adicionando funções do template reCadastro

add_action( 'wp_ajax_recadastro_search', 'ajax_recadastro_search' );
add_action( 'wp_ajax_nopriv_recadastro_search', 'ajax_recadastro_search' );
function ajax_recadastro_search() {

    if ( empty( $_POST['s'] ) )
        die();

    global $wpdb;

    $sql = $wpdb->prepare("
        SELECT
            {$wpdb->posts}.ID,
            {$wpdb->posts}.post_title,
            {$wpdb->postmeta}.meta_value AS ibge
        FROM
            {$wpdb->posts}
        INNER JOIN {$wpdb->postmeta} ON 1=1
            AND {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
        LEFT JOIN {$wpdb->usermeta} ON 1=1
            AND {$wpdb->usermeta}.meta_key = 'ibge'
            AND {$wpdb->usermeta}.meta_value = {$wpdb->postmeta}.meta_value
        WHERE 1=1
            AND {$wpdb->posts}.post_type = 'municipio'
            AND {$wpdb->posts}.post_status = 'publish'
            AND {$wpdb->postmeta}.meta_key = 'ibge'
            AND {$wpdb->usermeta}.user_id IS NULL
            AND LOWER({$wpdb->posts}.post_title) LIKE '%%%s%%'
        LIMIT 10
    ", $_POST['s'] );

    $results = $wpdb->get_results( $sql );
    if ( count( $results ) <= 0 ) {
        echo '<li class="none"><span>Nenhum município encontrado</span><br /><small>Provavelmente o município que buscou já possui acesso para o preenchimento do questionário. Caso você tenha perdido a senha ou seja o responsável pela atualização do questionário, envie um e-mail para contato@deolhonosplanos.org.br. Assim que possível liberaremos um novo acesso para você. Obrigado!</small></li>';
        exit();
    }

    $out = '<ul>';
    foreach( $results as $r ) {
        $out .= sprintf( '<li data-post-id="%s" data-ibge="%s"><a>%s</a></li>' , $r->ID, $r->ibge, $r->post_title );
    }
    $out .= '</ul>';
    echo $out;
    exit();

}

function get_post_id_from_ibge( $ibge ) {
    global $wpdb;
    $sql = $wpdb->prepare( "
        SELECT ID
        FROM {$wpdb->posts} p, {$wpdb->postmeta} pm
        WHERE 1=1
            AND p.ID = pm.post_id
            AND pm.meta_key = 'ibge'
            AND pm.meta_value = '%d'
        LIMIT 1
    ", $ibge );
    $post_id = $wpdb->get_var( $sql );
    return $post_id;
}


add_action( 'init', 'recadastro_form_submit' );
function recadastro_form_submit() {

    if ( empty( $_POST['recadastro'] ) )
        return;

    global $messages, $wpdb, $postdata;

    $postdata = $_POST;
    unset( $_POST ); // aí o WordPress não enxe o saco

    $error = false;
    $required_fields = array(
        'municipio' => 'Município',
        'responsavel' => 'Nome',
        'funcao' => 'Função',
        'email' => 'E-mail'
    );
    foreach( array_keys( $required_fields ) as $r ) {
        if ( !empty( $postdata[ $r ] ) )
            continue;
        $messages[] = array(
            'class' => 'error',
            'content' => 'O campo obrigatório "' . $required_fields[ $r ] . '" não foi preenchido.'
        );
        $error = true;
    }

    if ( $error )
        return;

    if ( !is_email( $postdata['email'] ) ) {
        $messages[] = array(
            'class' => 'error',
            'content' => 'O e-mail fornecido é inválido.'
        );
        return;
    }

    $post_id = get_post_id_from_ibge( $postdata['municipio'] );
    $post = get_post( $post_id );
    if ( !$post_id ) {
        $messages = array(
            'class' => 'error',
            'content' => 'Houve um erro ao gravar as informações de seu município. Por favor, envie um e-mail para contato@deolhonosplanos.org.br informando o ocorrido.'
        );
        return;
    }

    $funcoes = array(
        1 => 'Dirigente Municipal de Educação',
        2 => 'Assessor(a) do(a) Dirigente Municipal de Educação',
        3 => 'Coordenador(a) de área/programa da Secretaria',
        4 => 'Diretor(a) regional de ensino',
        5 => 'Outras'
    );
    if ( empty( $funcoes[ $postdata['funcao'] ] ) ) {
        $messages = array(
            'class' => 'error',
            'content' => 'Função inválida. O formulário não foi preenchido adequadamente.'
        );
        return;
    }
    $postdata['funcao'] = $funcoes[ $postdata['funcao'] ];

    $userdata = array(
        'user_login' => $postdata['municipio'],
        'user_pass' => wp_generate_password(),
        'user_email' => $postdata['email'],
        'first_name' => $post->post_title,
        'role' => 'author'
    );
    $user_id = wp_insert_user( $userdata );
    if ( is_wp_error( $user_id ) ) {
        $messages[] = array(
            'class' => 'error',
            'content' => $user_id->get_error_message()
        );
        return;
    }
    update_user_meta( $user_id, 'ibge', $postdata['municipio'] );
    wp_new_user_notification( $user_id, $userdata['user_pass'] );

    $fields = array(
        'municipio' => 'wpcf-qs_cadastro02',
        'responsavel' => 'wpcf-qs_cadastro02',
        'funcao' => 'wpcf-qs_cadastro03',
        'email' => 'wpcf-qs_cadastro05'
    );
    foreach ( $fields as $k => $v ) {
        update_post_meta( $post_id, $v, $postdata[ $k ] );
    }

    $postarr = array(
        'ID' => $post_id,
        'post_author' => $user_id
    );
    wp_update_post( $postarr );

    $messages = array( array(
        'class' => 'success',
        'content' => 'Agradecemos seu cadastro. O seu número de usuário foi criado com sucesso e é <b>' . $postdata['municipio'] . '</b>. A senha de acesso foi enviada para o e-mail <i>' . $postdata['email'] . '</i>. Não esqueça de verificar na sua caixa de SPAM.'
    ) );
    $postdata = false;

}

function get_municipio_fields() {
    return array(
        'wpcf-qs_etapa01',
        'wpcf-qs_cadastro01',
        'wpcf-qs_cadastro02',
        'wpcf-qs_cadastro03',
        'wpcf-qs_cadastro03_other',
        'wpcf-qs_cadastro05',
        'wpcf-qs_plano01',
        'wpcf-qs_plano02',
        'wpcf-qs_plano03',
        'wpcf-qs_plano04',
        'wpcf-qs_plano06_complano',
        'wpcf-qs_plano07_complano',
	'wpcf-qs_plano07_elaboracao',
        'wpcf-qs_plano08_complano',
        'wpcf-qs_plano09',
        'wpcf-qs_plano10',
        'wpcf-qs_plano11',
        'wpcf-qs_plano12',
        'wpcf-qs_plano13',
        'wpcf-qs_plano14',
        'wpcf-qs_plano15',
        'wpcf-qs_plano16',
        'wpcf-qs_plano17',
        'wpcf-qs_plano18',
        'wpcf-qs_plano19',
        'wpcf-qs_plano20',
        'wpcf-qs_plano21',
        'wpcf-qs_plano22',
        'wpcf-qs_plano23',
        'wpcf-qs_plano24',
        'wpcf-qs_plano25',
        'wpcf-qs_plano26',
        'wpcf-qs_plano27',
        'wpcf-qs_plano28',
        'wpcf-qs_plano29'

    );
}