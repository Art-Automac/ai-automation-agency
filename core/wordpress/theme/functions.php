<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TM_VERSAO', '1.0.0' );
define( 'TM_WHATSAPP', '5511999999999' );
define( 'TM_WHATSAPP_LINK', 'https://wa.me/' . TM_WHATSAPP );
define( 'TM_WHATSAPP_EXIBICAO', '(11) 99999-9999' );
define( 'TM_SLOGAN', 'Tecnologia, automação e inteligência artificial para o seu negócio.' );

function tm_setup() {
	load_theme_textdomain( 'agency-theme', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 220, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	register_nav_menus( array( 'principal' => 'Menu principal', 'rodape' => 'Links do rodapé' ) );
}
add_action( 'after_setup_theme', 'tm_setup' );

function tm_assets() {
	wp_enqueue_style( 'tm-fontes', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'tm-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
	wp_enqueue_style( 'tm-base', get_stylesheet_uri(), array(), TM_VERSAO );
	wp_enqueue_style( 'tm-principal', get_template_directory_uri() . '/assets/css/main.css', array( 'tm-base' ), TM_VERSAO );
	wp_enqueue_script( 'tm-principal', get_template_directory_uri() . '/assets/js/main.js', array(), TM_VERSAO, true );
}
add_action( 'wp_enqueue_scripts', 'tm_assets' );

function tm_preconnect( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array( 'href' => 'https://cdnjs.cloudflare.com' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'tm_preconnect', 10, 2 );

function tm_icone_svg( $tamanho = 34 ) {
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 40 52" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' .
		'<path d="M0,0 L40,0 L40,9 L26,9 L26,52 L14,52 L14,9 L0,9Z" fill="#002D6E"/>' .
		'<polygon points="17,52 26,52 26,20 17,30" fill="white"/>' .
		'<polygon points="26,52 26,30 35,52" fill="#E85D04"/>' .
		'</svg>',
		(int) $tamanho
	);
}

function tm_menu_padrao() {
	$itens = array(
		'#inicio' => 'Início', '#servicos' => 'Serviços', '#clientes' => 'Clientes', '#como-funciona' => 'Como Funciona',
		'#sobre' => 'Sobre', '#contato' => 'Contato',
	);
	echo '<ul id="menu-principal" class="menu">';
	foreach ( $itens as $url => $rotulo ) {
		printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( home_url( '/' ) . $url ), esc_html( $rotulo ) );
	}
	echo '</ul>';
}

function tm_marca( $classe_extra = '' ) {
	$classe = trim( 'marca ' . $classe_extra );
	if ( has_custom_logo() ) {
		$id  = get_theme_mod( 'custom_logo' );
		$img = wp_get_attachment_image( $id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) );
		printf( '<a class="%1$s" href="%2$s">%3$s</a>', esc_attr( $classe ), esc_url( home_url( '/' ) ), $img );
		return;
	}
	printf(
		'<a class="%1$s" href="%2$s"><span class="marca-simbolo">%3$s</span><span>Core<span class="marca-destaque">Agency</span></span></a>',
		esc_attr( $classe ), esc_url( home_url( '/' ) ), tm_icone_svg( 34 )
	);
}

function tm_meta_seo() {
	if ( ! is_front_page() ) return;
	$descricao = 'Automação de processos, inteligência artificial, infraestrutura cloud e mensageria omnichannel. ' . TM_SLOGAN;
	?>
	<meta name="description" content="<?php echo esc_attr( $descricao ); ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Core Agency">
	<meta property="og:title" content="Core Agency — <?php echo esc_attr( TM_SLOGAN ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $descricao ); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<script type="application/ld+json">
	{"@context":"https://schema.org","@type":"ProfessionalService","name":"Core Agency","slogan":"<?php echo esc_js( TM_SLOGAN ); ?>","url":"<?php echo esc_url( home_url( '/' ) ); ?>","telephone":"+<?php echo esc_js( TM_WHATSAPP ); ?>","areaServed":"BR","address":{"@type":"PostalAddress","addressRegion":"MG","addressCountry":"BR"}}
	</script>
	<?php
}
add_action( 'wp_head', 'tm_meta_seo', 5 );

function tm_botao_flutuante() {
	printf(
		'<a class="zap-flutuante" href="%1$s" target="_blank" rel="noopener" aria-label="Falar no WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>',
		esc_url( TM_WHATSAPP_LINK )
	);
}
add_action( 'wp_footer', 'tm_botao_flutuante' );

// ==============================================================================
// BLINDAGEM E SEGURANÇA AVANÇADA (PHP & WORDPRESS)
// ==============================================================================

// 1. Desabilita XML-RPC completamente (impede ataques de força bruta e DDoS multicall)
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'xmlrpc_methods', function ( $methods ) {
	return array();
} );
add_filter( 'pings_open', '__return_false', 20 );

// 2. Remove assinaturas e headers que revelam versões e tecnologias
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );

// 3. Bloqueia enumeração de nomes de usuário (impede ataques de força bruta)
if ( ! is_admin() ) {
	// Bloqueia scanning via ?author=N
	if ( isset( $_REQUEST['author'] ) ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}

	// Bloqueia endpoint de listagem de usuários na REST API para visitantes não autenticados
	add_filter( 'rest_endpoints', function ( $endpoints ) {
		if ( isset( $endpoints['/wp/v2/users'] ) && ! is_user_logged_in() ) {
			unset( $endpoints['/wp/v2/users'] );
		}
		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) && ! is_user_logged_in() ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
		return $endpoints;
	} );
}

// 4. Mensagem genérica em falha de login (evita saber se o usuário ou a senha estão corretos)
add_filter( 'login_errors', function () {
	return 'Credenciais inválidas. Tente novamente.';
} );

// 5. Limpeza de scripts de emojis desnecessários
add_action( 'init', function () {
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
} );
