<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
$tem_conteudo = false;
if ( have_posts() ) { the_post(); $tem_conteudo = ( '' !== trim( get_the_content() ) ); rewind_posts(); }
if ( $tem_conteudo ) { while ( have_posts() ) { the_post(); echo '<div class="secao"><div class="container">'; the_content(); echo '</div></div>'; } }
else { get_template_part( 'template-parts/home' ); }
get_footer();
