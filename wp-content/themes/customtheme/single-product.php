<?php get_header(); ?>

<main class="min-h-screen bg-[#1E1E1E] text-white px-[20px] sm:px-[40px] lg:px-[80px]">

  <?php do_action( 'woocommerce_before_main_content' ); ?>
  
  <?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; ?>

    <?php do_action( 'woocommerce_after_main_content' ); ?>

</main>

<?php get_footer(); ?>