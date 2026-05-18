<?php get_header(); ?>
<main class="min-h-screen w-full bg-[#1E1E1E]">
<?php
$persons = [
  get_field('person_1'),
  get_field('person_2')
];
?>

<?php foreach ($persons as $person): ?>
<?php if ($person): ?>

<section class="<?= $person['dark_variant'] ? 'bg-[#1E1E1E]' : 'bg-[#212529]'; ?> py-[60px] md:py-[70px] lg:py-[80px] mb-[40px] rounded-[10px]">

  <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-[30px] lg:gap-[10px] px-[20px] md:px-[40px] lg:px-[80px] text-white">

    <!-- TEXT -->
    <div class="<?= $person['reverse_layout']
      ? 'lg:col-start-7 lg:col-span-5 lg:self-center'
      : 'lg:col-start-1 lg:col-span-5 lg:row-start-1'; ?>">

      <p class="italic text-[16px] text-gray-300 mb-1">
        <?= $person['first_name']; ?>
      </p>

      <h2 class="font-bold text-[28px] md:text-[30px] lg:text-[32px] mb-6">
        <?= $person['last_name']; ?>
      </h2>

      <div class="text-[16px] leading-[1.7] text-gray-200 mb-6 md:mb-8">
        <?= $person['description']; ?>
      </div>

    </div>

    <!-- IMAGES + CONTACT -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[30px] lg:gap-[10px] <?= $person['reverse_layout']
      ? 'lg:col-start-1 lg:col-span-5 lg:row-start-1'
      : 'lg:col-start-7 lg:col-span-5 lg:self-center'; ?>">

      <!-- LEFT -->
      <div class="flex flex-col justify-center gap-[30px] md:gap-[40px] lg:gap-[50px]">

        <?php if(!empty($person['image_1'])): ?>
          <div class="js-gallery">
            <?php if(!empty($person['image_1'])): ?>
              <div class="h-[200px] md:h-[220px] lg:h-[181px] rounded-[10px] overflow-hidden">
                <img src="<?= $person['image_1']['url']; ?>" class="w-full h-full object-cover">
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="flex items-center gap-3 leading-none">
        <iconify-icon icon="ic:baseline-phone" class="text-[22px] md:text-[32px] text-white relative top-[1px]"></iconify-icon>

        <a
          href="tel:<?= preg_replace('/\s+/', '', $person['phone']); ?>"
          class="hover:text-white transition">
          <?= $person['phone']; ?>
        </a>
      </div>

      </div>

      <!-- RIGHT -->
      <div class="flex flex-col justify-center gap-[30px] md:gap-[40px] lg:gap-[50px]">

        <?php if(!empty($person['image_2'])): ?>
          <div class="js-gallery">
            <?php if(!empty($person['image_2'])): ?>
              <div class="h-[200px] md:h-[220px] lg:h-[181px] rounded-[10px] overflow-hidden">
                <img src="<?= $person['image_2']['url']; ?>" class="w-full h-full object-cover">
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="flex items-center gap-3 leading-none">
        <iconify-icon icon="ic:outline-email" class="text-[22px] md:text-[32px] text-white relative top-[1px]"></iconify-icon>

        <a
          href="mailto:<?= $person['email']; ?>"
          class="break-all hover:text-white transition">
          <?= $person['email']; ?>
        </a>
      </div>
      </div>

    </div>

  </div>

</section>

<?php endif; ?>
<?php endforeach; ?>

<?php if(have_rows('trainers')): ?>

<section class="bg-[#212529] py-[80px] rounded-[10px]">

  <div class="grid grid-cols-12 gap-y-[50px] px-[20px] md:px-[40px] lg:px-[80px] text-white">

    <?php while(have_rows('trainers')): the_row(); ?>

      <div class="col-span-12 md:col-span-5 flex flex-col gap-[20px]">

        <!-- HEADER -->
        <div class="flex items-center gap-[20px]">

          <!-- IMAGE -->
          <?php $img = get_sub_field('image'); ?>
          <?php if($img): ?>
            <div class="w-[80px] h-[80px] rounded-full overflow-hidden flex-shrink-0">
              <img src="<?= $img['url']; ?>" class="w-full h-full object-cover">
            </div>
          <?php endif; ?>

          <!-- NAME + ROLE -->
          <div>
            <p class="italic text-[16px] text-gray-300">
              <?= get_sub_field('name'); ?>
            </p>
            <h3 class="font-bold text-[28px] lg:text-[32px]">
              <?= get_sub_field('role'); ?>
            </h3>
          </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="text-[16px] leading-[1.7] text-gray-200">
          <?= get_sub_field('description'); ?>
        </div>

        <!-- CONTACT -->
        <div class="flex flex-col gap-[10px] mt-[10px]">

        <?php if(get_sub_field('phone')): ?>
        <div class="flex items-center gap-3">
          <iconify-icon icon="ic:baseline-phone" class="text-[22px] md:text-[32px] text-white"></iconify-icon>

          <a
            href="tel:<?= preg_replace('/\s+/', '', get_sub_field('phone')); ?>"
            class="hover:text-white transition">
            <?= get_sub_field('phone'); ?>
          </a>
        </div>
      <?php endif; ?>

      <?php if(get_sub_field('email')): ?>
        <div class="flex items-center gap-3">
          <iconify-icon icon="ic:outline-email" class="text-[22px] md:text-[32px] text-white"></iconify-icon>

          <a
            href="mailto:<?= get_sub_field('email'); ?>"
            class="break-all hover:text-white transition">
            <?= get_sub_field('email'); ?>
          </a>
        </div>
      <?php endif; ?>

      <?php if(get_sub_field('instagram') && get_sub_field('instagram_link')): ?>
        <div class="flex items-center gap-3">
          <iconify-icon icon="mdi:instagram" class="text-[22px] md:text-[32px] text-white"></iconify-icon>

          <a
            href="<?= get_sub_field('instagram_link'); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="hover:text-white transition"
          >
            <?= get_sub_field('instagram'); ?>
          </a>
        </div>
      <?php endif; ?>

        </div>

      </div>

      <!-- GAP (2 columns between trainers) -->
      <div class="hidden md:block md:col-span-2"></div>

    <?php endwhile; ?>

  </div>

</section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalId = 'galleryModal';
    let currentImages = [];
    let instance = null;

    document.querySelectorAll('.js-gallery').forEach(gallery => {
        const images = Array.from(gallery.querySelectorAll('img')).map(img => img.src);

        gallery.querySelectorAll('img').forEach((img, index) => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', () => {
                currentImages = images;
                instance = createImageGallery(modalId, currentImages);
                instance.openModal(index);
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