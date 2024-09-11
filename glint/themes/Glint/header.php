<?php
$HeaderLogo = get_field('header_logo', 'option');
$HeaderLogo = is_array($HeaderLogo) ? $HeaderLogo : [];
$HeaderLogoUrl = $HeaderLogo['url'];
$HeaderLogoTitle = $HeaderLogo['title'];
$HeaderLabel = get_field('header_label', 'option');
$headerDescription = get_field('header_after_menu_description', 'option');
$HeaderIcons = get_field('header_social_icons', 'option');
?>

<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php echo get_bloginfo('name'); ?>
    </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="s-header">
        <?php if ($HeaderLogoUrl): ?>
            <div class="header-logo">
                <a class="site-logo" href="<?php echo site_url(); ?>">
                    <img src="<?php echo $HeaderLogoUrl; ?>" alt="<?php echo $HeaderLogoTitle; ?>">
                </a>
            </div>
        <?php endif; ?>
        <nav class="header-nav">
            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>
            <div class="header-nav__content">
                <h3>
                    <?php echo $HeaderLabel; ?>
                </h3>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'header-nav__list',
                        'walker' => new Glint_Custom_Nav_Walker()
                    )
                );
                ?>
                <?php if ($headerDescription): ?>
                    <p>
                        <?php echo $headerDescription; ?>
                    </p>
                <?php endif; ?>
                <?php if ($HeaderIcons): ?>
                    <ul class="header-nav__social">
                        <?php foreach ($HeaderIcons as $icon): ?>
                            <li>
                                <a href="<?php echo $icon['social_links']['url']; ?>"
                                    target="<?php echo $icon['social_links']['target']; ?>">
                                    <i class="<?php echo $icon['social_icon_class_names']; ?>"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
        <?php
        // Define custom walker class
        class Glint_Custom_Nav_Walker extends Walker_Nav_Menu
        {
            // Start Level
            function start_lvl(&$output, $depth = 0, $args = null)
            {
                $indent = str_repeat("\t", $depth);
                $output .= "\n$indent<ul class=\"header-nav__list\">\n";
            }

            // Start Element
            function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
            {
                $indent = ($depth) ? str_repeat("\t", $depth) : '';
                $class_names = $value = '';
                $classes = empty($item->classes) ? array() : (array) $item->classes;
                $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
                $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
                $output .= $indent . '<li' . $value . $class_names . '>';
                $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
                $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
                $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
                $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
                $item_output = $args->before;
                $item_output .= '<a' . $attributes . ' class="smoothscroll">';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }
        }
        ?>
        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-text">Menu</span>
            <span class="header-menu-icon"></span>
        </a>
    </header>