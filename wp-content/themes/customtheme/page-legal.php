<?php
/*
Template Name: Legal Page
*/
?>
<?php get_header(); ?>

<main class="min-h-screen bg-[#1E1E1E] text-white font-nunito p-[50px]">

  <div class="grid grid-cols-12 gap-[10px] mx-[80px]">

    <!-- TITLE -->
    <h1 class="col-span-12 text-center text-[48px] font-bold mb-[50px]">
      <?php the_title(); ?>
    </h1>

    <!-- CONTENT (SCF/ACF) -->
    <div class="col-start-2 col-end-12 text-[16px] leading-[1.8] text-gray-200 pb[50px]">
      <?php echo get_field('legal_content'); ?>
    </div>

  </div>

</main>

<?php get_footer(); ?>