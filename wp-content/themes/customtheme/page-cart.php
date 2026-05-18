<?php

get_header(); ?>

<main class="min-h-screen bg-[#1E1E1E] text-white px-[20px] sm:px-[40px] lg:px-[80px] py-12">
  <div class="max-w-[1200px] mx-auto">
    <?php
      echo do_shortcode( '[woocommerce_cart]' );
    ?>
  </div>
</main>

<?php get_footer(); ?>
