<?php wp_footer(); ?>
<?php
$FooterDescription = get_field('footer_description','option');
$FooterSubscriberBoxHeading = get_field('footer_subscriberbox_heading','option');
$FooterSubscriberBoxDescription = get_field('footer_subscriberbox_description','option');
$FooterMailchimp = get_field('shortcode_for_mailchimp','option');
?>
<?php if ($FooterDescription || $FooterSubscriberBoxHeading || $FooterSubscriberBoxDescription || $FooterMailchimp): ?>
    <footer>

        <div class="row footer-main">
            <?php if ($FooterDescription): ?>
                <div class="col-six tab-full left footer-desc">

                    <div class="footer-logo"></div>
                    <?php echo $FooterDescription; ?>

                </div>
            <?php endif; ?>
            <?php if ($FooterSubscriberBoxHeading || $FooterSubscriberBoxDescription || $FooterMailchimp): ?>
                <div class="col-six tab-full right footer-subscribe">

                    <?php if ($FooterSubscriberBoxHeading): ?>
                        <h4>
                            <?php echo $FooterSubscriberBoxHeading; ?>
                        </h4>
                    <?php endif; ?>
                    <?php if ($FooterSubscriberBoxDescription): ?>
                        <p>
                            <?php echo $FooterSubscriberBoxDescription; ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($FooterMailchimp): ?>
                        <div class="subscribe-form">
                            <?php echo do_shortcode($FooterMailchimp); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div> <!-- end footer-main -->

        <!-- end footer-bottom -->

    </footer> <!-- end footer -->
<?php endif; ?>

<!-- photoswipe background
================================================== -->
<div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                    title="Close (Esc)"></button> <button class="pswp__button pswp__button--share"
                    title="Share"></button> <button class="pswp__button pswp__button--fs"
                    title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom"
                    title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button
                class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>

    </div>

</div> <!-- end photoSwipe background -->


<!-- preloader
================================================== -->
<div id="preloader">
    <div id="loader">
        <div class="line-scale-pulse-out">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>


<!-- Java Script
================================================== -->

<script>
    $(document).ready(function () {
        console.clear();
    });
</script>
</body>

</html>