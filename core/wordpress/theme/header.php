<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#conteudo">Pular para o conteúdo</a>
<header class="cabecalho">
	<div class="container">
		<?php tm_marca(); ?>
		<nav class="navegacao" aria-label="Menu principal">
			<?php
			if ( has_nav_menu( 'principal' ) ) {
				wp_nav_menu( array( 'theme_location' => 'principal', 'container' => false, 'menu_class' => 'menu', 'depth' => 1 ) );
			} else {
				tm_menu_padrao();
			}
			?>
		</nav>
		<div class="acoes-cabecalho">
			<a class="btn btn--laranja" href="<?php echo esc_url( TM_WHATSAPP_LINK ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Fale conosco</a>
			<button class="abre-menu" type="button" aria-expanded="false" aria-controls="menu-principal" aria-label="Abrir menu"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
		</div>
	</div>
</header>
<main id="conteudo">
