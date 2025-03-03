<?php
$Banner_image = get_field('banner_image', 'option');
$Banner_image = is_array($Banner_image) ? $Banner_image : [];
$Banner_imageUrl = $Banner_image['url'];
$Banner_imageTitle = $Banner_image['title'];
$special_tag_text = get_field('special_tag_text', 'option');
$banner_title = get_field('banner_title', 'option');
$banner_sub_title = get_field('banner_sub_title', 'option');
$banner_button = get_field('banner_button', 'option');
$banner_button = is_array($banner_button) ? $banner_button : [];
$banner_buttonUrl = $banner_button['url'];
$banner_buttonTitle = $banner_button['title'];
$banner_buttonTarget = $banner_button['target'];
$banner_button_image = get_field('banner_button_image', 'option');
$banner_button_image = is_array($banner_button_image) ? $banner_button_image : [];
$banner_buttonImageUrl = $banner_button_image['url'];
$social_media_section_label = get_field('social_media_section_label', 'option');
$social_media_links = get_field('social_media_links', 'option');
$social_media_links = is_array($social_media_links) ? $social_media_links : [];
?>
<?php if ($banner_buttonImageUrl || $banner_title || $banner_sub_title || $social_media_links): ?>
    <section class="banner">
        <div class="container banner-con">
            <div class="main-banner">
                <div class="banner-img" style="background-image: url('<?php echo $Banner_imageUrl; ?>');">
                    <?php if ($special_tag_text): ?>
                        <div class="speacial-tag">
                            <i class="fa-solid fa-star"></i>
                            <h5><?php echo $special_tag_text; ?></h5><i class="fa-solid fa-star"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($banner_title || $banner_sub_title): ?>
                        <div class="enjoy-text">
                            <?php if ($banner_title): ?>
                                <h1><?php echo $banner_title; ?></h1><?php endif; ?>
                            <?php if ($banner_sub_title): ?>
                                <h2><?php echo $banner_sub_title; ?></h2><?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($banner_buttonUrl): ?>
                        <div class="request-btn">
                            <button><a href="<?php echo $banner_buttonUrl; ?>"
                                    target="<?php echo $banner_buttonTarget; ?>"><?php echo $banner_buttonTitle; ?></a></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($banner_buttonImageUrl): ?>
                        <img src="<?php echo $banner_buttonImageUrl; ?>" alt=""><?php endif; ?>
                </div>

                <div class="social-icons">
                    <div class="social-text">
                        <h4><?php echo $social_media_section_label; ?></h4>
                    </div>
                    <?php if ($social_media_links): ?>
                        <div class="social_icon">
                            <?php foreach ($social_media_links as $links): ?>
                                <?php
                                $className = $links['social_media_icon_class'];
                                $SocialUrl = $links['social_media_url']['url'];
                                ?>
                                <?php if ($className && $SocialUrl): ?>

                                    <a href="<?php echo $SocialUrl; ?>" target="_blank">
                                        <i class="fa-brands <?php echo $className; ?>"></i>
                                    </a>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="scroll-down">
                        <h4>Scroll down</h4><i class="fa-solid fa-arrow-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Mobile Banner  -->
    <section class="mobile-banner"
        style="background-image: url(https://webtech-evolution.com/fac/wp-content/uploads/2025/02/Vector-5-1.png)">
        <div class="container mobile-container">
            <div class="mobile-banner-img">
                <img src="<?php echo $Banner_imageUrl; ?>" alt="">
            </div>
            <div class="mobile-background">
                <div class="mobile-speacial-tag">
                    <i class="fa-solid fa-star"></i>
                    <h5><?php echo $special_tag_text; ?></h5><i class="fa-solid fa-star"></i>
                </div>
                <div class="mobile-enjoy-text">
                    <h1><?php echo $banner_title; ?></h1>
                    <h2><?php echo $banner_sub_title; ?></h2>
                </div>
                <div class="request-btn">
                    <button><a href="<?php echo $banner_buttonUrl; ?>"
                            target="<?php echo $banner_buttonTarget; ?>"><?php echo $banner_buttonTitle; ?></a></button>
                </div>
            </div>
        </div>
    </section><?php endif; ?>