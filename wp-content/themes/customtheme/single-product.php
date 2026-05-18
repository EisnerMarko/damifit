<?php get_header(); ?>

<main class="min-h-screen bg-[#1E1E1E] text-white px-[20px] sm:px-[60px] lg:px-[120px]">

<?php
while ( have_posts() ) : 
  the_post();
  wc_get_template_part( 'content', 'single-product' );
endwhile;
?>
</main>

<?php get_footer(); ?>