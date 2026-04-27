<?php get_header(); ?>

<main class="min-h-screen w-full">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post();?>

        <section class="w-full">
  <div class="relative overflow-hidden">
    
    <!-- Background -->
    <img 
      src="<?php echo get_field('hero_background', $page_id); ?>" 
      alt="Hero" 
      class="absolute inset-0 w-full h-full object-cover"
    />

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Content -->
    <div class="relative grid grid-cols-1 md:grid-cols-12 min-h-[400px] md:min-h-[500px] items-center px-4">
      
      <!-- Spacer (desktop only) -->
      <div class="hidden md:block md:col-span-3"></div>

      <!-- Main content -->
      <div class="col-span-1 md:col-span-6 text-center">
        
        <h1 class="text-white font-bold text-3xl sm:text-4xl md:text-5xl lg:text-[56px] leading-tight">
          <?php echo get_field('hero_title', $page_id); ?>
        </h1>

        <div class="mt-6 flex justify-center">
  <a href="<?php echo get_field('hero_button_link', $page_id); ?>" 
     class="inline-flex items-center justify-center w-[180px] h-[48px] sm:w-[195px] sm:h-[52px] 
     md:w-[205px] md:h-[56px] bg-[#00A8E8] text-white text-sm sm:text-base font-bold rounded-md">
     
     <?php echo get_field('hero_button_text', $page_id); ?>
  </a>
</div>

      </div>

      <!-- Spacer (desktop only) -->
      <div class="hidden md:block md:col-span-3"></div>

    </div>
  </div>
</section>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>