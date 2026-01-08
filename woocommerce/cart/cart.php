<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined('ABSPATH') || exit;
get_header();
?>

<style>
	/* Titre de la page */
	.cart-page-title {
		text-align: center;
		font-size: 32px;
		font-weight: 700;
		margin: 40px 0 20px;
		text-transform: uppercase;
		letter-spacing: 1px;
	}

	/* Styles spécifiques pour le panier */
	.cart-layout {
		display: grid;
		grid-template-columns: 1fr 400px;
		gap: 40px;
		max-width: 1200px;
		margin: 0 auto;
		padding: 40px 20px;
	}

	.cart-main {
		background: #fff;
		padding: 30px;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
	}

	.cart-sidebar {
		background: #fff;
		padding: 30px;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
		height: fit-content;
		position: sticky;
		top: 20px;
	}

	/* Tableau des produits */
	.woocommerce-cart-form__contents {
		width: 100%;
		border-collapse: collapse;
	}

	.woocommerce-cart-form__contents thead {
		display: none;
	}

	.woocommerce-cart-form__cart-item {
		border-bottom: 1px solid #E0435B;
		padding: 20px 0;
		display: flex;
		flex-wrap: wrap;
		position: relative;
	}

	.product-remove {
		position: absolute;
		top: 10px;
		right: 0;
	}

	.product-remove .remove {
		font-size: 24px;
		color: #999;
		text-decoration: none;
		line-height: 1;
	}

	.product-remove .remove:hover {
		color: #ff0000;
	}

	.product-thumbnail {
		width: 100px;
		margin-right: 20px;
	}

	.product-thumbnail img {
		width: 100%;
		height: auto;
		border-radius: 4px;
	}

	.product-info {
		flex: 1;
		min-width: 200px;
	}

	.product-name {
		font-weight: 600;
		font-size: 16px;
		margin-bottom: 5px;
	}

	.product-name a {
		color: #333;
		text-decoration: none;
	}

	.product-variation {
		color: #666;
		font-size: 14px;
		margin: 5px 0;
	}

	.product-price,
	.product-subtotal {
		font-weight: 600;
		color: #333;
		margin: 10px 0;
	}

	.product-quantity {
		margin: 10px 0;
	}

	.quantity {
		display: flex;
		align-items: center;
		border: 1px solid #E0435B;
		border-radius: 4px;
		width: fit-content;
		
		
	}

	.quantity .qty {
		width: 60px;
		text-align: center;
		border: none;
		padding: 8px;
		font-size: 16px;
		color : #E0435B;
	}

	.quantity button {
		background: #f5f5f5;
		border: none;
		width: 40px;
		height: 100%;
		cursor: pointer;
		font-size: 18px;
		color: #E0435B;
	}

	/* Récapitulatif */
	.custom-cart-summary h2 {
		
		font-size: 20px;
		margin-bottom: 20px;
		padding-bottom: 10px;
		border-bottom: 2px solid #E0435B;
	}

	.summary-subtotal,
	.summary-shipping,
	.summary-coupon,
	.summary-total {
		display: flex;
		justify-content: space-between;
		margin: 15px 0;
		padding-bottom: 10px;
		border-bottom: 1px solid #E0435B ;
	}

	.summary-total {
		border-bottom: 2px solid #E0435B;
		font-size: 18px;
		padding-top: 15px;
		margin-top: 20px;
	}

	.checkout-button {
		display: block;
		width: 100%;
		background: #fff;
		color: #E0435B;
		text-align: center;
		padding: 15px;
		border-radius: 4px;
		text-decoration: none;
		font-weight: 600;
		font-size: 16px;
		margin-top: 20px;
		border: 1px solid #E0435B;
		cursor: pointer;
	}

	.checkout-button:hover {
		background: #E0435B;
		color: #fff;
	}

	/* Coupons */
	.coupon {
		display: flex;
		gap: 10px;
		margin: 20px 0;
		flex-direction: column;
	}

	.coupon-input-group {
		display: flex;
		gap: 10px;
	}

	.coupon input {
		flex: 1;
		padding: 10px;
		border: 1px solid #E0435B;
		border-radius: 4px;
	}

	.coupon button {
		background: #fff;
		color: #E0435B;
		border: 1px solid #E0435B;
		padding: 10px 20px;
		border-radius: 4px;
		cursor: pointer;
		font-weight: 600;
	}

	.coupon button:hover {
		background: #E0435B;
		color: #fff;
	}

	.coupon-message {
		font-size: 13px;
		padding: 8px 12px;
		margin-top: 8px;
		border-radius: 4px;
		min-height: 20px;
		transition: all 0.3s ease;
	}

	.coupon-message:empty {
		display: none;
		padding: 0;
		min-height: 0;
	}

	.coupon-message.error {
		color: #cc0000;
		background: #ffe6e6;
		border: 1px solid #ffcccc;
		display: block !important;
	}

	.coupon-message.success {
		color: #008000;
		background: #e6ffe6;
		border: 1px solid #ccffcc;
		display: block !important;
	}

	/* Responsive */
	@media (max-width: 992px) {
		.cart-layout {
			grid-template-columns: 1fr;
		}

		.cart-sidebar {
			position: static;
			margin-top: 30px;
		}
	}

	@media (max-width: 768px) {
		.woocommerce-cart-form__cart-item {
			flex-direction: column;
		}

		.product-thumbnail {
			width: 100%;
			margin-right: 0;
			margin-bottom: 15px;
		}

		.product-thumbnail img {
			max-width: 150px;
		}
	}
