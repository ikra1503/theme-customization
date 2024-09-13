<?php
/*
Template Name: Main Page
*/

get_header();
?>

<main class="site-content" id="wrapper">

    <!-- Section 1: Intro Page Content -->
    <section class="intro-section">
        <?php
        $side_decorations = get_field('ncr_page_side_decorations');
        $video_bg_type = get_field('ncr_page_background_type_img_video');

        /* Start the Loop */
        while (have_posts()) : the_post();

            the_content();

        endwhile; // End of the loop.

        // Video Background
        if ($video_bg_type === 'video') :
            $video_bg_webm = get_field('ncr_page_background_video_webm');
            $video_bg_mp4  = get_field('ncr_page_background_video_mp4');
            $video_poster  = get_field('ncr_page_poster');
            ?>
            <div class="video-full-bg">
                <!-- Video Highlight -->
                <div class="video-full-bg__highlight"></div>
                <!-- Video Highlight / End -->

                <!-- Video Clip -->
                <video poster="<?php echo esc_url($video_poster); ?>" class="video-full-bg__clip video-full-bg__clip--black-white" playsinline autoplay muted loop>
                    <source src="<?php echo esc_url($video_bg_webm); ?>" type="video/webm">
                    <source src="<?php echo esc_url($video_bg_mp4); ?>" type="video/mp4">
                </video>
                <!-- Video Clip / End -->

                <!-- Video Decoration -->
                <div class="video-full-bg__pattern"></div>
                <!-- Video Decoration / End -->

            </div>
        <?php
        endif;

        // Decorations
        if ($side_decorations || $side_decorations === null) :
            ?>
            <div class="landing-detail landing-detail--left">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
            <div class="landing-detail-cover landing-detail-cover--left">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
            <div class="landing-detail landing-detail--right">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
            <div class="landing-detail-cover landing-detail-cover--right">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
                <span>&nbsp;</span>
            </div>
        <?php
        endif;
        ?>
    </section>
    <section class="contact-us-section">
        <?php
        /* Start the Loop */
        while (have_posts()) : the_post();

            get_template_part('template-parts/content/content-page-side-map');
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </section>
    <section class="streams-archive-section">
        <?php
        /* Start the Loop */
        while (have_posts()) : the_post();

            get_template_part('template-parts/content/content-page-streams');

        endwhile; // End of the loop.
        ?>
    </section>
</main>

<?php
get_footer();
?>
