<?php
$banner_tagline = get_field('banner_tagline');
$banner_heading = get_field('banner_heading');
$banner_tag = get_field('banner_tag');
$banner_background_image = get_field('banner_background_image');
$banner_background_image = is_array($banner_background_image) ? $banner_background_image : [];
$banner_background_imageUrl = isset($banner_background_image['url']) ? $banner_background_image['url'] : '';


$banner_button = get_field('banner_button');
$banner_button = is_array($banner_button) ? $banner_button : [];
$banner_buttonUrl = $banner_button['url'];
$banner_buttonTitle = $banner_button['title'];
$banner_buttonTarget = $banner_button['target'];

$social_link = get_field('social_link');
$social_link = is_array($social_link) ? $social_link : [];
$social_linkUrl = $social_link['url'];
$social_linkTitle = $social_link['title'];
$social_linktarget = $social_link['target'];

$glitch_class_one = get_field('glitch_class_one');
$glitch_class_two = get_field('glitch_class_two');
$glitch_class_three = get_field('glitch_class_three');
$social_class_heading = get_field('social_class_heading');

//About section ACF
$about_image_logo = get_field('about_image_logo');
$about_image_logo = is_array($about_image_logo) ? $about_image_logo : [];
$about_image_logoUrl = $about_image_logo['url'];

$about_image = get_field('about_image');
$about_image = is_array($about_image) ? $about_image : [];
$about_imageUrl = isset($about_image['url']) ? $about_image['url'] : '';

$about_filteration_image = get_field('about_filteration_image');
$about_filteration_image = is_array($about_filteration_image) ? $about_filteration_image : [];
$about_filteration_imageUrl = isset($about_filteration_image['url']) ? $about_filteration_image['url'] : '';

$about_us_section_title = get_field('about_us_section_title');
$about_us_section_content_1 = get_field('about_us_section_content_1');
$about_us_section_content_2 = get_field('about_us_section_content_2');
$about_us_location_heading = get_field('about_us_location_heading');
$about_us_location_content = get_field('about_us_location_content');

$about_map = get_field('about_map');
$about_map = is_array($about_map) ? $about_map : [];

$about_joinus_content = get_field('about_joinus_content');
$about_joinus_content = is_array($about_joinus_content) ? $about_joinus_content : [];
$about_joinus_contentDescription = $about_joinus_content['joinus_description'];

$about_joinus_contenJoinusLink = $about_joinus_content['joinus_link'];
$about_joinus_contenJoinusLink = is_array($about_joinus_contenJoinusLink) ? $about_joinus_contenJoinusLink : [];
$about_joinus_contenJoinusLinkUrl = $about_joinus_contenJoinusLink['url'];
$about_joinus_contenJoinusLinkTarget = $about_joinus_contenJoinusLink['target'];
$about_joinus_contenJoinusLinkTitle = $about_joinus_contenJoinusLink['title'];

//conatact section acf
$contact_heading = get_field('contact_heading');
$contact_tagline = get_field('contact_tagline');
$inquiry_heading = get_field('inquiry_heading');
$inquiry_mail = get_field('inquiry_mail');
$contact_form_heading = get_field('contact_form_heading');
$contact_icons_section = get_field('contact_icons_section');
$contact_shortcode = get_field('conatct_form_shortcode');
$contact_social_link = get_field('contact_social_link');
$contact_social_link = is_array($contact_social_link) ? $contact_social_link : [];
$contact_social_linkUrl = $contact_social_link['url'];
$contact_social_linkTarget = $contact_social_link['target'];
$contact_social_linkTitle = $$contact_social_linkTarget['title'];
$contact_social_logo = get_field('contact_social_logo');
$contact_social_logo = is_array($contact_social_logo) ? $contact_social_logo : [];
$contact_social_logoUrl = $contact_social_logo['url'];
$contact_taglines = get_field('contact_taglines');
$contact_taglines = is_array($contact_taglines) ? $contact_taglines : [];

