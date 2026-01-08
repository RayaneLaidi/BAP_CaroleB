<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;

get_header();
?>

<style>
    /* ==========================================================================
   PAGE THANK YOU - STYLES
   ========================================================================== */
    .thankyou-page {
        background: #fff;
        min-height: 100vh;
        padding: 40px 0 60px;
    }

    .thankyou-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Image de remerciement */
    .thankyou-image {
        width: 100%;
        max-width: 600px;
        height: auto;
        display: block;
        margin: 0 auto 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Message principal */
    .woocommerce-order {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* En-tête du message */
    .woocommerce-thankyou-order-received {
        background: #E0435B;
        color: white;
        padding: 30px;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    /* Détails de la commande */
    .woocommerce-order-overview {
        list-style: none;
        padding: 30px;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        background: #f9f9f9;
        border-top: 3px solid #E0435B;
    }

    .woocommerce-order-overview li {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
    }

    .woocommerce-order-overview li:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(224, 67, 91, 0.15);
    }

    .woocommerce-order-overview li::before {
        content: '';
        display: block;
        width: 40px;
        height: 3px;
        background: #E0435B;
        margin: 0 auto 15px;
        border-radius: 2px;
    }

    .woocommerce-order-overview li {
        font-size: 14px;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .woocommerce-order-overview strong {
        display: block;
        margin-top: 10px;
        font-size: 18px;
        color: #2c3e50;
        font-weight: 700;
    }

    /* Messages d'erreur */
    .woocommerce-thankyou-order-failed {
        background: #fee;
        border-left: 4px solid #e74c3c;
        color: #c00;
        padding: 20px;
        margin: 20px;
        border-radius: 8px;
        font-weight: 600;
    }

    .woocommerce-thankyou-order-failed-actions {
        background: #fff;
        border-left: 4px solid #f39c12;
        padding: 20px;
        margin: 20px;
        border-radius: 8px;
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
    }

    .woocommerce-thankyou-order-failed-actions .button {
        background: #E0435B;
        color: #fff;
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .woocommerce-thankyou-order-failed-actions .button:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(224, 67, 91, 0.3);
    }

    /* Section détails de commande */
    .woocommerce-order-details {
        padding: 30px;
        background: #fff;
    }

    .woocommerce-order-details__title {
        font-size: 22px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #E0435B;
    }

    /* Tableau des produits */
    .woocommerce-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .woocommerce-table thead {
        background: #f9f9f9;
    }

    .woocommerce-table th {
        padding: 15px;
        text-align: left;
        font-weight: 700;
        color: #2c3e50;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #E0435B;
    }

    .woocommerce-table td {
        padding: 15px;
        border-bottom: 1px solid #e1e1e1;
    }

    .woocommerce-table tfoot th,
    .woocommerce-table tfoot td {
        font-weight: 700;
        font-size: 16px;
        color: #2c3e50;
        padding: 20px 15px;
        border-top: 2px solid #2c3e50;
        border-bottom: none;
    }

    /* Adresses */
    .woocommerce-customer-details {
        padding: 30px;
        background: #f9f9f9;
        margin-top: 30px;
        border-radius: 8px;
    }

    .woocommerce-customer-details h2 {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .woocommerce-column {
        margin-bottom: 20px;
        max-width: 100%;
    }

    .woocommerce-column h2 {
        font-size: 16px;
        font-weight: 700;
        color: #E0435B;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .woocommerce-column address {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        font-style: normal;
        line-height: 1.8;
        color: #666;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Bouton retour boutique */
    .woocommerce-order-details+p {
        text-align: center;
        margin-top: 40px;
        padding: 30px;
    }

    .woocommerce-order-details+p .button {
        background: #fff;
        color: #E0435B;
        border: 2px solid #E0435B;
        padding: 15px 40px;
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
        letter-spacing: 1px;
        display: inline-block;
    }

    .woocommerce-order-details+p .button:hover {
        background: #E0435B;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(224, 67, 91, 0.3);
    }

    /* Animation d'entrée */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .woocommerce-order {
        animation: fadeInUp 0.6s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .thankyou-container {
            padding: 0 15px;
        }

        .thankyou-image {
            margin-bottom: 30px;
        }

        .woocommerce-thankyou-order-received {
            font-size: 20px;
            padding: 25px 20px;
        }

        .woocommerce-order-overview {
            grid-template-columns: 1fr;
            padding: 20px;
        }

        .woocommerce-order-overview strong {
            font-size: 16px;
        }

        .woocommerce-table {
            font-size: 14px;
        }

        .woocommerce-table th,
        .woocommerce-table td {
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .woocommerce-thankyou-order-received {
            font-size: 18px;
            padding: 20px 15px;
        }

        .woocommerce-order-overview li {
            padding: 15px;
        }

        .woocommerce-table {
            font-size: 13px;
        }

        .woocommerce-order-details+p .button {
            padding: 12px 30px;
            font-size: 14px;
        }
    }

    /* Masquer l'adresse de facturation */
    .woocommerce-column--billing-address {
        display: none !important;
    }

    /* Adresses - Seulement livraison visible */
    .woocommerce-customer-details {
        padding: 30px;
        background: #f9f9f9;
        margin-top: 30px;
        border-radius: 8px;
    }

    .woocommerce-customer-details h2 {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .woocommerce-column {
        margin-bottom: 20px;
        max-width: 100%;
    }

    .woocommerce-column h2 {
        font-size: 16px;
        font-weight: 700;
        color: #E0435B;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .woocommerce-column address {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        font-style: normal;
        line-height: 1.8;
        color: #666;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Animation d'entrée */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="thankyou-page">
    <div class="thankyou-container">

        <img src="<?php echo get_template_directory_uri(); ?>/asset/pochoir.jpg" alt="Merci pour votre commande"
            class="thankyou-image" />

        <div class="woocommerce-order">

            <?php
            if ($order):

                do_action('woocommerce_before_thankyou', $order->get_id());
                ?>

                <?php if ($order->has_status('failed')): ?>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                        <?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
                    </p>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                        <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                            class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                                class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                        <?php endif; ?>
                    </p>

                <?php else: ?>

                    <?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

                    <!-- SUPPRIMÉ: Section woocommerce-order-overview -->

                <?php endif; ?>

                <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
                <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

            <?php else: ?>

                <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

            <?php endif; ?>

        </div>

    </div>
</div>

<?php
get_footer();
?>