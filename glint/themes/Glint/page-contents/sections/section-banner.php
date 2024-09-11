<?php
$BannerTagline = get_field('banner_tagline');
$BannerMultilineTag = get_field('banner_multiline_tag');
$BannerBg = get_field('banner_background');
$BannerBg = is_array($BannerBg) ? $BannerBg : [];
$BannerBgUrl = $BannerBg['url'];
$BannerBgTitle = $BannerBg['title'];
$BannerButtons = get_field('banner_buttons');
$BannerButtons = is_array($BannerButtons) ? $BannerButtons : [];
?>
<?php if ($BannerTagline || $BannerMultilineTag || $BannerBg || $BannerButtons): ?>
   <section id="home" class="s-home target-section" data-parallax="scroll"
   data-image-src="images/hero-bg.jpg" data-natural-width="3000" data-natural-height="2000"
        data-position-y="center">

        <div class="overlay"></div>
        <div class="shadow-overlay"></div>
        <?php if ($BannerTagline || $BannerMultilineTag || $BannerButtons): ?>
            <div class="home-content">
                <?php if ($BannerMultilineTag || $BannerTagline): ?>
                    <div class="row home-content__main">
                        <?php if ($BannerTagline): ?>
                            <h3>
                                <?php echo $BannerTagline; ?>

                            </h3>
                        <?php endif; ?>
                        <?php if ($BannerMultilineTag): ?>
                            <?php echo $BannerMultilineTag; ?>
                        <?php endif; ?>
                        <?php if ($BannerButtons): ?>
                            <div class="home-content__buttons">
                                <?php foreach ($BannerButtons as $button): ?>
                                    <?php $ButtonUrl = $button['banner_single_button']['url']; ?>
                                    <?php $buttonText = $button['banner_single_button']['title']; ?>
                                    <a href="<?php echo $ButtonUrl; ?>" class="smoothscroll btn btn--stroke">
                                        <?php echo $buttonText; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
                <div class="home-content__scroll">
                    <a href="#about" class="scroll-link smoothscroll">
                        <span>Scroll Down</span>
                    </a>
                </div>

                <div class="home-content__line"></div>

            </div> <!-- end home-content -->
        <?php endif; ?>

        <ul class="home-social">
            <li>
                <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-behance" aria-hidden="true"></i><span>Behance</span></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-dribbble" aria-hidden="true"></i><span>Dribbble</span></a>
            </li>
        </ul>
        <!-- end home-social -->

    </section>
<?php endif; ?>