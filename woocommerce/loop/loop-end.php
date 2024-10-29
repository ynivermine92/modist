<?php

/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.0.0
 */

if (! defined('ABSPATH')) {
	exit;
}
?>

</ul>
<?php
/**
 * Hook: woocommerce_after_shop_loop.
 *
 * @hooked woocommerce_pagination - 10
 */
?>
<div class="col text-center">
	<div class="block-27">
		<?php
		do_action('woocommerce_after_shop_loop');
		
		?>
	</div>
</div>
</div>
</section>