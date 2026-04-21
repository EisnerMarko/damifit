<?php get_header(); ?>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post();?>

        <main class="min-h-screen w-full">
            <section class="w-full flex justify-center z-0 overflow-hidden relative">
 
            </section>
        </main>

        <?php endwhile; ?>
    <?php endif; ?>
<?php get_footer(); ?>