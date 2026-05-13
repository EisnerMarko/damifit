<?php get_header(); ?>
<main class="min-h-screen w-full bg-[#1E1E1E]">
<?php
$sections = [
  get_field('section_1'),
  get_field('section_2')
];
?>

<?php foreach ($sections as $section): ?>
<?php if ($section): ?>

<section class="<?= $section['dark_variant'] ? 'bg-[#1E1E1E]' : 'bg-[#212529]'; ?> py-[50px] md:py-[60px] lg:py-[80px] mb-[30px] md:mb-[40px] rounded-[10px] overflow-hidden">

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-[10px] items-center gap-y-[50px] lg:gap-y-0 px-[20px] md:px-[40px] lg:px-[80px] text-white">

    <!-- TEXT -->
    <div class="<?= $section['reverse_layout']
      ? 'lg:col-start-8 lg:col-span-4 lg:row-start-1'
      : 'lg:col-start-1 lg:col-span-4 lg:row-start-1'; ?>">

      <p class="italic text-[15px] md:text-[16px] text-gray-300 mb-1">
        <?= $section['subtitle']; ?>
      </p>

      <h2 class="font-bold text-[32px] md:text-[38px] lg:text-[32px] leading-none mb-5 md:mb-6">
        <?= $section['title']; ?>
      </h2>

      <div class="text-[16px] md:text-[17px] lg:text-[16px] leading-[1.8] text-gray-200 space-y-5">
        <?= $section['description']; ?>
      </div>

    </div>

    <!-- CONTACT -->
    <div class="<?= $section['reverse_layout']
      ? 'lg:col-start-1 lg:col-span-4 lg:row-start-1'
      : 'lg:col-start-8 lg:col-span-4 lg:row-start-1'; ?> flex justify-start lg:justify-center">

      <div class="flex flex-col gap-[24px] md:gap-[28px] lg:gap-[30px] w-full max-w-[420px]">

        <!-- PHONE -->
        <?php if(!empty($section['phone'])): ?>
        <div class="flex items-center gap-5">

          <iconify-icon
            icon="ic:baseline-phone"
            class="text-white relative top-[1px] shrink-0 text-[22px] md:text-[42px]">
          </iconify-icon>

          <a
            href="tel:<?= preg_replace('/\s+/', '', $section['phone']); ?>"
            class="text-[17px] md:text-[18px] text-gray-200 hover:text-white transition break-words"
          >
            <?= $section['phone']; ?>
          </a>

        </div>
        <?php endif; ?>

        <!-- EMAIL -->
        <?php if(!empty($section['email'])): ?>
        <div class="flex items-center gap-5">

          <iconify-icon
            icon="ic:outline-email"
            class="text-white relative top-[1px] shrink-0 text-[22px] md:text-[42px]">
          </iconify-icon>

          <a
            href="mailto:<?= $section['email']; ?>"
            class="text-[17px] md:text-[18px] text-gray-200 break-all hover:text-white transition"
          >
            <?= $section['email']; ?>
          </a>

        </div>
        <?php endif; ?>

        <!-- ADDRESS -->
        <?php if(!empty($section['address'])): ?>
        <div class="flex items-center gap-5">

          <iconify-icon
            icon="mdi:map-marker-outline"
            class="text-white relative top-[1px] shrink-0 text-[22px] md:text-[42px]">
          </iconify-icon>

          <span class="text-[17px] md:text-[18px] text-gray-200 leading-[1.6]">
            <?= $section['address']; ?>
          </span>

        </div>
        <?php endif; ?>

        <!-- SOCIALS -->
        <div class="flex flex-wrap items-center gap-x-[28px] gap-y-[18px] pt-[8px]">

        <?php if(!empty($section['instagram_name']) && !empty($section['instagram_link'])): ?>
        <div class="flex items-center gap-4">

          <iconify-icon
            icon="mdi:instagram"
            class="text-white relative top-[1px] shrink-0 text-[22px] md:text-[42px]">
          </iconify-icon>

          <a
            href="<?= $section['instagram_link']; ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="text-[17px] md:text-[18px] text-gray-200 hover:text-white transition"
          >
            <?= $section['instagram_name']; ?>
          </a>

        </div>
        <?php endif; ?>

        <?php if(!empty($section['facebook_name']) && !empty($section['facebook_link'])): ?>
        <div class="flex items-center gap-4">

          <iconify-icon
            icon="ic:baseline-facebook"
            class="text-white relative top-[1px] shrink-0 text-[22px] md:text-[42px]">
          </iconify-icon>

          <a
            href="<?= $section['facebook_link']; ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="text-[17px] md:text-[18px] text-gray-200 hover:text-white transition"
          >
            <?= $section['facebook_name']; ?>
          </a>

        </div>
        <?php endif; ?>

        </div>

      </div>

    </div>

  </div>

