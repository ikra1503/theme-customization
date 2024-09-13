<?php
/*
Plugin Name: Theme Generator
Description: Generate standalone themes with custom options.
Version: 1.0
Author: Your Name
*/

// Add menu option in admin bar under "Settings"
add_action('admin_menu', 'tg_add_menu_option');

function tg_add_menu_option()
{
    add_submenu_page(
        'options-general.php', // Parent menu slug
        'Theme Generator', // Page title
        'Theme Generator', // Menu title
        'manage_options', // Capability required
        'theme-generator', // Menu slug
        'tg_settings_page' // Callback function
    );
}

// Display settings page content
function tg_settings_page()
{
    ?>
    <div class="wrap">
        <h2>Theme Generator</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="updated">
                <p>Theme successfully generated!</p>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Theme Name</th>
                    <td><input type="text" name="theme_name" value="" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Author Name</th>
                    <td><input type="text" name="author_name" value="" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Version</th>
                    <td><input type="text" name="version" value="" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Text Domain</th>
                    <td><input type="text" name="text_domain" value="" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Screenshot</th>
                    <td><input type="file" name="screenshot" accept=".png" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Development Type</th>
                    <td>
                        <label><input type="radio" name="development_type" value="acf_based" /> ACF Based</label>
                        <label><input type="radio" name="development_type" value="block_based" /> Block Based</label>
                    </td>
                </tr>
            </table>
            <?php submit_button('Generate Theme'); ?>
        </form>
    </div>
    <?php
}

// Handle form submission
function tg_handle_form_submission()
{
    if (isset($_POST['theme_name'])) {
        $theme_name = $_POST['theme_name'];
        $author_name = $_POST['author_name'];
        $version = $_POST['version'];
        $text_domain = $_POST['text_domain'];


        // Create style.css content
        $style_css_content = "/*
        Theme Name: $theme_name
        Author: $author_name
        Version: $version
        Text Domain: $text_domain
       
        */";

        // Create the new theme directory
        $new_theme_directory = WP_CONTENT_DIR . '/themes/' . $theme_name;
        if (!file_exists($new_theme_directory)) {
            mkdir($new_theme_directory, 0755, true);
        }

        // Create style.css file in the new theme directory
        $style_css_file = fopen($new_theme_directory . '/style.css', 'w');
        fwrite($style_css_file, $style_css_content);
        fclose($style_css_file);

        // Create other essential theme files
        $theme_files = array(
            'index.php' => '<?php get_header(); ?>\n\n<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>\n\t<?php get_template_part( \'content\', get_post_format() ); ?>\n<?php endwhile; else : ?>\n\t<?php get_template_part( \'content\', \'none\' ); ?>\n<?php endif; ?>\n\n<?php get_footer(); ?>',
            'header.php' => '<!DOCTYPE html>\n<html <?php language_attributes(); ?> >\n<head>\n\t<meta charset="<?php bloginfo( \'charset\' ); ?>" />\n\t<meta name="viewport" content="width=device-width, initial-scale=1" />\n\t<?php wp_head(); ?>\n</head>\n<body <?php body_class(); ?> >\n\t<?php wp_body_open(); ?>',
            'footer.php' => '<?php wp_footer(); ?>\n</body>\n</html>',
            'functions.php' => '<?php // functions.php placeholder ?>',
            'single.php' => '<?php get_header(); ?>\n\n<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>\n\t<?php get_template_part( \'content\', get_post_format() ); ?>\n<?php endwhile; else : ?>\n\t<?php get_template_part( \'content\', \'none\' ); ?>\n<?php endif; ?>\n\n<?php get_footer(); ?>',
            'page.php' => '<?php get_header(); ?>\n\n<?php while ( have_posts() ) : the_post(); ?>\n\t<?php get_template_part( \'content\', \'page\' ); ?>\n<?php endwhile; ?>\n\n<?php get_footer(); ?>'
        );

        foreach ($theme_files as $file_name => $file_content) {
            $file_path = $new_theme_directory . '/' . $file_name;
            if (!file_exists($file_path)) {
                if (file_put_contents($file_path, $file_content) !== false) {
                    // echo 'File created successfully: ' . $file_name . '<br>';
                } else {
                    echo 'Error creating file: ' . $file_name . '<br>';
                }
            } else {
                echo 'File already exists: ' . $file_name . '<br>';
            }
        }
        // Handle file upload
        if (!empty($_FILES['screenshot']['name'])) {
            $uploaded_file = $new_theme_directory . '/' . basename($_FILES['screenshot']['name']);
            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploaded_file)) {
                //   echo "Screenshot uploaded successfully.";
            } else {
                echo "Failed to upload screenshot.";
            }
        }
        if ($_POST['development_type'] == 'acf_based') {
            $page_template_directory = $new_theme_directory . '/page-template';
            $page_content_directory = $new_theme_directory . '/page-content/sections';

            if (!file_exists($page_template_directory)) {
                mkdir($page_template_directory, 0755, true);
            }

            if (!file_exists($page_content_directory)) {
                mkdir($page_content_directory, 0755, true);
            }

            // Create a sample page template file
            $page_template_content = "<h1><?php the_title(); ?></h1><div class='content'><?php the_content(); ?></div>";
            file_put_contents($page_template_directory . '/page-template.php', $page_template_content);
            wp_redirect(admin_url('options-general.php?page=child-theme-generator&success=true'));

        } elseif ($_POST['development_type'] == 'block_based') {
            $new_theme_directory = WP_CONTENT_DIR . '/themes/' . $theme_name;

            // Download and install WooCommerce plugin
            include_once (ABSPATH . 'wp-admin/includes/plugin-install.php');
            include_once (ABSPATH . 'wp-admin/includes/file.php');
            include_once (ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

            $plugin_slug = 'woocommerce';
            $api = plugins_api('plugin_information', array('slug' => $plugin_slug));

            if (is_wp_error($api)) {
                wp_die('Error getting plugin information');
            }

            $upgrader = new Plugin_Upgrader(new WP_Upgrader_Skin());
            $install = $upgrader->install($api->download_link);

            if (is_wp_error($install)) {
                wp_die('Error installing plugin');
            }

            // Create woocommerce directory
            $woocommerce_directory = $new_theme_directory . '/woocommerce';
            if (!file_exists($woocommerce_directory)) {
                mkdir($woocommerce_directory, 0755, true);
            }

            // Copy WooCommerce plugin files to the woocommerce directory
            $woocommerce_plugin_dir = WP_PLUGIN_DIR . '/woocommerce';
            if (is_dir($woocommerce_plugin_dir)) {
                // Get list of files in WooCommerce plugin directory
                $files = glob($woocommerce_plugin_dir . '/*');

                foreach ($files as $file) {
                    // Get the base name of the file
                    $base_name = basename($file);

                    // Copy the file to the woocommerce directory in the new theme folder
                    copy($file, $woocommerce_directory . '/' . $base_name);
                }
            }

            wp_redirect(admin_url('options-general.php?page=theme-generator&success=true'));
            exit(); // Don't forget to exit after redirection
        }

    }
}
add_action('admin_init', 'tg_handle_form_submission');
?>