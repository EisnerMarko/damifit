<?php get_header(); ?>


<main class="min-h-screen w-full bg-[#1E1E1E]">

</section>

  <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <?php
      $top_products = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'tax_query'      => [
          [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['permanentky'],
            'operator' => 'IN',
          ],
        ],
        'meta_key'       => '_price',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
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
      <section class="px-[20px] sm:px-[40px] lg:px-[80px] pt-20">

        <div class="text-center mb-[40px]">
          <h2 class="text-white text-[32px] md:text-[40px] lg:text-[48px] font-bold leading-tight">
            ZMENA
          </h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
          <?php while ( $top_products->have_posts() ) : $top_products->the_post(); $product = wc_get_product( get_the_ID() ); ?>
            <a href="<?= esc_url( get_permalink() ); ?>" class="group block rounded-[20px] border border-white/10 bg-[#212529] p-[24px] transition duration-300 hover:-translate-y-1 hover:border-[#00A8E8] hover:bg-[#1B2430]">
              <p class="text-[#00A8E8] text-[12px] uppercase tracking-[0.3em] mb-2">DAMIFIT</p>
              <h3 class="text-white text-[16px] md:text-[20px] font-semibold mb-2 leading-tight">
                <?= esc_html( get_the_title() ); ?>
              </h3>
              <div class="text-white text-[28px] md:text-[32px] mb-4">
                <?= wp_kses_post( $product ? $product->get_price_html() : '' ); ?>
              </div>
              <button class="bg-[#00A8E8] hover:bg-[#0088C0] text-white font-bold py-2 px-4 rounded-[10px] transition duration-300 cursor-pointer">
                Zistiť viac
              </button>
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
      <section class="px-[20px] sm:px-[40px] lg:px-[80px] mt-[30px] mb-20">
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