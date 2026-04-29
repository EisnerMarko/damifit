<?php get_header(); ?>

<main class="min-h-screen w-full">

<section class="w-full">

  <div class="swiper heroSwiper min-h-[500px] md:min-h-[600px]">
    <div class="swiper-wrapper">

      <?php 
      $page_id = get_option('page_on_front');
      ?>

      <?php if(have_rows('hero_slides', $page_id)): ?>
        <?php while(have_rows('hero_slides', $page_id)): the_row(); 

          $bg = get_sub_field('hero_background');
          $layout = get_sub_field('layout_type');
          $bg_url = is_array($bg) ? $bg['url'] : $bg;

        ?>

        <div class="swiper-slide relative overflow-hidden">

          <!-- Background -->
          <?php if($bg_url): ?>
            <img src="<?php echo esc_url($bg_url); ?>" 
                 class="absolute inset-0 w-full h-full object-cover z-0">
          <?php endif; ?>

          <!-- Overlay -->
          <div class="absolute inset-0 bg-black/60 z-10"></div>

          <!-- Content -->
          <div class="relative z-20 min-h-[500px] md:min-h-[600px] flex items-center px-4">

            <!-- ================= DEFAULT ================= -->
            <?php if($layout === 'default'): ?>

              <div class="w-full text-center max-w-3xl mx-auto">
                
                <h1 class="text-white font-bold text-3xl sm:text-4xl md:text-5xl lg:text-[56px] leading-tight tracking-tight">
                  <?php the_sub_field('hero_title'); ?>
                </h1>

                <div class="mt-6 flex justify-center">
                  <a href="<?php the_sub_field('hero_button_link'); ?>" 
                     class="inline-flex items-center justify-center w-[180px] h-[48px] sm:w-[195px] sm:h-[52px] 
                     md:w-[205px] md:h-[56px] bg-[#00A8E8] text-white text-sm sm:text-base font-bold rounded-md">
                    <?php the_sub_field('hero_button_text'); ?>
                  </a>
                </div>

              </div>

            <!-- ================= FOOD ================= -->
            <?php elseif($layout === 'food'): ?>

              <div class="w-full text-center max-w-2xl mx-auto">
                
                <h1 class="text-white font-bold text-3xl sm:text-4xl md:text-5xl leading-tight">
                  <?php the_sub_field('hero_title'); ?>
                </h1>

                <p class="text-white mt-4 text-base md:text-lg opacity-90 leading-relaxed">
                  <?php the_sub_field('hero_description'); ?>
                </p>

                <div class="mt-6 flex justify-center">
                  <a href="<?php the_sub_field('hero_button_link'); ?>" 
                     class="inline-flex items-center justify-center w-[180px] h-[48px] 
                     bg-[#00A8E8] text-white font-bold rounded-md">
                    <?php the_sub_field('hero_button_text'); ?>
                  </a>
                </div>

              </div>

            <!-- ================= ANNOUNCEMENT ================= -->
            <?php elseif($layout === 'announcement'): ?>

              <div class="w-full max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center">

                <!-- LEFT TEXT -->
                <div>
                  <p class="text-[#00A8E8] uppercase text-sm mb-2">
                    <?php the_sub_field('announcement_label'); ?>
                  </p>

                  <h2 class="text-white text-3xl md:text-5xl font-bold leading-tight">
                    <?php the_sub_field('announcement_text'); ?>
                  </h2>
                </div>

                <!-- RIGHT BOXES -->
                <div class="space-y-5 max-w-[420px] ml-auto">

                  <?php if(have_rows('announcement_boxes')): ?>
                    <?php while(have_rows('announcement_boxes')): the_row(); ?>

                      <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 text-white shadow-xl">

                        <!-- TITLE -->
                        <?php if(get_sub_field('box_title')): ?>
                          <p class="mb-4 text-lg font-semibold">
                            <?php the_sub_field('box_title'); ?>
                          </p>
                        <?php endif; ?>

                        <!-- ITEMS -->
                        <div class="space-y-4">

                          <?php 
                          $items = get_sub_field('box_items');
                          if($items): 
                            $i = 0;
                            foreach($items as $item): 
                              $i++;
                          ?>

                            <div class="flex items-center gap-3">
                              <img src="<?php echo $item['item_icon']; ?>" class="w-5 h-5">
                              <p class="text-sm md:text-base">
                                <?php echo $item['item_text']; ?>
                              </p>
                            </div>

                            <?php if($i < count($items)): ?>
                              <div class="border-t border-white/20"></div>
                            <?php endif; ?>

                          <?php endforeach; endif; ?>

                        </div>

                      </div>

                    <?php endwhile; ?>
                  <?php endif; ?>

                </div>

              </div>

            <?php endif; ?>

          </div>

        </div>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>

  </div>
  <?php
$page_id = get_option('page_on_front');
$zones = get_field('zones', $page_id);
?>

<section class="mt-[50px] px-[80px]">

  <div class="grid grid-cols-12 gap-[10px]">

    <?php if(!empty($zones) && is_array($zones)): ?>
      
      <?php foreach($zones as $index => $zone): ?>

        <div class="col-span-4">
        <div 
  class="zone-card cursor-pointer relative rounded-[10px] overflow-hidden"
  data-index="<?= $index; ?>"
>

            <?php if(!empty($zone['thumbnail'])): ?>
              <img 
                src="<?= esc_url($zone['thumbnail']['url']); ?>" 
                class="w-full h-[254px] object-cover opacity-60"
              >
            <?php endif; ?>

            <div class="absolute bottom-4 left-4 text-white text-[20px] font-bold">
              <?= esc_html($zone['title']); ?>
            </div>

          </div>
        </div>

      <?php endforeach; ?>

    <?php endif; ?>

  </div>

</section>

<div id="zone-modal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center">

  <div class="bg-[#2b0f0f] p-10 rounded-xl max-w-[1100px] w-full relative">

    <!-- CLOSE -->
    <button id="zone-close" class="absolute top-5 right-5 text-white text-3xl">×</button>

    <?php foreach($zones as $index => $zone): ?>

      <div class="zone-detail hidden" data-index="<?= $index; ?>">

        <!-- TITLE -->
        <h2 class="text-white text-[48px] font-bold mb-6">
          <?= esc_html($zone['title']); ?>
        </h2>

        <!-- DESCRIPTION -->
        <p class="text-white text-[16px] mb-6 max-w-[600px]">
          <?= esc_html($zone['description']); ?>
        </p>

        <!-- SUBTITLE -->
        <h3 class="text-white text-[20px] font-bold mb-4">
          <?= esc_html($zone['subtitle']); ?>
        </h3>

        <!-- EQUIPMENT -->
        <p class="text-white mb-6">
          <?= esc_html($zone['equipment']); ?>
        </p>

        <!-- GALLERY -->
        <div class="flex gap-6">

          <?php if(!empty($zone['gallery'])): ?>

            <?php 
              $first = $zone['gallery'][0];
            ?>

            <!-- BIG -->
            <img src="<?= esc_url($first['url']); ?>" class="w-[528px] h-[316px] object-cover rounded-lg">

            <!-- SMALL -->
            <div class="flex flex-col gap-2">
              <?php foreach($zone['gallery'] as $i => $img): ?>
                <?php if($i === 0) continue; ?>
                <img src="<?= esc_url($img['url']); ?>" class="w-[97px] h-[97px] object-cover rounded-md">
              <?php endforeach; ?>
            </div>

          <?php endif; ?>

        </div>

      </div>

    <?php endforeach; ?>

  </div>
</div>
</main>

<?php get_footer(); ?>