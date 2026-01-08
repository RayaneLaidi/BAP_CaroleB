<?php
/**
 * Template Checkout WooCommerce
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

if (!isset($checkout)) {
	$checkout = WC()->checkout();
}
?>

<div class="checkout-page">
	<div class="checkout-container">

		<!-- Header de la page checkout -->
		<header class="checkout-header">
			<h1 class="checkout-title"><?php esc_html_e('Finaliser la commande', 'woocommerce'); ?></h1>
		</header>

		<?php
		do_action('woocommerce_before_checkout_form', $checkout);

		if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
			echo '<div class="checkout-login-required">';
			echo esc_html(apply_filters(
				'woocommerce_checkout_must_be_logged_in_message',
				__('Vous devez être connecté pour finaliser votre commande.', 'woocommerce')
			));
			echo '</div>';
			return;
		}
		?>

		<!-- Formulaire principal -->
		<form name="checkout" method="post" class="checkout-form woocommerce-checkout"
			action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

			<div class="checkout-layout">

				<!-- Colonne gauche : Informations client -->
				<div class="checkout-column checkout-column--left">

					<?php if ($checkout->get_checkout_fields()): ?>

						<?php do_action('woocommerce_checkout_before_customer_details'); ?>

						<div class="customer-details">

							<!-- Section facturation -->
							<section class="checkout-section checkout-section--billing">
								<header class="section-header">
									<h2 class="section-title">
										<?php esc_html_e('Adresse de facturation', 'woocommerce'); ?>
									</h2>
								</header>
								<div class="section-content">
									<?php do_action('woocommerce_checkout_billing'); ?>
								</div>
							</section>

							<!-- Section livraison -->
							<section class="checkout-section checkout-section--shipping">
								<div class="section-content">
									<?php do_action('woocommerce_checkout_shipping'); ?>
								</div>
							</section>

						</div>

						<?php do_action('woocommerce_checkout_after_customer_details'); ?>

					<?php endif; ?>

				</div>

				<!-- Colonne droite : Récapitulatif -->
				<div class="checkout-column checkout-column--right">

					<?php do_action('woocommerce_checkout_before_order_review'); ?>

					<div class="order-summary">
						<header class="order-summary__header">
							<h2 class="order-summary__title">
								<?php esc_html_e('Votre commande', 'woocommerce'); ?>
							</h2>
						</header>

						<div class="order-summary__content">
							<?php do_action('woocommerce_checkout_order_review'); ?>
						</div>
					</div>

					<?php do_action('woocommerce_checkout_after_order_review'); ?>

				</div>

			</div>

		</form>

		<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

	</div>
</div>

<style>
	/* ==========================================================================
   VARIABLES ET RESET
   ========================================================================== */
	:root {
		--primary-color: #2c3e50;
		--secondary-color: #3498db;
		--accent-color: #e74c3c;
		--text-color: #333;
		--text-light: #666;
		--border-color: #e1e1e1;
		--bg-light: #f9f9f9;
		--bg-white: #fff;
		--success-color: #27ae60;
		--warning-color: #f39c12;
		--shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
		--radius: 8px;
		--transition: all 0.3s ease;
	}

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	/* ==========================================================================
   STRUCTURE PRINCIPALE
   ========================================================================== */
	.checkout-page {
		background: #fff;
		min-height: 100vh;
		padding: 30px 0 60px;
	}

	.checkout-container {
		max-width: 1200px;
		margin: 0 auto;
		padding: 0 20px;
	}

	.checkout-header {
		text-align: center;
		margin-bottom: 40px;
		padding-bottom: 20px;
		border-bottom: 2px solid var(--border-color);
	}

	.checkout-title {
		font-size: 32px;
		font-weight: 700;
		color: var(--primary-color);
		margin-bottom: 15px;
		letter-spacing: -0.5px;
	}

	/* ==========================================================================
   LAYOUT EN DEUX COLONNES
   ========================================================================== */
	.checkout-layout {
		display: grid;
		grid-template-columns: 1fr 380px;
		gap: 40px;
		align-items: start;
	}

	.checkout-column {
		background: var(--bg-white);
		border-radius: var(--radius);
		overflow: hidden;
	}

	.checkout-column--left {
		padding: 0;
		box-shadow: var(--shadow);
	}

	.checkout-column--right {
		position: sticky;
		top: 30px;
		box-shadow: var(--shadow);
	}

	/* ==========================================================================
   SECTIONS DU FORMULAIRE
   ========================================================================== */
	.checkout-section {
		padding: 30px;
		border-bottom: 1px solid var(--border-color);
	}

	.checkout-section:last-child {
		border-bottom: none;
	}

	.section-header {
		margin-bottom: 25px;
	}

	.section-title {
		font-size: 20px;
		font-weight: 600;
		color: var(--primary-color);
	}

	/* ==========================================================================
   CHAMPS DU FORMULAIRE
   ========================================================================== */
	.form-row {
		margin-bottom: 20px;
	}

	.form-row label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: var(--text-color);
		font-size: 14px;
	}

	.form-row input,
	.form-row select,
	.form-row textarea {
		width: 100%;
		padding: 14px;
		border: 1px solid var(--border-color);
		border-radius: var(--radius);
		font-size: 15px;
		transition: var(--transition);
		background: var(--bg-white);
	}

	.form-row input:focus,
	.form-row select:focus,
	.form-row textarea:focus {
		outline: none;
		border-color: #E0435B;
		box-shadow: 0 0 0 3px rgba(224, 67, 91, 0.1);
	}

	/* ==========================================================================
   RECAPITULATIF DE COMMANDE
   ========================================================================== */
	.order-summary {
		display: flex;
		flex-direction: column;
		height: 100%;
	}

	.order-summary__header {
		padding: 25px 30px;
		border-bottom: 1px solid var(--border-color);
		background: #E0435B;
		color: white;
	}

	.order-summary__title {
		font-size: 20px;
		font-weight: 600;
		color: white;
		margin: 0;
	}

	.order-summary__content {
		padding: 30px;
		flex: 1;
	}

	/* Tableau des produits */
	.woocommerce-checkout-review-order-table {
		width: 100%;
		border-collapse: collapse;
		margin-bottom: 25px;
	}

	.woocommerce-checkout-review-order-table th,
	.woocommerce-checkout-review-order-table td {
		padding: 15px 0;
		border-bottom: 1px solid var(--border-color);
		vertical-align: top;
	}

	.woocommerce-checkout-review-order-table th {
		font-weight: 600;
		color: var(--text-light);
		font-size: 14px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.woocommerce-checkout-review-order-table .product-name {
		font-weight: 500;
		color: var(--text-color);
	}

	.woocommerce-checkout-review-order-table .product-total {
		text-align: right;
		font-weight: 600;
	}

	/* Totaux */
	.cart-subtotal th,
	.cart-subtotal td {
		padding-top: 20px;
		font-size: 16px;
	}

	.order-total th,
	.order-total td {
		padding: 25px 0;
		font-size: 18px;
		font-weight: 700;
		border-top: 2px solid var(--primary-color);
		border-bottom: none;
		color: var(--primary-color);
	}

	/* ==========================================================================
   METHODES DE PAIEMENT - SANS RADIO VISIBLE
   ========================================================================== */
	.woocommerce-checkout-payment {
		background: var(--bg-light);
		padding: 25px;
		border-radius: var(--radius);
		margin-top: 30px;
	}

	.wc_payment_methods {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.wc_payment_method {
		margin-bottom: 15px;
		background: var(--bg-white);
		border-radius: var(--radius);
		border: 2px solid var(--border-color);
		transition: var(--transition);
		cursor: pointer;
		position: relative;
	}

	.wc_payment_method:hover {
		border-color: #E0435B;
		box-shadow: 0 2px 8px rgba(224, 67, 91, 0.15);
		transform: translateY(-2px);
	}

	.wc_payment_method label {
		display: block;
		padding: 15px 20px;
		cursor: pointer;
		margin: 0;
		font-weight: 600;
		font-size: 15px;
		width: 100%;
		text-align: center;
	}

	/* Masquer le bouton radio */
	.wc_payment_method input[type="radio"] {
		position: absolute;
		opacity: 0;
		width: 0;
		height: 0;
		pointer-events: none;
	}

	/* Style pour l'option sélectionnée */
	.wc_payment_method input[type="radio"]:checked~label {
		color: #E0435B;
	}

	.wc_payment_method.wc-active,
	.wc_payment_method input[type="radio"]:checked~* {
		border-color: #E0435B;
		background: rgba(224, 67, 91, 0.05);
	}

	.wc_payment_method.wc-active {
		border-color: #E0435B;
		background: rgba(224, 67, 91, 0.08);
		box-shadow: 0 2px 12px rgba(224, 67, 91, 0.2);
	}

	.wc_payment_method .payment_box {
		display: none !important;
	}

	.payment_method_bacs .payment_box p,
	.payment_method_bacs .payment_box .wc-bacs-bank-details {
		display: none;
	}

	/* Infos légales discrètes */
	.woocommerce-privacy-policy-text p,
	.woocommerce-terms-and-conditions-wrapper p {
		font-size: 11px;
		color: #777;
		line-height: 1.5;
		margin: 15px 0 0 0;
	}

	.woocommerce-privacy-policy-text a,
	.woocommerce-terms-and-conditions-wrapper a {
		color: #777;
		text-decoration: underline;
	}

	.woocommerce-privacy-policy-text a:hover,
	.woocommerce-terms-and-conditions-wrapper a:hover {
		color: #3498db;
	}

	/* Checkbox des conditions générales */
	.woocommerce-terms-and-conditions-wrapper .woocommerce-form__label-for-checkbox {
		display: flex;
		align-items: flex-start;
		gap: 8px;
		font-size: 12px;
		color: var(--text-color);
		cursor: pointer;
	}

	.woocommerce-terms-and-conditions-wrapper input[type="checkbox"] {
		margin-top: 3px;
		width: 16px;
		height: 16px;
		cursor: pointer;
	}

	/* ==========================================================================
   BOUTON DE COMMANDE
   ========================================================================== */
	#place_order {
		width: 100%;
		background: #fff;
		color: #E0435B;
		padding: 18px;
		border: 1px solid #E0435B;
		border-radius: var(--radius);
		font-size: 16px;
		font-weight: 700;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 1px;
		transition: var(--transition);
		margin-top: 20px;
	}

	#place_order:hover {
		background: #E0435B;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
	}

	#place_order:active {
		transform: translateY(0);
	}

	/* ==========================================================================
   MESSAGES ET ERREURS
   ========================================================================== */
	.woocommerce-error,
	.woocommerce-message {
		padding: 15px 20px;
		margin-bottom: 25px;
		border-radius: var(--radius);
		list-style: none;
		border-left: 4px solid;
	}

	.woocommerce-info {
		padding: 15px;
	}

	.woocommerce-error {
		background: #fee;
		border-left-color: var(--accent-color);
		color: #c00;
	}

	.woocommerce-message {
		background: #efe;
		border-left-color: var(--success-color);
		color: #090;
	}

	/* ==========================================================================
   RESPONSIVE
   ========================================================================== */
	@media (max-width: 992px) {
		.checkout-layout {
			grid-template-columns: 1fr;
			gap: 30px;
		}

		.checkout-column--right {
			position: static;
			order: -1;
		}

		.checkout-title {
			font-size: 28px;
		}
	}

	@media (max-width: 768px) {
		.checkout-container {
			padding: 0 15px;
		}

		.checkout-section {
			padding: 20px;
		}

		.order-summary__header,
		.order-summary__content {
			padding: 20px;
		}

		.checkout-title {
			font-size: 24px;
		}

		.section-title {
			font-size: 18px;
		}

		#place_order {
			padding: 16px;
			font-size: 15px;
		}
	}

	@media (max-width: 480px) {
		.checkout-page {
			padding: 20px 0 40px;
		}

		.checkout-title {
			font-size: 22px;
		}

		.form-row input,
		.form-row select,
		.form-row textarea {
			padding: 12px;
		}

		.woocommerce-checkout-review-order-table th,
		.woocommerce-checkout-review-order-table td {
			padding: 12px 0;
			font-size: 14px;
		}
	}

	/* ==========================================================================
   ANIMATIONS ET ETATS
   ========================================================================== */
	.woocommerce-processing {
		opacity: 0.7;
		pointer-events: none;
	}

	.loading-spinner {
		display: inline-block;
		width: 20px;
		height: 20px;
		border: 3px solid var(--border-color);
		border-top: 3px solid var(--secondary-color);
		border-radius: 50%;
		animation: spin 1s linear infinite;
		margin-right: 10px;
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	/* ==========================================================================
   SECTION LIVRAISON - AFFICHÉE AVEC CHECKBOX
   ========================================================================== */
	.checkout-section--shipping {
		padding: 30px;
		border-bottom: 1px solid var(--border-color);
		/* RETIRÉ: display: none; */
	}

	/* Style pour la checkbox "Livrer à une autre adresse" */
	.woocommerce-shipping-fields h3 {
		cursor: pointer;
		user-select: none;
		padding: 15px 20px;
		background: var(--bg-light);
		border-radius: var(--radius);
		margin-bottom: 0;
		transition: var(--transition);
		display: flex;
		align-items: center;
		border: 1px solid var(--border-color);
	}

	.woocommerce-shipping-fields h3:hover {
		background: #f0f0f0;
		border-color: #E0435B;
	}

	.woocommerce-shipping-fields h3 label {
		cursor: pointer;
		display: flex;
		align-items: center;
		gap: 10px;
		margin: 0;
		font-weight: 600;
		flex: 1;
		font-size: 15px;
	}

	.woocommerce-shipping-fields h3 input[type="checkbox"] {
		width: 20px;
		height: 20px;
		min-width: 20px;
		margin: 0;
		cursor: pointer;
		accent-color: #E0435B;
		order: -1;
	}

	/* Masquer les champs de livraison par défaut */
	.shipping_address {
		display: none;
		margin-top: 20px;
		padding-top: 20px;
		border-top: 1px solid var(--border-color);
	}

	.shipping_address.show-fields {
		display: block;
		animation: slideDown 0.4s ease;
	}

	@keyframes slideDown {
		from {
			opacity: 0;
			max-height: 0;
			overflow: hidden;
		}
		to {
			opacity: 1;
			max-height: 2000px;
		}
	}

	/* Indicateur visuel */
	.woocommerce-shipping-fields h3::after {
		content: "▼";
		margin-left: auto;
		font-size: 14px;
		transition: transform 0.3s ease;
		color: #E0435B;
		font-weight: 700;
	}

	.woocommerce-shipping-fields h3.expanded::after {
		transform: rotate(180deg);
	}
</style>

<script>
	jQuery(document).ready(function ($) {
		console.log('Script checkout initialisé');

		// Gérer l'affichage de la section livraison
		const $shippingCheckbox = $('#ship-to-different-address-checkbox');
		const $shippingFields = $('.shipping_address');
		const $shippingTitle = $('.woocommerce-shipping-fields h3');

		console.log('Checkbox trouvée:', $shippingCheckbox.length);
		console.log('Champs trouvés:', $shippingFields.length);

		// Fonction pour afficher/masquer les champs de livraison
		function toggleShippingFields() {
			console.log('Toggle - Checkbox cochée:', $shippingCheckbox.is(':checked'));
			
			if ($shippingCheckbox.is(':checked')) {
				$shippingFields.addClass('show-fields').slideDown(400);
				$shippingTitle.addClass('expanded');
				console.log('Affichage des champs de livraison');
			} else {
				$shippingFields.removeClass('show-fields').slideUp(400);
				$shippingTitle.removeClass('expanded');
				console.log('Masquage des champs de livraison');
			}
		}

		// Initialiser l'état au chargement
		setTimeout(function() {
			toggleShippingFields();
		}, 100);

		// Écouter les changements sur la checkbox
		$shippingCheckbox.on('change', function () {
			console.log('Changement détecté');
			toggleShippingFields();
		});

		// Permettre de cliquer sur le titre H3 pour toggle
		$shippingTitle.on('click', function (e) {
			console.log('Clic sur le titre');
			if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
				e.preventDefault();
				$shippingCheckbox.prop('checked', !$shippingCheckbox.is(':checked')).trigger('change');
			}
		});

		// Supprimer le texte de description du virement bancaire
		$('.payment_method_bacs .payment_box').remove();

		// Permettre de cliquer sur toute la zone de méthode de paiement
		$('.wc_payment_method').on('click', function (e) {
			if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
				$(this).find('input[type="radio"]').prop('checked', true).trigger('change');
			}
		});

		// Ajouter un style visuel lors du clic
		$('.wc_payment_method label').on('click', function () {
			$('.wc_payment_method').removeClass('wc-active');
			$(this).closest('.wc_payment_method').addClass('wc-active');
		});

		// Initialiser l'état actif au chargement
		$('.wc_payment_method input[type="radio"]:checked').closest('.wc_payment_method').addClass('wc-active');

		// Mettre à jour l'état actif lors du changement
		$('.wc_payment_method input[type="radio"]').on('change', function () {
			$('.wc_payment_method').removeClass('wc-active');
			if ($(this).is(':checked')) {
				$(this).closest('.wc_payment_method').addClass('wc-active');
			}
		});
	});
</script>

<?php
get_footer();
?>