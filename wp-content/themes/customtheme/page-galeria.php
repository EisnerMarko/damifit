<?php get_header(); ?>

<?php
$gallery_images = [];

if (have_rows('gallery_images')) {
    while (have_rows('gallery_images')) {
        the_row();
        $image = get_sub_field('gallery_image');

        if ($image) {
            $gallery_images[] = $image['url'];
        }
    }

    reset_rows();
}
?>

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
                  class="gallery-image w-full h-full object-cover cursor-pointer"
                  data-index="<?php echo get_row_index() - 1; ?>"
                  loading="lazy"
              >
            </div>
          <?php endif; ?>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>

  </div>
</section>
<div id="galleryModal" class="fixed inset-0 bg-[#00000099] hidden z-500 flex items-center justify-center p-10">
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
<script>
document.addEventListener('DOMContentLoaded', () => {

    const imagesArray = <?php echo json_encode($gallery_images); ?>;

    const gallery = createImageGallery('galleryModal', imagesArray);

    document.querySelectorAll('.gallery-image').forEach(image => {

        image.addEventListener('click', () => {

            const index = parseInt(image.dataset.index);

            gallery.openModal(index);

        });

    });

});
</script>
<?php get_footer(); ?>