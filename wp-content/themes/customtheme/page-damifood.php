<?php get_header(); ?>
<main class="min-h-screen w-full bg-[#F8F9FB]">
<section class="w-full">

<?php if(have_rows('hero_slides')): ?>
  <?php while(have_rows('hero_slides')): the_row(); ?>

    <?php if(get_sub_field('layout_type') === 'food'): ?>

      <?php 
      $bg = get_sub_field('hero_background');
      $bg_url = is_array($bg) ? $bg['url'] : $bg;
      ?>

      <section class="w-full relative overflow-hidden min-h-[500px] md:min-h-[600px]">

        <!-- Background -->
        <?php if($bg_url): ?>
          <img src="<?php echo esc_url($bg_url); ?>" 
               class="absolute inset-0 w-full h-full object-cover z-0">
        <?php endif; ?>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60 z-10"></div>

        <!-- Content -->
        <div class="relative z-20 min-h-[500px] md:min-h-[600px] flex items-center px-4">

          <div class="w-full text-center max-w-2xl mx-auto">
            
            <h1 class="text-white font-bold text-3xl sm:text-4xl md:text-5xl leading-tight">
              <?php the_sub_field('hero_title'); ?>
            </h1>

            <p class="text-white mt-4 text-base md:text-lg opacity-90 leading-relaxed">
              <?php the_sub_field('hero_description'); ?>
            </p>

            <!-- <div class="mt-6 flex justify-center">
              <a href="<?php the_sub_field('hero_button_link'); ?>" 
                 class="inline-flex items-center justify-center w-[180px] h-[48px] 
                 bg-[#00A8E8] text-white font-bold rounded-md">
                <?php the_sub_field('hero_button_text'); ?>
              </a>
            </div> -->

          </div>

        </div>

      </section>

    <?php endif; ?>

  <?php endwhile; ?>
<?php endif; ?>

</section>

<?php if(have_rows('food_sections')): ?>
    
    <?php while(have_rows('food_sections')): the_row();
  
      $layout = get_sub_field('section_layout');
      $title = get_sub_field('section_title');
      $text = get_sub_field('section_text');
      $gallery = get_sub_field('section_gallery');
  
    ?>
  
    <section class="py-[60px] md:py-[80px] lg:h-[516px] flex items-center bg-[#FFFFFF]">
  
      <!-- CONTAINER -->
      <div class="max-w-[1440px] mx-auto w-full px-[20px] md:px-[40px] lg:px-[80px]">
  
        <!-- MOBILE / TABLET -->
        <div class="lg:hidden flex flex-col gap-[40px]">
  
          <?php if($layout === 'reverse' && $gallery): ?>
  
            <!-- IMAGES -->
            <div class="grid grid-cols-2 gap-[10px] js-gallery">
  
              <?php foreach($gallery as $image): ?>
  
                <img 
                  src="<?php echo esc_url($image['url']); ?>"
                  class="w-full aspect-[313/181] object-cover rounded-[10px]"
                >
  
              <?php endforeach; ?>
  
            </div>
  
          <?php endif; ?>
  
          <!-- TEXT -->
          <div>
  
            <h2 class="font-bold text-[28px] md:text-[32px] leading-tight">
              <?php echo esc_html($title); ?>
            </h2>
  
            <div class="mt-5 md:mt-6 text-[16px] leading-[1.6]">
              <?php echo wp_kses_post($text); ?>
            </div>
  
          </div>
  
          <?php if($layout === 'normal' && $gallery): ?>
  
            <!-- IMAGES -->
            <div class="grid grid-cols-2 gap-[10px] js-gallery">
  
              <?php foreach($gallery as $image): ?>
  
                <img 
                  src="<?php echo esc_url($image['url']); ?>"
                  class="w-full aspect-[313/181] object-cover rounded-[10px]"
                >
  
              <?php endforeach; ?>
  
            </div>
  
          <?php endif; ?>
  
        </div>
  
        <!-- DESKTOP -->
        <div class="hidden lg:grid lg:grid-cols-12 lg:gap-[10px] h-full items-center">
  
          <?php if($layout === 'normal'): ?>
  
            <!-- TEXT -->
            <div class="col-span-5">
  
              <h2 class="font-bold text-[32px] leading-tight">
                <?php echo esc_html($title); ?>
              </h2>
  
              <div class="mt-6 text-[16px] leading-[1.5]">
                <?php echo wp_kses_post($text); ?>
              </div>
  
            </div>
  
            <!-- REAL 1 COLUMN SPACER -->
            <div class="col-span-1"></div>
  
            <!-- IMAGES -->
            <div class="col-span-6">
  
              <div class="grid grid-cols-2 gap-[10px] js-gallery">
  
                <?php if($gallery): ?>
                  <?php foreach($gallery as $image): ?>
  
                    <img 
                      src="<?php echo esc_url($image['url']); ?>"
                      class="w-[313px] h-[181px] object-cover rounded-[10px]"
                    >
  
                  <?php endforeach; ?>
                <?php endif; ?>
  
              </div>
  
            </div>
  
          <?php else: ?>
  
            <!-- IMAGES -->
            <div class="col-span-6">
  
              <div class="grid grid-cols-2 gap-[10px] js-gallery">
  
                <?php if($gallery): ?>
                  <?php foreach($gallery as $image): ?>
  
                    <img 
                      src="<?php echo esc_url($image['url']); ?>"
                      class="w-[313px] h-[181px] object-cover rounded-[10px]"
                    >
  
                  <?php endforeach; ?>
                <?php endif; ?>
  
              </div>
  
            </div>
  
            <!-- REAL 1 COLUMN SPACER -->
            <div class="col-span-1"></div>
  
            <!-- TEXT -->
            <div class="col-span-5">
  
              <h2 class="font-bold text-[32px] leading-tight">
                <?php echo esc_html($title); ?>
              </h2>
  
              <div class="mt-6 text-[16px] leading-[1.5]">
                <?php echo wp_kses_post($text); ?>
              </div>
  
            </div>
  
          <?php endif; ?>
  
        </div>
  
      </div>
  
    </section>
  
    <?php endwhile; ?>
  
  <?php endif; ?>

  <section class="py-[50px] md:py-[50px]">

  <!-- CONTAINER -->
  <div class="max-w-[1440px] mx-auto px-[20px] md:px-[40px] lg:px-[80px]">

    <!-- HEADING -->
    <h2 class="text-center font-bold text-[28px] md:text-[32px] leading-tight">
      <?php the_field('packages_section_title'); ?>
    </h2>

    <!-- 30PX GAP -->
    <div class="mt-[30px]">

      <?php if(have_rows('food_packages')): ?>

        <!-- GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[20px] lg:gap-[10px]">

          <?php while(have_rows('food_packages')): the_row();

            $logo = get_sub_field('package_logo');
            $name = get_sub_field('package_name');
            $price = get_sub_field('package_price');
            $description = get_sub_field('package_description');

          ?>

          <!-- CARD -->
          <div class="lg:col-span-6 bg-white rounded-[10px] min-h-[603px] px-[20px] md:px-[30px]">

            <!-- TOP -->
            <div class="pt-[30px] text-center">

              <!-- LOGO -->
              <?php if($logo): ?>
                <img 
                  src="<?php echo esc_url($logo['url']); ?>"
                  class="mx-auto w-auto h-auto max-w-[160px] md:max-w-[220px]"
                >
              <?php endif; ?>

              <!-- PACKAGE NAME -->
              <p class="mt-[10px] text-[15px] md:text-[16px] italic font-light leading-tight">
                <?php echo esc_html($name); ?>
              </p>

              <!-- PRICE -->
              <h3 class="mt-[40px] md:mt-[50px] font-bold text-[22px] md:text-[24px] leading-tight">
                <?php echo esc_html($price); ?>
              </h3>

            </div>

            <!-- DESCRIPTION -->
            <div class="mt-[40px] md:mt-[50px] mb-[40px] md:mb-[50px] text-[15px] md:text-[16px] leading-[1.6]">

              <?php echo wp_kses_post($description); ?>

            </div>

          </div>

          <?php endwhile; ?>

        </div>

      <?php endif; ?>

    </div>

  </div>

</section>

<section class="pb-[50px] md:pb-[50px] px-[20px] md:px-[40px] lg:px-0">

  <div class="max-w-[1440px] mx-auto grid grid-cols-12 gap-[10px]">

    <!-- FORM WRAPPER -->
    <div class="col-span-12 lg:col-start-4 lg:col-span-6">

      <!-- LOGO -->
      <div class="flex justify-center">

        <?php 
        $logo = get_field('contact_form_logo');
        if($logo): 
        ?>

          <img 
            src="<?php echo esc_url($logo['url']); ?>"
            class="w-auto h-auto max-w-[220px]"
          >

        <?php endif; ?>

      </div>

      <!-- DESCRIPTION -->
      <div class="mt-[20px] mb-[30px] text-center max-w-[620px] mx-auto">

        <p class="font-bold text-[16px] leading-[1.4]">
          <?php the_field('contact_form_description'); ?>
        </p>

      </div>

      <!-- FORM -->
      <form
        action="<?php echo esc_url( admin_url('admin-post.php') ); ?>"
        method="POST"
        class="w-full"
      >

        <input type="hidden" name="action" value="custom_contact_form">

        <?php wp_nonce_field( 'custom_contact_form_action', 'custom_contact_nonce' ); ?>

        <!-- TOP INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[15px] mb-[15px]">

          <!-- NAME -->
          <div>
            <input
              type="text"
              name="name"
              required
              placeholder="Meno a Priezvisko"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- EMAIL -->
          <div>
            <input
              type="email"
              name="email"
              required
              placeholder="E-mail"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- PHONE -->
          <div>
            <input
              type="text"
              name="phone"
              placeholder="Tel. číslo"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- ORDER TYPE -->
          <div>
            <select
              name="service"
              required
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] outline-none border-none"
            >
              <option value="">Objednávka/ CP:</option>
              <option value="Balíček Komplet">Balíček Komplet</option>
              <option value="Single">Single</option>
              <option value="Cenová ponuka">Cenová ponuka</option>
            </select>
          </div>

          <!-- PACKAGE TYPE -->
          <div>
            <select
              name="package_type"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] outline-none border-none"
            >
              <option value="">Typ balíku</option>
              <option value="Komplet">Komplet</option>
              <option value="Single">Single</option>
            </select>
          </div>

          <!-- DELIVERY -->
          <div>
            <select
              name="delivery"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] outline-none border-none"
            >
              <option value="">Doprava</option>
              <option value="Osobný odber">Osobný odber</option>
              <option value="Dovoz">Dovoz</option>
            </select>
          </div>

        </div>

        <!-- MESSAGE -->
        <div class="mb-[30px] mt-[30px]">

          <textarea
            name="message"
            required
            placeholder="Mám záujem o...."
            class="w-full h-[180px] md:h-[220px] bg-[#495057] rounded-[10px] p-[20px] text-white text-[16px] placeholder:text-[#E9ECEF] outline-none border-none resize-none"
          ></textarea>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-center">

          <button
            type="submit"
            class="bg-[#00A8E8] hover:bg-[#0096cf] transition duration-300 text-white font-bold text-[16px] md:text-[18px] rounded-[10px] px-[30px] md:px-[80px] h-[54px] md:h-[60px] cursor-pointer"
          >
            Odoslať kontaktný formulár
          </button>

        </div>

      </form>

      <!-- SUCCESS -->
      <?php if ( isset($_GET['contact']) && $_GET['contact'] === 'success' ) : ?>

        <p class="text-center text-green-500 font-bold mt-[20px] text-[16px]">
          Správa bola úspešne odoslaná.
        </p>

      <?php endif; ?>

    </div>

  </div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalId = 'galleryModal';
    let globalImages = [];
    let globalInstance = null;

    document.querySelectorAll('.js-gallery').forEach(gallery => {
        const images = Array.from(gallery.querySelectorAll('img')).map(img => img.src);
        const imgs = gallery.querySelectorAll('img');

        imgs.forEach((img, index) => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', () => {
                globalImages = images;
                globalInstance = createImageGallery(modalId, globalImages);
                globalInstance.openModal(index);
            });
        });
    });
});
</script>
<div id="galleryModal" class="fixed inset-0 bg-[#00000099] hidden z-[999] flex items-center justify-center p-10">
    <button class="absolute top-12 right-12 text-white text-4xl font-bold close-button cursor-pointer">
        ×
    </button>

    <button class="absolute left-8 text-white text-4xl font-bold prev-button cursor-pointer">
        ‹
    </button>

    <img
        id="modalImage"
        src=""
        alt="Gallery Image"
        class="max-w-full max-h-full object-contain rounded-xl"
    >

    <button class="absolute right-8 text-white text-4xl font-bold next-button cursor-pointer">
        ›
    </button>
</div>
</main>
<?php get_footer(); ?>