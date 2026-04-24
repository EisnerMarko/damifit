<footer class="bg-[#1E1E1E] text-white px-6 md:px-12 lg:px-[80px] py-10">

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10
              justify-items-center lg:justify-items-stretch">

    <!-- LOGO + OTVÁRACIE HODINY -->
    <div class="lg:col-span-3 space-y-6 flex flex-col items-center text-center lg:items-start lg:text-left">

      <div class="text-2xl font-bold font-[Nunito]">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex-shrink-0">
          <img src="<?php echo get_template_directory_uri() . '/css/img/damifit_logo.png' ?>" 
               alt="Logo" 
               class="h-6 md:h-8 w-auto site-logo">
        </a>
      </div>

      <div class="font-[Ubuntu] text-[15px] md:text-[16px] space-y-2">
        <p class="opacity-80">Otváracie Hodiny:</p>
        <p><strong>Po - Pia:</strong> 10:00 - 21:00</p>
        <p><strong>So - Ne:</strong> 8:00 - 20:00</p>
      </div>

      <div class="flex gap-4 pt-2">
        <span class="text-[26px] md:text-[30px]"><iconify-icon icon="mdi:instagram"></iconify-icon></span>
        <span class="text-[26px] md:text-[30px]"><iconify-icon icon="mdi:facebook"></iconify-icon></span>
      </div>

    </div>

    <!-- KONTAKT -->
    <div class="lg:col-span-3 space-y-6 flex flex-col items-center text-center lg:items-start lg:text-left">

      <h3 class="font-[Nunito] text-[20px] md:text-[24px] font-bold">
        Kontaktné Údaje
      </h3>

      <div class="font-[Ubuntu] text-[15px] md:text-[16px] space-y-3">

        <a href="tel:+421904303520" class="flex items-center justify-center lg:justify-start gap-3">
          <iconify-icon icon="ic:baseline-phone" class="w-[20px] h-[20px] text-white"></iconify-icon>
          <span>+421 904 303 520</span>
        </a>

        <a href="tel:+421944217839" class="flex items-center justify-center lg:justify-start gap-3">
          <iconify-icon icon="ic:baseline-phone" class="w-[20px] h-[20px] text-white"></iconify-icon>
          <span>+421 944 217 839</span>
        </a>

        <a href="mailto:damifit.familygym@gmail.com"
   class="flex items-center justify-center lg:justify-start gap-3 w-full min-w-0">

  <iconify-icon icon="ic:outline-email"
    class="w-[20px] h-[20px] text-white flex-shrink-0"></iconify-icon>

  <span class="break-all sm:break-words text-center lg:text-left">
    damifit.familygym@gmail.com
  </span>

</a>

        <a href="https://www.google.com/maps/place/Damifit/@48.1197916,17.1090799,17z/data=!3m1!4b1!4m6!3m5!1s0x476c89dfb849fb01:0x62c83ab91930b6bf!8m2!3d48.119788!4d17.1116548!16s%2Fg%2F11h8j3_4z4?entry=ttu&g_ep=EgoyMDI2MDQyMS4wIKXMDSoASAFQAw%3D%3D"
           target="_blank"
           class="flex items-center justify-center lg:justify-start gap-3">
          <iconify-icon icon="ri:map-pin-line" class="w-[20px] h-[20px] text-white"></iconify-icon>
          <span>Gessayova 37-39, Bratislava 851 03</span>
        </a>

      </div>

    </div>

    <!-- OCHRANA ÚDAJOV -->
    <div class="lg:col-span-3 space-y-6 flex flex-col items-center text-center lg:items-start lg:text-left">

      <h3 class="font-[Nunito] text-[20px] md:text-[24px] font-bold">
        Ochrana Údajov
      </h3>

      <div class="font-[Ubuntu] text-[15px] md:text-[16px] space-y-3">
        <a href="#" class="block hover:underline">Obchodné Podmienky</a>
        <a href="#" class="block hover:underline">Ochrana Osobných Údajov</a>
        <a href="#" class="block hover:underline">Nastavenia Cookies</a>
      </div>

    </div>

    <!-- MENU -->
    <div class="lg:col-span-3 space-y-6 flex flex-col items-center text-center lg:items-start lg:text-left">

      <h3 class="font-[Nunito] text-[20px] md:text-[24px] font-bold">
        Hlavné Menu
      </h3>

      <div class="font-[Ubuntu] text-[15px] md:text-[16px] space-y-3">
        <a href="#" class="block hover:underline">Cenník</a>
        <a href="#" class="block hover:underline">Kontakt</a>
        <a href="#" class="block hover:underline">O Nás</a>
        <a href="#" class="block hover:underline">DamiFood</a>
      </div>

    </div>

  </div>

<div class="border-t border-white/20 mt-10 pt-4 -mx-6 md:-mx-12 lg:-mx-[80px]">

  <div class="px-[2px] md:px-2 lg:px-2 flex flex-col md:flex-row justify-between gap-2 text-sm font-[Ubuntu]
              text-center md:text-left">

    <span>© 2026</span>
    <span>Copyright © DamiFit</span>

  </div>

</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>