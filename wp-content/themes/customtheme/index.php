<?php get_header(); ?>

<main class="min-h-screen w-full bg-[#1E1E1E]">

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
                     md:w-[205px] md:h-[56px] bg-[#00A8E8] text-white text-sm sm:text-base font-bold rounded-md hover:bg-[#0096cf]">
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

                <p class="text-white mt-6 text-base md:text-lg opacity-90 leading-relaxed">
                  <?php the_sub_field('hero_description'); ?>
                </p>

                <div class="mt-8 flex justify-center">
                  <a href="<?php the_sub_field('hero_button_link'); ?>" 
                     class="inline-flex items-center justify-center w-[180px] h-[48px] 
                     bg-[#00A8E8] text-white font-bold rounded-md hover:bg-[#0096cf]">
                    <?php the_sub_field('hero_button_text'); ?>
                  </a>
                </div>

              </div>

            <!-- ================= ANNOUNCEMENT ================= -->
            <?php elseif($layout === 'announcement'): ?>

              <div class="w-full max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center">

                <!-- LEFT TEXT -->
                <div>
                  <p class="text-[#00A8E8] font-bold uppercase text-md mb-2">
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
  </section>

  <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <?php
      $top_products = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 5,
        'tax_query' => [
          [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['permanentky'],
            'operator' => 'IN',
          ],
        ],
      ]);

      if ( ! $top_products->have_posts() ) {
        wp_reset_postdata();
        $top_products = new WP_Query([
          'post_type' => 'product',
          'posts_per_page' => 5,
          'orderby' => 'date',
          'order' => 'DESC',
        ]);
      }
    ?>

    <?php if ( $top_products->have_posts() ) : ?>
      <section class="px-[20px] sm:px-[40px] lg:px-[80px] mt-[50px]">

        <div class="text-center mb-[40px]">
          <h2 class="text-white text-[32px] md:text-[40px] lg:text-[48px] font-bold leading-tight">
            ZMENA
          </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
          <?php while ( $top_products->have_posts() ) : $top_products->the_post(); $product = wc_get_product( get_the_ID() ); ?>
            <a href="<?= esc_url( get_permalink() ); ?>" class="group block rounded-[20px] border border-white/10 bg-[#212529] p-[24px] transition duration-300 hover:-translate-y-1 hover:border-[#00A8E8] hover:bg-[#1B2430]">
              <p class="text-[#00A8E8] text-[12px] uppercase tracking-[0.3em] mb-2">DAMIFIT</p>
              <h3 class="text-white text-[18px] md:text-[20px] font-semibold mb-4 leading-tight">
                <?= esc_html( get_the_title() ); ?>
              </h3>
              <div class="text-white text-[28px] md:text-[32px] font-bold mb-4">
                <?= wp_kses_post( $product ? $product->get_price_html() : '' ); ?>
              </div>
              <?php if ( $product && $product->get_short_description() ) : ?>
                <p class="text-gray-300 text-sm leading-relaxed">
                  <?= wp_kses_post( wp_trim_words( $product->get_short_description(), 16, '...' ) ); ?>
                </p>
              <?php else : ?>
                <p class="text-gray-400 text-sm leading-relaxed">Začnite pracovať na sebe už dnes pre lepší zajtrajšok.</p>
              <?php endif; ?>
            </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </section>
    <?php endif; ?>

    <?php
      $plan_products = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 2,
        'tax_query' => [
          [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['stravovaci-plan', 'meal-plan', 'plans'],
            'operator' => 'IN',
          ],
        ],
      ]);

      if ( ! $plan_products->have_posts() ) {
        wp_reset_postdata();
        $plan_products = new WP_Query([
          'post_type' => 'product',
          'posts_per_page' => 2,
          'orderby' => 'date',
          'order' => 'DESC',
        ]);
      }
    ?>

    <?php if ( $plan_products->have_posts() ) : ?>
      <section class="px-[20px] sm:px-[40px] lg:px-[80px] mt-[30px]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
          <?php while ( $plan_products->have_posts() ) : $plan_products->the_post(); $image = get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>
            <a href="<?= esc_url( get_permalink() ); ?>" class="group block relative overflow-hidden rounded-[20px] min-h-[240px] bg-[#1E1E1E] shadow-lg">
              <?php if ( $image ) : ?>
                <img src="<?= esc_url( $image ); ?>" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="<?= esc_attr( get_the_title() ); ?>">
              <?php endif; ?>
              <div class="absolute inset-0 bg-black/40"></div>
              <div class="relative z-10 flex h-full flex-col justify-end p-6 md:p-8">
                <p class="text-white text-[12px] uppercase tracking-[0.35em] mb-3">DAMIFIT</p>
                <h3 class="text-white text-[28px] md:text-[34px] font-bold leading-tight">
                  <?= esc_html( get_the_title() ); ?>
                </h3>
              </div>
            </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endif; ?>

