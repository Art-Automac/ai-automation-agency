<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TM_VERSAO', '1.1.0' );
define( 'TM_WHATSAPP', '553175266514' );
define( 'TM_WHATSAPP_LINK', 'https://wa.me/' . TM_WHATSAPP );
define( 'TM_WHATSAPP_EXIBICAO', '(31) 7526-6514' );
define( 'TM_SLOGAN', 'Tecnologia, automação e inteligência artificial para o seu negócio.' );

// ==============================================================================
// CONFIGURAÇÕES DE RASTREAMENTO, ANALYTICS E GOOGLE SEARCH CONSOLE
// Preencha com os seus IDs para ativar o rastreamento automaticamente:
// ==============================================================================
define( 'TM_GA4_ID', 'G-NK82MTY92L' );      // Google Analytics 4 (Ativo)
define( 'TM_META_PIXEL_ID', '' );          // Meta Pixel / Facebook (Exemplo: '123456789012345')
define( 'TM_GOOGLE_SITE_VERIFICATION', '' ); // Google Search Console (Código da tag meta)

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

// ==============================================================================
// OTIMIZAÇÃO DE PERFORMANCE MOBILE (REDUÇÃO DE JS E CSS NÃO UTILIZADOS)
// ==============================================================================
function tm_otimizar_desempenho() {
	// Remove scripts e estilos de emojis não utilizados
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove meta tags desnecessárias do cabeçalho
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'tm_otimizar_desempenho' );

// Desativa estilos CSS padrão não utilizados na página
function tm_remover_css_nao_utilizado() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'tm_remover_css_nao_utilizado', 100 );

// Aplica defer no JavaScript do tema para não bloquear a renderização no mobile
function tm_defer_scripts( $tag, $handle ) {
	if ( 'tm-principal' === $handle ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'tm_defer_scripts', 10, 2 );

function tm_icone_svg( $tamanho = 34 ) {
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 40 52" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' .
		'<path d="M0,0 L40,0 L40,9 L26,9 L26,52 L14,52 L14,9 L0,9Z" fill="#0131CD"/>' .
		'<polygon points="17,52 26,52 26,20 17,30" fill="white"/>' .
		'<polygon points="26,52 26,30 35,52" fill="#B9FC01"/>' .
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
	$descricao = 'Agência de automação de processos, inteligência artificial, agentes de WhatsApp, infraestrutura cloud e integração de sistemas sob medida.';
	$keywords  = 'automação de processos, inteligência artificial, agentes de IA, whatsapp api, n8n, chatbots, infraestrutura cloud, desenvolvimento web';
	?>
	<meta name="description" content="<?php echo esc_attr( $descricao ); ?>">
	<meta name="keywords" content="<?php echo esc_attr( $keywords ); ?>">
	<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
	<link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php if ( ! empty( TM_GOOGLE_SITE_VERIFICATION ) ) : ?>
	<meta name="google-site-verification" content="<?php echo esc_attr( TM_GOOGLE_SITE_VERIFICATION ); ?>">
	<?php endif; ?>
	<meta property="og:type" content="website">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
	<meta property="og:title" content="<?php bloginfo( 'name' ); ?> — <?php echo esc_attr( TM_SLOGAN ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $descricao ); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?> — <?php echo esc_attr( TM_SLOGAN ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $descricao ); ?>">
	<script type="application/ld+json">
	{"@context":"https://schema.org","@type":"ProfessionalService","name":"<?php bloginfo( 'name' ); ?>","slogan":"<?php echo esc_js( TM_SLOGAN ); ?>","description":"<?php echo esc_js( $descricao ); ?>","url":"<?php echo esc_url( home_url( '/' ) ); ?>","telephone":"+<?php echo esc_js( TM_WHATSAPP ); ?>","areaServed":"BR","address":{"@type":"PostalAddress","addressRegion":"MG","addressCountry":"BR"}}
	</script>
	<?php
}
add_action( 'wp_head', 'tm_meta_seo', 5 );

// ==============================================================================
// RASTREAMENTO: GOOGLE ANALYTICS 4 & META PIXEL COM EVENTO DE WHATSAPP
// ==============================================================================
function tm_tracking_scripts() {
	// 1. Google Analytics 4 (GA4)
	if ( ! empty( TM_GA4_ID ) ) {
		?>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( TM_GA4_ID ); ?>"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', '<?php echo esc_js( TM_GA4_ID ); ?>');
		</script>
		<?php
	}

	// 2. Meta Pixel (Facebook / Instagram)
	if ( ! empty( TM_META_PIXEL_ID ) ) {
		?>
		<!-- Meta Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '<?php echo esc_js( TM_META_PIXEL_ID ); ?>');
		fbq('track', 'PageView');
		</script>
		<!-- End Meta Pixel Code -->
		<?php
	}

	// 3. Monitoramento de Conversão de Cliques no WhatsApp (dispara para GA4 e Meta Pixel)
	if ( ! empty( TM_GA4_ID ) || ! empty( TM_META_PIXEL_ID ) ) {
		?>
		<script>
		document.addEventListener('DOMContentLoaded', function () {
			var zapButtons = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"], .zap-flutuante');
			zapButtons.forEach(function (btn) {
				btn.addEventListener('click', function () {
					if (typeof fbq === 'function') {
						fbq('track', 'Contact', { content_name: 'WhatsApp Click' });
						fbq('track', 'Lead', { content_name: 'WhatsApp Click' });
					}
					if (typeof gtag === 'function') {
						gtag('event', 'generate_lead', {
							'event_category': 'Engagement',
							'event_label': 'WhatsApp Click'
						});
					}
				});
			});
		});
		</script>
		<?php
	}
}
add_action( 'wp_head', 'tm_tracking_scripts', 10 );

// Noscript de fallback para Meta Pixel
function tm_meta_pixel_noscript() {
	if ( empty( TM_META_PIXEL_ID ) ) return;
	?>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo esc_attr( TM_META_PIXEL_ID ); ?>&ev=PageView&noscript=1"/></noscript>
	<?php
}
add_action( 'wp_body_open', 'tm_meta_pixel_noscript' );

// ==============================================================================
// ROBOTS.TXT DINÂMICO PARA GOOGLE E RASTREADORES DE IA (GPTBot, Claude, etc.)
// ==============================================================================
function tm_custom_robots_txt() {
	echo "User-agent: *\n";
	echo "Allow: /\n";
	echo "Disallow: /wp-admin/\n";
	echo "Allow: /wp-admin/admin-ajax.php\n\n";

	// Libera e otimiza para rastreadores de inteligência artificial
	echo "User-agent: GPTBot\nAllow: /\n\n";
	echo "User-agent: ChatGPT-User\nAllow: /\n\n";
	echo "User-agent: ClaudeBot\nAllow: /\n\n";
	echo "User-agent: PerplexityBot\nAllow: /\n\n";

	echo "Sitemap: " . esc_url( home_url( '/wp-sitemap.xml' ) ) . "\n";
}
add_action( 'do_robotstxt', 'tm_custom_robots_txt', 100 );

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