</section>

<?php endif; ?>
<?php endforeach; ?>

<?php
$kontakt_image = get_field('kontakt_image');
?>

<section class="px-[20px] sm:px-[40px] lg:px-[80px] pb-[50px]">

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-[10px] md:gap-[20px] lg:gap-[10px]">

    <!-- MAP -->
    <div class="lg:col-span-6 h-[240px] sm:h-[280px] md:h-[340px] lg:h-[365px] rounded-[10px] overflow-hidden">

      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2663.5046001024743!2d17.109079876502378!3d48.119791552399114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c89dfb849fb01%3A0x62c83ab91930b6bf!2sDamifit!5e0!3m2!1ssk!2sdk!4v1777891151774!5m2!1ssk!2sdk"
        class="w-full h-full rounded-[10px]"
        style="border:0;"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>

    </div>

    <!-- IMAGE -->
    <div class="lg:col-span-6 h-[240px] sm:h-[280px] md:h-[340px] lg:h-[365px] rounded-[10px] overflow-hidden">

      <?php if(!empty($kontakt_image)): ?>
        <img
          src="<?= $kontakt_image['url']; ?>"
          alt="<?= $kontakt_image['alt']; ?>"
          class="w-full h-full object-cover"
        >
      <?php endif; ?>

    </div>

  </div>

</section>

<section class="pb-[50px] px-[20px] md:px-[40px] lg:px-0">

  <div class="max-w-[1160px] mx-auto grid grid-cols-12 gap-[10px]">

    <!-- FORM WRAPPER -->
    <div class="col-span-12 lg:col-start-4 lg:col-span-6">

      <h2 class="text-white text-center font-bold text-[32px] md:text-[42px] lg:text-[56px] leading-none mb-[30px] md:mb-[40px]">
        Kontaktný formulár
      </h2>

      <form
        action="<?php echo esc_url( admin_url('admin-post.php') ); ?>"
        method="POST"
        class="w-full"
      >

        <input type="hidden" name="action" value="custom_contact_form">

        <?php wp_nonce_field( 'custom_contact_form_action', 'custom_contact_nonce' ); ?>

        <!-- TOP INPUTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[15px] mb-[30px]">

          <!-- NAME -->
          <div>
            <input
              type="text"
              name="name"
              required
              placeholder="Meno a Priezvisko"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] md:text-[18px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- EMAIL -->
          <div>
            <input
              type="email"
              name="email"
              required
              placeholder="E-mail"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] md:text-[18px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- PHONE -->
          <div>
            <input
              type="text"
              name="phone"
              placeholder="Tel. číslo"
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] md:text-[18px] placeholder:text-[#E9ECEF] outline-none border-none"
            />
          </div>

          <!-- SERVICE -->
          <div>
            <select
              name="service"
              required
              class="w-full h-[54px] md:h-[60px] bg-[#495057] rounded-[10px] px-[20px] text-white text-[16px] md:text-[18px] outline-none border-none"
            >
              <option value="">Služba</option>
              <option value="Osobný tréning">Osobný tréning</option>
              <option value="Jednálniček">Jednálniček</option>
              <option value="DamiFood">DamiFood</option>
              <option value="Iné">Iné</option>
            </select>
          </div>

        </div>

        <!-- MESSAGE -->
        <div class="mb-[30px] mt-[30px]">

          <textarea
            name="message"
            required
            placeholder="Mám záujem o..."
            class="w-full h-[180px] md:h-[220px] bg-[#495057] rounded-[10px] p-[20px] text-white text-[16px] md:text-[18px] placeholder:text-[#E9ECEF] outline-none border-none resize-none"
          ></textarea>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-center">

          <button
            type="submit"
            class="bg-[#00A8E8] hover:bg-[#0096cf] transition duration-300 text-white font-bold text-[18px] md:text-[20px] rounded-[14px] px-[40px] md:px-[80px] h-[56px] md:h-[64px] cursor-pointer"
          >
            Odoslať kontaktný formulár
          </button>

        </div>

      </form>

      <?php if ( isset($_GET['contact']) && $_GET['contact'] === 'success' ) : ?>

        <p class="text-center text-green-500 font-bold mt-[20px] text-[16px]">
          Správa bola úspešne odoslaná.
        </p>

      <?php endif; ?>

    </div>

  </div>

</section>

</main>
<?php get_footer(); ?>