<section class="w-full mt-[50px] bg-[#212529]">

  <div class="px-[20px] sm:px-[40px] lg:px-[80px] py-[40px] lg:py-[80px]">

    <!-- GRID -->
    <div class="grid grid-cols-12 gap-y-[40px] gap-x-[30px] md:gap-x-[60px] lg:gap-x-[80px] items-center">

      <!-- LEFT -->
      <div class="col-span-12 lg:col-span-6">

        <!-- small title -->
        <p class="text-white text-[14px] sm:text-[16px] italic font-light mb-2">
          <?php the_field('small_title', $page_id); ?>
        </p>

        <!-- title -->
        <h2 class="text-white text-[26px] sm:text-[32px] font-bold mb-6">
          <?php the_field('title', $page_id); ?>
        </h2>

        <!-- text -->
        <p class="text-white text-[14px] sm:text-[16px] leading-relaxed mb-8 max-w-[600px]">
          <?php the_field('description', $page_id); ?>
        </p>

        <!-- button -->
        <?php 
          $btn_link = get_field('button_link', $page_id);
          $btn_text = get_field('button_text', $page_id);
        ?>

        <?php if($btn_link && $btn_text): ?>
          <div class="mt-6">
            <a href="<?= esc_url($btn_link); ?>"
               class="inline-flex items-center justify-center 
               w-[180px] h-[48px] sm:w-[195px] sm:h-[52px] md:w-[205px] md:h-[56px] 
               bg-[#00A8E8] text-white text-sm sm:text-base font-bold rounded-md hover:bg-[#0096cf]">
              <?= esc_html($btn_text); ?>
            </a>
          </div>
        <?php endif; ?>

      </div>

      <!-- RIGHT -->
      <div class="col-span-12 lg:col-span-6">

        <div class="w-full h-[280px] sm:h-[400px] lg:h-[520px]">

          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2663.5046001024743!2d17.109079876502378!3d48.119791552399114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c89dfb849fb01%3A0x62c83ab91930b6bf!2sDamifit!5e0!3m2!1ssk!2sdk!4v1777891151774!5m2!1ssk!2sdk"
            class="w-full h-full rounded-[10px]"
            style="border:0;"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>

        </div>

      </div>

    </div>

  </div>

</section>

<?php
$page_id = get_option('page_on_front');
$zones = get_field('zones', $page_id);
?>

<section class="pb-[30px] sm:pb-[50px] px-[20px] sm:px-[40px] lg:px-[80px] bg-[#212529]">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-[10px]">

    <?php if(!empty($zones) && is_array($zones)): ?>
      
      <?php foreach($zones as $index => $zone): ?>

        <div class="sm:col-span-1 lg:col-span-4">
  <div 
    class="zone-card cursor-pointer relative rounded-[10px] overflow-hidden group"
    data-index="<?= $index; ?>"
  >

    <?php if(!empty($zone['thumbnail'])): ?>
      <img 
        src="<?= esc_url($zone['thumbnail']['url']); ?>" 
        class="w-full h-[180px] sm:h-[220px] lg:h-[254px] object-cover opacity-50 group-hover:opacity-100 transition duration-300 pointer-events-none"
      >
    <?php endif; ?>

    <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 text-white text-[16px] sm:text-[18px] lg:text-[20px] font-bold z-10">
      <?= esc_html($zone['title']); ?>
    </div>

  </div>
</div>

      <?php endforeach; ?>

    <?php endif; ?>

  </div>

</section>

<div id="zone-modal" class="hidden fixed inset-0 bg-[#1E1E1E] z-50 overflow-y-auto">

  <div class="px-[20px] sm:px-[40px] lg:px-[80px] py-[40px] lg:py-[80px]">

    <!-- CLOSE -->
    <button id="zone-close" class="fixed top-4 right-4 sm:top-6 sm:right-6 text-white text-3xl sm:text-4xl z-50 cursor-pointer">
      ×
    </button>

    <?php foreach($zones as $index => $zone): ?>

      <div class="zone-detail hidden" data-index="<?= $index; ?>">

        <div class="grid grid-cols-12 gap-y-[30px] lg:gap-x-[60px] items-start">

          <!-- LEFT -->
<div class="col-span-12 lg:col-span-6">

<?php if(!empty($zone['gallery'])): ?>

  <?php $first = $zone['gallery'][0]['image']; ?>

  <!-- BIG IMAGE -->
  <img 
    src="<?= esc_url($first['url']); ?>" 
    data-index="0"
    data-full="<?= esc_url($first['url']); ?>"
    class="zone-image zone-main-image w-full h-[220px] sm:h-[280px] lg:h-[316px] object-cover rounded-[10px] mb-4 cursor-pointer"
  >

  <!-- THUMBS -->
  <div class="flex gap-[8px] sm:gap-[10px] flex-wrap">

    <?php foreach($zone['gallery'] as $i => $item): ?>
      <?php $img = $item['image']; ?>

      <img 
        src="<?= esc_url($img['url']); ?>" 
        data-index="<?= $i; ?>"
        data-full="<?= esc_url($img['url']); ?>"
        class="zone-image zone-thumb w-[60px] h-[60px] sm:w-[80px] sm:h-[80px] lg:w-[97px] lg:h-[97px] object-cover rounded-[8px] opacity-60 hover:opacity-100 cursor-pointer transition"
      >

    <?php endforeach; ?>

  </div>

<?php endif; ?>

</div>
          <!-- RIGHT -->
          <div class="col-span-12 lg:col-span-6">

            <h2 class="text-white text-[26px] sm:text-[36px] lg:text-[48px] font-bold mb-4 sm:mb-6 leading-tight">
              <?= esc_html($zone['title']); ?>
            </h2>

            <p class="text-white text-[14px] sm:text-[16px] mb-5 sm:mb-6 leading-relaxed">
              <?= esc_html($zone['description']); ?>
            </p>

            <h3 class="text-white text-[16px] sm:text-[18px] lg:text-[20px] font-bold mb-3 sm:mb-4">
              <?= esc_html($zone['subtitle']); ?>
            </h3>

            <p class="text-white text-[14px] sm:text-[16px] whitespace-pre-line leading-relaxed">
              <?= esc_html($zone['equipment']); ?>
            </p>

          </div>

        </div>

      </div>

    <?php endforeach; ?>

  </div>
</div>

<div id="lightbox" class="hidden fixed inset-0 bg-black/90 z-[999] flex items-center justify-center">

  <!-- CLOSE -->
  <button id="lightbox-close" class="absolute top-6 right-6 text-white text-4xl">×</button>

  <!-- PREV -->
  <button id="lightbox-prev" class="absolute left-6 text-white text-4xl">←</button>

  <!-- IMAGE -->
  <img id="lightbox-img" class="max-w-[90%] max-h-[90%] rounded-lg">

  <!-- NEXT -->
  <button id="lightbox-next" class="absolute right-6 text-white text-4xl">→</button>

</div>

<section class="flex flex-col items-center text-center justify-center px-[20px] sm:px-[40px] lg:px-[80px] py-[40px] lg:py-[80px]">
        <?php if($testimonials_title = get_field('testimonials_title', $page_id)): ?>
            <h2 class="text-5xl font-bold mb-4 text-white"><?php echo esc_html($testimonials_title); ?></h2>
        <?php endif; ?>
        <?php if($testimonials_text_line = get_field('testimonials_text_line', $page_id)): ?>
            <h3 class="text-3xl mb-4 text-white"><?php echo esc_html($testimonials_text_line); ?></h3>
        <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
        <?php
        $args = [
            'post_type' => 'testimonial',
            'posts_per_page' => 6,
            'orderby' => 'rand'
        ];
        $testimonials = new WP_Query($args);
        if ($testimonials->have_posts()):
            while ($testimonials->have_posts()): $testimonials->the_post();
                $testimonial_id = get_the_ID();
                $name = '';
                $rating = 5;

                if ( function_exists( 'get_field' ) ) {
                    $name = get_field( 'testimonial_name' );
                    $rating = get_field( 'testimonial_rating' );
                }

                if ( ! $name ) {
                    $name = get_post_meta( $testimonial_id, 'testimonial_name', true );
                }

                if ( ! $rating ) {
                    $rating = intval( get_post_meta( $testimonial_id, 'testimonial_rating', true ) );
                }

                $name = $name ?: get_the_title();
                $rating = $rating >= 1 && $rating <= 5 ? $rating : 5;
        ?>
        <div class="p-8 flex flex-col items-center bg-gray-[#212529] rounded-lg shadow-lg">
            
            <div class="mt-2 flex flex-row items-center">
                <h4 class="font-bold text-xl mr-2 text-white"><?php echo esc_html($name); ?></h4>
                <div class="flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="iconify text-2xl <?php echo $i <= $rating ? 'text-amber-400' : 'text-gray-300'; ?>" data-icon="mdi:star"></span>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="text-white text-center mt-1">
                <?php
                $testimonial_text = wp_strip_all_tags( get_the_content() );
                echo esc_html( wp_html_excerpt( $testimonial_text, 150 ) . ( mb_strlen( $testimonial_text ) > 150 ? '...' : '' ) );
                ?>
            </div>
            <div class="text-white text-center text-sm italic mt-1"><?php echo esc_html( get_the_date() ); ?></div>
        </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</section>

<section class="flex flex-col items-center text-center justify-center px-[20px] sm:px-[40px] lg:px-[80px] pb-20">
    <h3 class="text-5xl font-bold mb-2 text-white"><?php pll_e("Napíšte nám recenziu")?></h3>

    <?php if ( is_user_logged_in() ): ?>
        <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" enctype="multipart/form-data" class="p-8 bg-gray-[#212529] rounded-[10px] shadow-lg max-w-3xl mx-auto w-full">
            <input type="hidden" name="action" value="submit_testimonial">
            <?php wp_nonce_field( 'submit_testimonial_action', 'testimonial_nonce' ); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 text-white">
                <div>
                    <label for="testimonial_name"></label>
                    <input type="text" name="testimonial_name" id="testimonial_name" required class="w-full p-2 rounded-[10px] bg-[#495057] pl-4" placeholder="<?php pll_e("Meno alebo Prezývka")?>" />
                </div>
                <div>
                    <label for="testimonial_rating"></label>
                    <input type="number" name="testimonial_rating" id="testimonial_rating" min="1" max="5" required class="w-full p-2 rounded-[10px] bg-[#495057] pl-4" placeholder="<?php pll_e("Hodnotenie 1-5 hviezdičiek")?>" />
                </div>
            </div>
            <div class="mb-4 text-white">
                <label for="testimonial_content"></label>
                <textarea name="testimonial_content" id="testimonial_content" required class="w-full p-2 rounded-[10px] min-h-[120px] bg-[#495057] pl-4" placeholder="<?php pll_e("Text recenzie")?>"></textarea>
            </div>
            <div class="flex justify-center">
                <input type="submit" value=<?php pll_e("Odoslať")?> class="bg-[#00A8E8] text-white font-bold px-20 py-2 rounded-[10px] hover:bg-[#0096cf] transition cursor-pointer" />
            </div>
        </form>
    <?php else: ?>
        <p class="mt-4 text-black">
            <?php pll_e("Submition")?>:
            <a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="text-blue-600 underline"><?php pll_e("Log In")?></a>
            or
            <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="text-blue-600 underline"><?php pll_e("Register")?>:</a>
        </p>
    <?php endif; ?>

    <?php
    if (isset($_GET['testimonial']) && $_GET['testimonial'] === 'success') {
        echo '<p class="mt-4 text-green-600 font-bold">Thank you for your testimonial! It will appear after review.</p>';
    }
    ?>
</section>

</main>

<?php get_footer(); ?>