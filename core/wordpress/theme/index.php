<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header(); ?>
<section class="secao"><div class="container">
<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); echo '<article class="card revelar" style="margin-bottom:22px">'; the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); the_excerpt(); echo '</article>'; } the_posts_pagination(); } else { echo '<h2>Nada por aqui ainda</h2><p>Volte em breve — ou fale com a gente no WhatsApp.</p>'; } ?>
</div></section>
<?php get_footer();