//partner section
$partners_section_heading = get_field('partners_section_heading');
$partners_logo = get_field('partners_logo');
$partners_mail_heading = get_field('partners_mail_heading');
$partenrs_mail = get_field('partenrs_mail');
$partner_posts = get_field('partner_posts');
$partnerImage = get_field('partner_background_image');
$partnerImage = is_array($partnerImage) ? $partnerImage : [];
$partnerImageUrl = isset($partnerImage['url']) ? $partnerImage['url'] : '';



?>
<?php if ($banner_tagline || $banner_heading || $banner_button || $social_link || $glitch_class_one || $glitch_class_two || $glitch_class_three || $social_class_heading): ?>
    <div class="main-sec section-row bg--type-dark" id="home-section"
        style="background-image: url('<?php echo $banner_background_imageUrl; ?>');">
        <div class="container">
            <div class="main-row">
                <?php if ($banner_heading || $banner_heading): ?>
                    <div id="heading-lead-block_c860ee5697272745e0bd343227f165bc" class="ncr-heading-lead">
                        <h1 class="landing-title h-lead-1">
                            <?php if ($banner_tagline): ?> <span
                                    class="subtitle landing-subtitle subtitle--primary"><?php echo $banner_tagline; ?></span><?php endif; ?>
                            <?php echo $banner_heading; ?>
                        </h1>
                        <h3><?php echo $banner_tag; ?></h3>
                    </div>
                <?php endif; ?>
                <?php //if ($banner_buttonUrl || $banner_buttonTarget || $banner_buttonTitle): ?>
                <!-- <div id="button-block_c90c78099148da23f4b9bca7c96abbbb" class="ncr-button"> -->
                <!-- <a href="<?php //echo $banner_buttonUrl; ?>" class="btn btn-lg btn-primary btn--landing" -->
                <!-- target="<?php //echo $banner_buttonTarget; ?>"> -->
                <!-- <span><?php //echo $banner_buttonTitle; ?></span> -->
                <!-- </a> -->
                <!-- </div> -->
                <?php //endif; ?>
                <?php if ($social_linkUrl || $social_linktarget): ?>
                    <ul class="social-menu social-menu--landing social-menu--landing-glitch">
                        <li>
                            <a href="<?php echo $social_linkUrl; ?>" target="<?php echo $social_linktarget; ?>"
                                class="social-menu__link">
                                <i class="<?php echo $glitch_class_one; ?>"></i>
                                <i class="<?php echo $glitch_class_two; ?>"></i>
                                <i class="<?php echo $glitch_class_three; ?>"></i>
                                <span class="link-subtitle"><?php echo $social_linkTitle ?></span>
                                <?php echo $social_class_heading; ?> </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<!-- About Us Section -->
