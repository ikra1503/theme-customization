<?php
$ContactTagline = get_field('contact_tagline');
$ContactHeading = get_field('contact_heading');
$ContactShortCode = get_field('contact_form_shortcode');
$ContactRightHeading = get_field('contact_right_heading');
$ContactRightsidePart = get_field('contact_form_right_side_part');
?>
<?php if ($ContactTagline || $ContactHeading || $ContactShortCode || $ContactRightHeading || $ContactRightsidePart): ?>
    <section id="contact" class="s-contact">
        <div class="overlay"></div>
        <div class="contact__line"></div>
        <?php if ($ContactHeading || $ContactTagline): ?>
            <div class="row section-header" data-aos="fade-up">
                <div class="col-full">
                    <?php if ($ContactTagline): ?>
                        <h3 class="subhead">
                            <?php echo $ContactTagline; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($ContactHeading): ?>
                        <h1 class="display-2 display-2--light">
                            <?php echo $ContactHeading; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($ContactShortCode): ?>
            <div class="row contact-content" data-aos="fade-up">
                <div class="contact-primary">
                    <h3 class="h6">Send Us A Message</h3>
                    <?php echo do_shortcode($ContactShortCode); ?>
                </div> <!-- end contact-primary -->

                <?php if ($ContactRightsidePart): ?>
                    <div class="contact-secondary">
                        <div class="contact-info">
                            <?php if ($ContactRightHeading): ?>
                                <h3 class="h6 hide-on-fullwidth">
                                    <?php echo $ContactRightHeading; ?>
                                </h3>
                            <?php endif; ?>
                            <?php foreach ($ContactRightsidePart as $rightside): ?>
                                <?php $RightHeading = $rightside['right_heading']; ?>
                                <div class="cinfo">
                                    <?php if ($RightHeading): ?>
                                        <h5>
                                            <?php echo $RightHeading; ?>
                                        </h5>
                                    <?php endif; ?>
                                    <?php $rightinfo = $rightside['right_info']; ?>
                                    <?php foreach ($rightinfo as $point): ?>
                                        <?php $singlepoint = $point['contact_right_info']; ?>
                                        <?php if ($singlepoint): ?>
                                            <p>
                                                <?php echo $singlepoint; ?>
                                            </p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div> <!-- end contact-info -->
                    </div> <!-- end contact-secondary -->
                <?php endif; ?>
            </div> <!-- end contact-content -->
        <?php endif; ?>
    </section>
<?php endif; ?>