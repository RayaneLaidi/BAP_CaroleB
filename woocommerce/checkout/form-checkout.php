<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<!-- CSS bizarre & voyant (temporaire) -->
<style>
	/* effet fond animé + contours visibles */
	body.page-checkout {
		background: linear-gradient(135deg, #ff0080 0%, #00d4ff 50%, #ffd400 100%);
		animation: caroleb-bg 10s linear infinite;
		color: #fff;
	}

	@keyframes caroleb-bg {
		0% {
			filter: hue-rotate(0deg)
		}

		50% {
			filter: hue-rotate(90deg)
		}

		100% {
			filter: hue-rotate(0deg)
		}
	}

	/* conteneur checkout stylé */
	.woocommerce-checkout {
		max-width: 1100px;
		margin: 2.5rem auto;
		padding: 2.2rem;
		background: rgba(0, 0, 0, 0.14);
		border: 4px dashed rgba(255, 255, 255, 0.18);
		border-radius: 14px;
		box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6), inset 0 0 120px rgba(255, 255, 255, 0.03);
		transform: rotate(-0.6deg);
	}

	/* titres néon */
	.woocommerce-checkout h3,
	.woocommerce-checkout h1 {
		text-transform: uppercase;
		letter-spacing: 2px;
		font-weight: 800;
		color: #fff;
		text-shadow: 0 0 12px rgba(0, 0, 0, 0.6), 0 0 30px rgba(255, 255, 255, 0.25);
	}

	/* champs */
	.woocommerce-checkout input,
	.woocommerce-checkout select,
	.woocommerce-checkout textarea {
		background: rgba(255, 255, 255, 0.06);
		border: 2px solid rgba(255, 255, 255, 0.12);
		color: #fff;
		padding: .7rem;
		border-radius: 8px;
	}

	/* boutons flashy */
	.woocommerce-checkout .button,
	.woocommerce-checkout input[type="submit"] {
		background: linear-gradient(45deg, #ffea00, #ff0077);
		color: #111;
		padding: 14px 26px;
		font-weight: 900;
		border-radius: 999px;
		border: 3px solid rgba(255, 255, 255, 0.6);
		box-shadow: 0 12px 40px rgba(0, 0, 0, 0.55);
		transition: transform .18s ease, box-shadow .18s ease;
	}

	.woocommerce-checkout .button:hover,
	.woocommerce-checkout input[type="submit"]:hover {
		transform: translateY(-8px) rotate(-1deg);
		box-shadow: 0 24px 80px rgba(0, 0, 0, 0.6);
	}

	/* colonnes légèrement séparées */
	.col-1,
	.col-2 {
		background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(0, 0, 0, 0.04));
		padding: 1rem;
		border-radius: 10px;
	}

	/* clignotement discret pour attirer l'oeil */
	.blinky {
		animation: caroleb-blink 1.2s steps(2, end) infinite;
		color: #ffef00;
		text-shadow: 0 0 12px #ffef00;
	}

	@keyframes caroleb-blink {
		50% {
			opacity: .08
		}
	}

	/* petit panneau flottant */
	.caroleb-weird {
		position: fixed;
		right: 18px;
		bottom: 18px;
		background: rgba(0, 0, 0, 0.85);
		color: #fff;
		padding: 10px 14px;
		border-radius: 8px;
		border: 2px solid #ff0077;
		box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6);
		z-index: 99999;
		transform: rotate(-6deg);
	}
</style>

<!-- panneau test visible -->
<div class="caroleb-weird blinky">Bienvenue sur une caisse créative ✨</div>
<?php
// Assurer que $checkout existe (évite l'erreur "appel sur null")
if (empty($checkout) || !is_object($checkout)) {
	$checkout = WC()->checkout();
}

do_action('woocommerce_before_checkout_form', $checkout);

// Si l'enregistrement est désactivé et que l'utilisateur n'est pas connecté
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html__('You must be logged in to checkout.', 'woocommerce');
	return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
	action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
	aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">

	<?php if ($checkout->get_checkout_fields()): ?>

			<?php do_action('woocommerce_checkout_before_customer_details'); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action('woocommerce_checkout_billing'); ?>
				</div>

				<div class="col-2">
					<?php do_action('woocommerce_checkout_shipping'); ?>
				</div>
			</div>

			<?php do_action('woocommerce_checkout_after_customer_details'); ?>

	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

	<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

	<?php do_action('woocommerce_checkout_before_order_review'); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action('woocommerce_checkout_order_review'); ?>
	</div>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>
<h1>test</h1>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>