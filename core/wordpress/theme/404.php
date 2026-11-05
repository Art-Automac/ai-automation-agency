<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header(); ?>
<section class="secao" style="text-align:center;padding-top:160px"><div class="container">
<span class="eyebrow" style="justify-content:center">Erro 404</span>
<h1>Essa página não existe</h1>
<p>O endereço está errado ou o conteúdo saiu do ar. Volte para o início ou fale com a gente.</p>
<p style="margin-top:28px"><a class="btn btn--azul btn--grande" href="<?php echo esc_url( home_url( '/' ) ); ?>">Ir para o início</a></p>
</div></section>
<?php get_footer();