<?php
if ($about_image_logo || $about_image || $about_us_section_title || $about_us_section_content_1 || $about_us_section_content_2 || $about_us_location_heading || $about_us_location_content): ?>
    <div class="about-us-main-sec section-row" id="about-section">
        <div class="about-us-row">
            <?php if ($about_image_logoUrl || $about_filteration_imageUrl): ?>
                <div class="about-us-image">
                    <figure class="page-thumbnail page-thumbnail--default effect-duotone effect-duotone--base"
                        style="background-image: url('<?php echo $about_imageUrl; ?>');">
                        <img src="<?php echo $about_image_logoUrl; ?>" class="page-bg-logo" alt="htmlwebs_dev">
                        <div class="effect-duotone__layer">
                            <div class="effect-duotone__layer-inner"></div>
                        </div>
                    </figure>
                    <?php if ($about_filteration_imageUrl): ?>
                        <figure class="filteration-image">
                            <img src="<?php echo $about_filteration_imageUrl; ?>" alt="filteration">
                        </figure>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
            <?php if ($about_us_section_title || $about_us_section_content_1 || $about_us_section_content_2 || $about_us_location_heading || $about_us_location_content): ?>
                <div class="page-content">
                    <?php if ($about_us_section_title): ?>
                        <h1 class="page-title"><?php echo $about_us_section_title; ?></h1><?php endif; ?>
                    <?php if ($about_us_section_content_1): ?>
                        <p><?php echo $about_us_section_content_1; ?></p><?php endif; ?>
                    <?php if ($about_us_section_content_2):
                        echo $about_us_section_content_2; ?>         <?php endif; ?>
                    <?php if ($about_map): ?>
                        <div class="world-map">
                            <?php foreach ($about_map as $pin): ?>
                                <?php
                                $pin_image = isset($pin['pin_image']['url']) ? $pin['pin_image']['url'] : '';
                                $alt = isset($pin['pin_image']['title']) ? $pin['pin_image']['title'] : '';

                                $map_team_name = $pin['map_team_name'];
                                $map_team_country = $pin['map_team_country'];
                                $x_cordinate_of_map = $pin['x_cordinate_of_map'];
                                $y_coordinate_of_map = $pin['y_coordinate_of_map'];
                                ?>
                                <?php if ($pin_image || $alt || $map_team_country || $map_team_name || $x_cordinate_of_map || $y_coordinate_of_map): ?>
                                    <div class="world-map-team world-map-team--left"
                                        style="left: <?php echo $x_cordinate_of_map; ?>%; bottom: <?php echo $y_coordinate_of_map; ?>%;">
                                        <div class="world-map-team__wrapper">
                                            <?php if ($pin_image): ?>
                                                <figure class="world-map-team__logo" role="group">
                                                    <img decoding="async" src="<?php echo $pin_image; ?>" alt="<?php echo $alt; ?>">
                                                </figure>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($map_team_name || $map_team_country): ?>
                                            <figcaption>
                                                <?php if ($map_team_name): ?>
                                                    <div class="world-map-team__name"><?php echo $map_team_name; ?></div><?php endif; ?>
                                                <?php if ($map_team_country): ?>
                                                    <div class="world-map-team__country"><?php echo $map_team_country; ?></div><?php endif; ?>
                                            </figcaption>
                                        <?php endif; ?>
                                    </div>
                                    <div class="world-map-team__anchor"></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($about_us_location_heading): ?>
                    <h2 class="wp-block-heading"><strong><?php echo $about_us_location_heading; ?></strong></h2><?php endif; ?>
                <?php if ($about_us_location_content): ?>
                    <div class="location-address-dt">
                        <?php echo $about_us_location_content; ?>
                        <?php if ($about_joinus_contentDescription || $$about_joinus_contenJoinusLinkUrl): ?>
                            <div class="join-us">
                                <?php if ($about_joinus_contentDescription): ?>
                                    <h4><?php echo $about_joinus_contentDescription; ?></h4><?php endif; ?>
                                <?php if ($about_joinus_contenJoinusLinkUrl || $about_joinus_contenJoinusLinkTitle): ?>
                                    <div class="join-us-btn">
                                    <a href="<?php echo $about_joinus_contenJoinusLinkUrl; ?>"
                                        target="<?php echo $about_joinus_contenJoinusLinkTarget; ?>"><?php echo $about_joinus_contenJoinusLinkTitle; ?></a></div><?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    </div>
<?php endif; ?>

<!-- About Us Section -->

<!-- Contact Page -->

