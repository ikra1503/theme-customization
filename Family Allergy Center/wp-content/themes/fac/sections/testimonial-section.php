<?php
$testimonial_background_image = get_field('testimonial_background_image', 'option');
$testimonial_background_image = is_array($testimonial_background_image) ? $testimonial_background_image : [];
$testimonial_background_imageUrl = $testimonial_background_image['url'];
$testimonial_background_imageTitle = $testimonial_background_image['title'];

$testimonial_section_title = get_field('testimonial_section_title', 'option');

$testimonail_quote_icon = get_field('testimonail_quote_icon', 'option');
$testimonail_quote_icon = is_array($testimonail_quote_icon) ? $testimonail_quote_icon : [];
$testimonail_quote_iconUrl = $testimonail_quote_icon['url'];
$testimonail_quote_iconTitle = $testimonail_quote_icon['title'];

$testimonial_contnet = get_field('testimonial_contnet', 'option');
?>
<?php if ($testimonial_background_imageUrl && $testimonail_quote_iconUrl || $testimonial_section_title || $testimonial_contnet): ?>
    <div class="main-testimonial"
        style="background-image: url('<?php echo esc_url($testimonial_background_imageUrl); ?>');">
        <div class="container">
            <div class="testimonial-heading">
                <?php if ($testimonial_section_title): ?>
                    <h2><?php echo $testimonial_section_title; ?></h2><?php endif; ?>
                <?php if ($testimonail_quote_iconUrl): ?>
                    <div class="quate-icon">
                        <img src="<?php echo $testimonail_quote_iconUrl; ?>" alt="<?php echo $testimonail_quote_iconTitle; ?>">
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($testimonial_contnet): ?>
                <div class="testimonial-container">
                    <?php
                    $count = 0; // To track the index for dots and active class
                    foreach ($testimonial_contnet as $testimonial):
                        $testimonial_comment = $testimonial['testimonial_comment'];
                        $evalutor_name = $testimonial['evalutor_name'];
                        ?>
                        <div class="testimonial <?php echo $count === 0 ? 'active' : ''; ?>">
                            <p><?php echo esc_html($testimonial_comment); ?></p>
                            <p class="author"><?php echo esc_html($evalutor_name); ?></p>
                        </div>
                        <?php
                        $count++;
                    endforeach;
                    ?>

                    <!-- Dots for Navigation -->
                    <div class="dots">
                        <?php for ($i = 0; $i < $count; $i++): ?>
                            <span class="dot <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></span>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>