</style>

<script>
	jQuery(document).ready(function ($) {
		var updateTimeout;

		// Fonction de mise à jour AJAX du panier
		function updateCartAjax() {
			console.log('Mise à jour AJAX du panier...');

			// Ajouter overlay de chargement
			if ($('.cart-loading-overlay').length === 0) {
				$('.cart-sidebar').css('position', 'relative').append(
					'<div class="cart-loading-overlay" style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;z-index:10;border-radius:8px;"><span style="font-weight:600;">Mise à jour...</span></div>'
				);
				$('.cart-main').css('opacity', '0.6');
			}

			var $form = $('.woocommerce-cart-form');

			$.ajax({
				type: 'POST',
				url: $form.attr('action'),
				data: $form.serialize() + '&update_cart=1',
				success: function (html) {
					var $html = $(html);

					// Remplacer le contenu du panier
					$('.woocommerce-cart-form__contents').html(
						$html.find('.woocommerce-cart-form__contents').html()
					);

					// Remplacer le récapitulatif
					$('.custom-cart-summary').html(
						$html.find('.custom-cart-summary').html()
					);

					// Mettre à jour les notices
					var $notices = $html.find('.woocommerce-notices-wrapper');
					if ($notices.length) {
						if ($('.woocommerce-notices-wrapper').length) {
							$('.woocommerce-notices-wrapper').html($notices.html());
						} else {
							$('.cart-main').prepend($notices);
						}
					}

					// Retirer l'overlay
					$('.cart-loading-overlay').remove();
					$('.cart-main').css('opacity', '1');

					// Trigger des événements WooCommerce
					$(document.body).trigger('updated_cart_totals');
					$(document.body).trigger('wc_fragment_refresh');

					console.log('✓ Panier mis à jour avec succès');
				},
				error: function () {
					console.log('✗ Erreur, rechargement de la page...');
					location.reload();
				}
			});
		}

		// Mise à jour lors du changement de quantité
		$(document).on('change', 'input.qty', function () {
			console.log('Quantité changée');
			clearTimeout(updateTimeout);

			updateTimeout = setTimeout(function () {
				updateCartAjax();
			}, 1000);
		});

		// Mise à jour lors de la suppression d'un produit
		$(document).on('click', 'a.remove', function (e) {
			e.preventDefault();
			console.log('Suppression d\'un produit');

			var $removeLink = $(this);
			var removeUrl = $removeLink.attr('href');

			// Ajouter overlay de chargement
			$('.cart-sidebar').css('position', 'relative').append(
				'<div class="cart-loading-overlay" style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;z-index:10;border-radius:8px;"><span style="font-weight:600;">Suppression...</span></div>'
			);
			$('.cart-main').css('opacity', '0.6');

			// Effectuer la suppression via AJAX
			$.get(removeUrl, function () {
				// Recharger le panier après suppression
				updateCartAjax();
			}).fail(function () {
				location.reload();
			});
		});

		// Validation du code coupon
		$(document).on('click', 'button[name="apply_coupon"]', function (e) {
			var couponCode = $('#coupon_code').val().trim();

			console.log('Validation coupon:', couponCode);

			if (couponCode === '') {
				e.preventDefault();
				console.log('Coupon vide - affichage message');

				var $message = $('#coupon-message');
				$message
					.removeClass('success')
					.addClass('error')
					.html('Veuillez entrer un code de coupon.')
					.css('display', 'block')
					.show();

				return false;
			}

			// Masquer le message précédent
			$('#coupon-message').hide().removeClass('success error').html('');

			// Ajouter overlay pour l'application du coupon
			$('.cart-sidebar').css('position', 'relative').append(
				'<div class="cart-loading-overlay" style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;z-index:10;border-radius:8px;"><span style="font-weight:600;">Vérification du coupon...</span></div>'
			);
		});

		// Gérer la soumission du formulaire pour les coupons
		$('.woocommerce-cart-form').on('submit', function (e) {
			var $submitBtn = $(this).find('button[name="apply_coupon"]');

			// Si c'est une application de coupon
			if ($submitBtn.is(':focus') || document.activeElement === $submitBtn[0]) {
				e.preventDefault();

				var $form = $(this);

				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: $form.serialize(),
					success: function (html) {
						var $html = $(html);

						// Remplacer le contenu
						$('.woocommerce-cart-form__contents').html(
							$html.find('.woocommerce-cart-form__contents').html()
						);
						$('.custom-cart-summary').html(
							$html.find('.custom-cart-summary').html()
						);

						// Vérifier si le coupon a été appliqué ou refusé
						var $errorNotices = $html.find('.woocommerce-error');
						var $successNotices = $html.find('.woocommerce-message');

						console.log('Erreurs trouvées:', $errorNotices.length);
						console.log('Succès trouvés:', $successNotices.length);

						var $message = $('#coupon-message');

						if ($errorNotices.length > 0) {
							// Extraire le texte de l'erreur
							var errorText = $errorNotices.first().text().trim();
							console.log('Message erreur:', errorText);

							// Afficher le message d'erreur
							$message
								.removeClass('success')
								.addClass('error')
								.html(errorText)
								.css('display', 'block')
								.show();

						} else if ($successNotices.length > 0) {
							console.log('Coupon appliqué avec succès');

							// Afficher le message de succès
							$message
								.removeClass('error')
								.addClass('success')
								.html('✓ Coupon appliqué avec succès !')
								.css('display', 'block')
								.show();

							// Vider le champ coupon
							$('#coupon_code').val('');

							// Masquer le message après 3 secondes
							setTimeout(function () {
								$message.fadeOut(function () {
									$(this).removeClass('success').html('');
								});
							}, 3000);
						} else {
							console.log('Aucun message trouvé');
							$message.hide().removeClass('success error').html('');
						}

						// Retirer l'overlay
						$('.cart-loading-overlay').remove();
						$('.cart-main').css('opacity', '1');

						$(document.body).trigger('updated_cart_totals');
					},
					error: function () {
						console.log('Erreur AJAX');

						$('#coupon-message')
							.removeClass('success')
							.addClass('error')
							.html('Une erreur est survenue. Veuillez réessayer.')
							.css('display', 'block')
							.show();

						$('.cart-loading-overlay').remove();
						$('.cart-main').css('opacity', '1');
					}
				});

				return false;
			}
		});
	});
