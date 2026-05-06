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
    <div class="lg:col-start-2 lg:col-span-4">

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
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[30px] lg:gap-[10px] lg:col-start-7 lg:col-span-6 lg:self-center">

      <!-- LEFT -->
      <div class="flex flex-col gap-[30px] md:gap-[40px] lg:gap-[50px]">

        <?php if(!empty($person['image_1'])): ?>
          <div class="h-[200px] md:h-[220px] lg:h-[181px] rounded-[10px] overflow-hidden">
            <img src="<?= $person['image_1']['url']; ?>" class="w-full h-full object-cover">
          </div>
        <?php endif; ?>

        <div class="flex items-center gap-3 leading-none">
          <iconify-icon icon="ic:baseline-phone" class="w-[20px] h-[20px] text-white relative top-[1px]"></iconify-icon>
          <span><?= $person['phone']; ?></span>
        </div>

      </div>

      <!-- RIGHT -->
      <div class="flex flex-col gap-[30px] md:gap-[40px] lg:gap-[50px]">

        <?php if(!empty($person['image_2'])): ?>
          <div class="h-[200px] md:h-[220px] lg:h-[181px] rounded-[10px] overflow-hidden">
            <img src="<?= $person['image_2']['url']; ?>" class="w-full h-full object-cover">
          </div>
        <?php endif; ?>

        <div class="flex items-center gap-3 leading-none">
          <iconify-icon icon="ic:outline-email" class="w-[20px] h-[20px] text-white relative top-[1px]"></iconify-icon>
          <span class="break-all"><?= $person['email']; ?></span>
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
              <iconify-icon icon="ic:baseline-phone" class="w-[20px] h-[20px] text-white"></iconify-icon>
              <span><?= get_sub_field('phone'); ?></span>
            </div>
          <?php endif; ?>

          <?php if(get_sub_field('email')): ?>
            <div class="flex items-center gap-3">
              <iconify-icon icon="ic:outline-email" class="w-[20px] h-[20px] text-white"></iconify-icon>
              <span class="break-all"><?= get_sub_field('email'); ?></span>
            </div>
          <?php endif; ?>

          <?php if(get_sub_field('instagram')): ?>
            <div class="flex items-center gap-3">
              <iconify-icon icon="mdi:instagram" class="w-[20px] h-[20px] text-white"></iconify-icon>
              <span><?= get_sub_field('instagram'); ?></span>
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
</main>
<?php get_footer(); ?>