<?php if ($contact_heading || $contact_tagline || $inquiry_heading || $inquiry_mail || $contact_form_heading): ?>

    <div class="contact-us-main-sec section-row" id="contact-section">
        <div class="contact-us-row">
            <div class="page-content">
                <h1 class="page-title"><?php echo $contact_heading; ?></h1>
                <p> <?php echo $contact_tagline; ?></p>
                <?php if ($inquiry_heading || $inquiry_mail): ?>
                    <div class="info-box info-box--content" id="ncr-dl-block_115f4cde79231a4e4561b4f02579d940">

                        <?php if ($inquiry_heading): ?>
                            <div class="info-box__label"><?php echo $inquiry_heading; ?></div><?php endif; ?>
                        <?php if ($inquiry_mail): ?>
                            <div class="info-box__content js-info-box__content">
                                <a href="mailto:<?php echo $inquiry_mail; ?>"><?php echo $inquiry_mail; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
                <?php if ($contact_social_linkUrl || $contact_social_logoUrl): ?>
                    <ul class="wp-block-social-links is-layout-flex wp-block-social-links-is-layout-flex">
                        <li class="wp-social-link wp-social-link-facebook  wp-block-social-link">
                            <a href="<?php echo $contact_social_linkUrl; ?>" class="wp-block-social-link-anchor"
                                target="<?php echo $contact_social_linkTarget; ?>">
                                <img src="<?php echo $contact_social_logoUrl; ?>" alt="Facebook">
                                <?php if ($contact_social_linkTitle): ?> <span
                                        class="wp-block-social-link-label screen-reader-text"><?php echo $contact_social_linkTitle; ?></span><?php endif; ?>
                            </a>
                        </li>
                    </ul>

                <?php endif; ?>
                <?php if ($contact_icons_section): ?>
                    <div class="radio-tile-group contact-services-row">
                        <?php foreach ($contact_icons_section as $index => $contact_icon): ?>
                            <?php
                            $icon = $contact_icon['contact_icon']['url'];
                            $alt = $contact_icon['contact_icon']['title'];
                            $contact_icon_text = $contact_icon['contact_icon_text'];
                            $checkbox_id = 'checkbox' . ($index + 1); // Adjust index
                            $checkbox_value = $contact_icon_text; // Assigning contact icon text as value
                            ?>
                            <?php if ($icon || $alt || $contact_icon_text): ?>
                                <div class="input-container contact-services">
                                    <input id="<?php echo $checkbox_id; ?>" class="checkbox-button" type="checkbox"
                                        name="<?php echo $checkbox_id; ?>" value="<?php echo $checkbox_value; ?>">
                                    <div class="radio-tile">
                                        <div class="icon">
                                            <?php if ($icon): ?>
                                                <figure>
                                                    <img src="<?php echo $icon; ?>" alt="<?php echo $alt; ?>">
                                                </figure>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($contact_icon_text): ?>
                                            <label for="<?php echo $checkbox_id; ?>"
                                                class="radio-tile-label"><?php echo $contact_icon_text; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>



                <?php if ($contact_form_heading): ?>
                    <h2 class="wp-block-heading"><?php echo $contact_form_heading; ?></h2><?php endif; ?>
                <?php if ($contact_shortcode): ?>
                    <?php echo do_shortcode($contact_shortcode); ?>
                    <?php if ($contact_taglines): ?>
                        <div class="contact-dt">
                            <ul>
                                <?php foreach ($contact_taglines as $tagline): ?>
                                    <?php $tagPoint = $tagline['contact_single_tagline']; ?>
                                    <?php if ($tagPoint): ?>
                                        <li><?php echo $tagPoint; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


            </div><!-- .page-content -->

            <!-- Google Map -->
            <?php
            $gmap_address = get_field('latitude_of_map') . ',' . get_field('longitude_of_map');
            // $gmap_style = get_theme_mod('necromancers_gmap_style', 'necromancers');
            $gmap_zoom = get_theme_mod('necromancers_gmap_zoom', 15);
            $gmap_marker = get_field('map_marker');
            $gmap_marker = is_array($gmap_marker) ? $gmap_marker : [];
            $gmap_markerUrl = $gmap_marker['url'];
            $gmap_info_title = get_theme_mod('necromancers_gmap_info_title', 'Necromancers');
            $gmap_info_subtitle = get_theme_mod('necromancers_gmap_info_subtitle', 'Headquarters');
            $gmap_info_desc = get_theme_mod('necromancers_gmap_info_description', '1284 W 52nd Street Suite 8, New York');
            ?>
            <div class="gm-map gm-map--aside" data-map-center="<?php echo esc_attr($gmap_address); ?>"
                data-map-icon="<?php echo esc_url($gmap_markerUrl); ?>" data-map-zoom="<?php echo esc_attr($gmap_zoom); ?>">
                <div class="gm-map__info">
                    <h3><?php echo esc_html($gmap_info_title); ?></h3>
                    <p><span class="color-primary"><?php echo esc_html($gmap_info_subtitle); ?></span></p>
                    <p><?php echo esc_html($gmap_info_desc); ?></p>
                </div>
            </div>

            <!-- Google Map / End -->
        </div>
    </div>
