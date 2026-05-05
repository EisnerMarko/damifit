<?php get_header(); ?>
<main>
<section class="bg-[#1E1E1E]">
  <div class="max-w-[1440px] mx-auto px-[20px] sm:px-[40px] lg:px-[80px] py-[30px] sm:py-[40px] lg:py-[50px]">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-[10px] gap-y-[30px] sm:gap-y-[40px] lg:gap-y-[50px]">
      
      <?php if (have_rows('gallery_images')): ?>
        <?php while (have_rows('gallery_images')): the_row(); 
          $image = get_sub_field('gallery_image');
        ?>
          
          <?php if ($image): ?>
            <div class="w-full aspect-square overflow-hidden rounded-[10px]">
              <img 
                src="<?php echo esc_url($image['url']); ?>" 
                alt="<?php echo esc_attr($image['alt']); ?>"
                class="w-full h-full object-cover"
                loading="lazy"
              >
            </div>
          <?php endif; ?>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>

  </div>
</section>
</main>
<?php get_footer(); ?>