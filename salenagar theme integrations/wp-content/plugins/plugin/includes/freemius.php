<?php


if (!function_exists('lifeline_donation_fs')) {
    // Create a helper function for easy SDK access.
    function lifeline_donation_fs() {
        global $lifeline_donation_fs;

        if (!isset($lifeline_donation_fs)) {
            // Activate multisite network integration.
            if (!defined('WP_FS__PRODUCT_8834_MULTISITE')) {
                define('WP_FS__PRODUCT_8834_MULTISITE', true);
            }

            // Include Freemius SDK.
            require_once LIFELINE_DONATION_PATH . 'freemius/start.php';

            $lifeline_donation_fs = fs_dynamic_init(array(
                'id'                  => '8834',
                'slug'                => 'lifeline-donation',
                'type'                => 'plugin',
                'public_key'          => 'pk_9984fc4b3d9946abeef4af8094615',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'wp-commerce-settings',
                    'account'        => false,
                    'support'        => false,
                ),
            ));
        }

        return $lifeline_donation_fs;
    }

    // Init Freemius.
    lifeline_donation_fs();
    // Signal that SDK was initiated.
    do_action('lifeline_donation_fs_loaded');
}