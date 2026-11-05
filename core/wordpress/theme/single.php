<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header(); ?>
<section class="secao"><div class="container"><?php while ( have_posts() ) { the_post(); the_title( '<h1>', '</h1>' ); the_content(); } ?></div></section>
<?php get_footer();
