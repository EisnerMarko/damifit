<?php
defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid gap-20 lg:grid-cols-2 py-20', $product ); ?>>

	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

	<div class="summary entry-summary space-y-6">
		<?php
		woocommerce_template_single_title();

		$raw_description = $product->get_description();
		$description = trim( $raw_description );

		if ( $description ) {
			$description = preg_replace( '/<!-- wp:[\s\S]*?-->/m', '', $description );
			$description = strip_shortcodes( $description );
			$description = wpautop( wp_kses_post( $description ) );
			?>
			<div class="product-description text-white">
				<?php echo $description; ?>
			</div>
			<?php
		}

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

</div>

<section>
	<?php woocommerce_output_related_products(); ?>
</section>

<?php do_action( 'woocommerce_after_single_product' );