</script>

<div class="container">
	<h1 class="cart-page-title"><?php esc_html_e('Cart', 'woocommerce'); ?></h1>
</div>

<div class="container cart-layout">
	<main class="cart-main">
		<?php do_action('woocommerce_before_cart'); ?>

		<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<tbody>
					<?php do_action('woocommerce_before_cart_contents'); ?>

					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
						$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
							?>
							<tr
								class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
								<td class="product-remove" data-title="<?php esc_attr_e('Remove', 'woocommerce'); ?>">
									<?php
									echo apply_filters(
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</td>

								<td class="product-thumbnail" data-title="<?php esc_attr_e('Thumbnail', 'woocommerce'); ?>">
									<?php
									$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
									if (!$product_permalink) {
										echo $thumbnail;
									} else {
										printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
									}
									?>
								</td>

								<td class="product-info">
									<div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
										<?php
										if (!$product_permalink) {
											echo wp_kses_post($product_name . '&nbsp;');
										} else {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
										}

										do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

										// Afficher les variations de produit
										echo wc_get_formatted_cart_item_data($cart_item);

										if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
										}
										?>
									</div>

									<div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
										<strong><?php esc_html_e('PRIX:', 'woocommerce'); ?></strong>
										<?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
									</div>

									<div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
										<strong><?php esc_html_e('QUANTITÉ:', 'woocommerce'); ?></strong>
										<?php
										if ($_product->is_sold_individually()) {
											$min_quantity = 1;
											$max_quantity = 1;
										} else {
											$min_quantity = 0;
											$max_quantity = $_product->get_max_purchase_quantity();
										}

										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name' => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value' => $max_quantity,
												'min_value' => $min_quantity,
												'product_name' => $product_name,
											),
											$_product,
											false
										);

										echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
										?>
									</div>

									<div class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
										<strong><?php esc_html_e('SOUS-TOTAL:', 'woocommerce'); ?></strong>
										<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
									</div>
								</td>
							</tr>
							<?php
						}
					}
					?>

					<?php do_action('woocommerce_cart_contents'); ?>

					<tr>
						<td colspan="3" class="actions">
							<div class="cart-actions">
								<?php if (wc_coupons_enabled()) { ?>
									<div class="coupon">
										<div class="coupon-input-group">
											<input type="text" name="coupon_code" class="input-text" id="coupon_code"
												value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
											<button type="submit"
												class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
												name="apply_coupon"
												value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
												<?php esc_html_e('ADD COUPONS', 'woocommerce'); ?>
											</button>
										</div>
										<div class="coupon-message" id="coupon-message"></div>
										<?php do_action('woocommerce_cart_coupon'); ?>
									</div>
								<?php } ?>

								<?php do_action('woocommerce_cart_actions'); ?>

								<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

								<!-- Champ caché pour permettre la mise à jour automatique -->
								<input type="hidden" name="update_cart" value="Update Cart">
							</div>
						</td>
					</tr>

					<?php do_action('woocommerce_after_cart_contents'); ?>
				</tbody>
			</table>
			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>
	</main>

	<aside class="cart-sidebar">
		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="cart-collaterals">
			<div class="custom-cart-summary">
				<h2><?php esc_html_e('Récapitulatif  de la commande', 'woocommerce'); ?></h2>

				<p class="summary-subtotal">
					<span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
					<span><?php
					// Recalculer le subtotal à chaque fois
					WC()->cart->calculate_totals();
					echo wp_kses_post(WC()->cart->get_cart_subtotal());
					?></span>
				</p>

				<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
					<?php do_action('woocommerce_cart_totals_before_shipping'); ?>
					<p class="summary-shipping">
						<span><?php esc_html_e('Shipping', 'woocommerce'); ?></span>
						<span>
							<?php
							WC()->cart->calculate_shipping();
							$packages = WC()->shipping()->get_packages();
							$shipping_total = 0;

							foreach ($packages as $i => $package) {
								$chosen_method = isset(WC()->session->chosen_shipping_methods[$i]) ? WC()->session->chosen_shipping_methods[$i] : '';

								if (!empty($package['rates'])) {
									foreach ($package['rates'] as $method) {
										if ($method->id === $chosen_method) {
											$shipping_total += $method->cost;
											echo wc_price($method->cost);
											break;
										}
									}
								}
							}

							if ($shipping_total == 0 && empty($chosen_method)) {
								esc_html_e('Calculated at checkout', 'woocommerce');
							}
							?>
						</span>
					</p>
					<?php do_action('woocommerce_cart_totals_after_shipping'); ?>
				<?php endif; ?>

				<?php foreach (WC()->cart->get_coupons() as $code => $coupon): ?>
					<p class="summary-coupon">
						<span><?php wc_cart_totals_coupon_label($coupon); ?></span>
						<span><?php wc_cart_totals_coupon_html($coupon); ?></span>
					</p>
				<?php endforeach; ?>

				<p class="summary-total">
					<strong><?php esc_html_e('Estimated total', 'woocommerce'); ?></strong>
					<strong><?php
					// Recalculer le total
					WC()->cart->calculate_totals();
					wc_cart_totals_order_total_html();
					?></strong>
				</p>

				<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="button checkout-button">
					<?php esc_html_e('Proceed to Checkout', 'woocommerce'); ?>
				</a>
			</div>
		</div>

		<?php do_action('woocommerce_after_cart_collaterals'); ?>
	</aside>
</div>

<?php
get_footer();
?>