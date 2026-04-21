<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.2.1/iconify.min.js"></script>
  <title>
    <?php
    if ( is_singular() ) {
        the_title();
    } elseif ( is_home() || is_front_page() ) {
        bloginfo('name');
    } else {
        bloginfo('name');
    }
    ?>
  </title>
  <?php if (has_excerpt()) : ?>
    <meta name="description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
  <?php elseif (get_the_content()) : ?>
    <meta name="description" content="<?php echo esc_attr(wp_trim_words(strip_tags(get_the_content()), 25)); ?>">
  <?php else : ?>
    <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php endif; ?>
  <link rel="icon" href="<?php echo get_template_directory_uri() . '/css/img/damifit_logo.png' ?>" type="image/png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> class="w-full h-full">

<header class="w-full bg-[#212529]">
  <nav class="flex items-center justify-around h-16">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex-shrink-0">
      <img src="<?php echo get_template_directory_uri() . '/css/img/damifit_logo.png' ?>" alt="Logo" class="h-6 md:h-9 w-auto site-logo">
    </a>
    <button id="menu-toggle" class="md:hidden text-3xl focus:outline-none text-white" aria-label="Open main menu">
      <span class="iconify" data-icon="mdi:menu"></span>
    </button>
    <div id="menu" class="md:flex absolute md:static top-16 left-0 w-full md:w-auto md:bg-transparent shadow md:shadow-none z-20">
    <ul class="flex flex-col items-center md:flex-row bg-[#212529] uppercase text-white md:space-x-6 px-4 pb-4 md:px-0 md:pb-0">
        <li class="text-base font-bold p-2 md:p-0 hover:text-[#00A8E8]">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path(''))); ?>">Cenník</a>
        </li>

        <li class="text-base font-bold p-2 md:p-0 hover:text-[#00A8E8]">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path(''))); ?>">Kontakt</a>
        </li>
        <li class="text-base font-bold p-2 md:p-0 hover:text-[#00A8E8]">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path(''))); ?>">Personál</a>
        </li>
        <li class="text-base font-bold p-2 md:p-0 hover:text-[#00A8E8]">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path(''))); ?>">Galéria</a>
        </li>
        <li class="text-base font-bold p-2 md:p-0 hover:text-[#00A8E8]">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path(''))); ?>">DamiFood</a>
        </li>
        <a href="#" aria-label="Shopping Cart" class="text-white hover:text-[#00A8E8] text-4xl ml-0 lg:ml-40">
          <span class="iconify" data-icon="majesticons:shopping-cart-line"></span>
        </a>
    </ul>
    </div>
  </nav>
</header>