<?php endif; ?>
<!-- Contact Page -->

<!-- Partner Section -->
<?php
if ($partners_section_heading || $partners_logo || $partners_mail_heading || $partenrs_mail || $partner_posts): ?>
    <div class="partners-main-sec section-row post-type-archive-partners" id="partner-section">
        <div class="partners-row">
            <div class="page-heading page-heading--loop effect-duotone effect-duotone--base page-heading--partners"
                style="background-image: url('<?php echo $partnerImageUrl; ?>');">
                <div class="page-heading__subtitle h5 color-primary"><?php echo $partners_logo; ?></div>
                <h1 class="page-heading__title h-lead-2"><?php echo $partners_section_heading; ?></h1>

                <div class="page-heading__body">
                    <div class="h6 color-primary"><?php echo $partners_mail_heading; ?></div>
                    <div class="h4"><a href="mailto:<?php echo $partenrs_mail; ?>"><?php echo $partenrs_mail; ?></a></div>
                </div>
            </div>


            <!-- <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-1"></div> -->
            <!-- <div class="page-heading-effect page-heading-effect--pattern page-heading-effect--pattern-2"></div> -->
            <div class="content partners-layout">
                <?php foreach ($partner_posts as $partner): ?>
                    <?php
                    $partner_title = get_the_title($partner->ID);
                    $partner_url = get_field('ncr_partner_url', $partner->ID); // Retrieving Partner URL field
                    $partner_image = get_the_post_thumbnail_url($partner->ID, 'thumbnail');
                    $partner_excerpt = get_the_excerpt($partner->ID);
                    $social_links = get_field('ncr_partner_social_links', $partner->ID); // Retrieving Social Links repeater field
                    $what_to_show = get_field('what_to_show', $partner->ID); // Ensure to pass the post ID
            
                    if ($what_to_show == 'Image') {
                        $partner_logo_image = get_field('partner_logo_image',  $partner->ID);
                        $partner_logo_imageUrl = $partner_logo_image['url'];
                        $partner_logo_imageTitle = $partner_logo_image['title'];
                    } else {
                        $partner_title_text = get_field('partner_title_text',  $partner->ID);
                    }
                    ?>
                    <article class="partner">
                        <?php if (!empty($partner_image)): ?>
                            <div class="partner__logo">
                                <img src="<?php echo esc_url($partner_image); ?>" alt="<?php echo esc_attr($partner_title); ?>"
                                    width="40" height="42">
                            </div>
                        <?php endif; ?>
                        <?php if ($partner_title || $partner_url): ?>
                            <div class="partner__header">
                                <?php if ($what_to_show == 'Title'): ?>

                                    <h2 class="partner__title h4"><?php echo $partner_title_text; ?></h2>
                                <?php else: ?>
                                    <img src="<?php echo $partner_logo_imageUrl; ?>" alt="<?php echo $partner_logo_imageTitle; ?>">
                                <?php endif; ?>
                                <?php if ($partner_url): ?> <a href="<?php echo esc_url($partner_url); ?>" class="partner__info"
                                        target="_blank"><?php echo esc_html($partner_url); ?></a><?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($partner_excerpt): ?>
                            <p class="partner__excerpt"><?php echo esc_html($partner_excerpt); ?></p><?php endif; ?>
                        <ul class="social-menu social-menu--links">
                            <?php if ($social_links): ?>
                                <?php foreach ($social_links as $social_link): ?>
                                    <li><a href="<?php echo esc_url($social_link['ncr_partner_social_link_url']); ?>"
                                            target="_blank"></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>


        </div>
    </div>
<?php endif; ?>

<!-- Partner Section -->