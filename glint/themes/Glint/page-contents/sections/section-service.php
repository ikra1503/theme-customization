<?php
$ServiceTagLine = get_field('service_tagline');
$ServiceHeading = get_field('service_heading');
$ServiceCards = get_field('service_cards');
?>
<?php if ($ServiceTagLine || $ServiceCards || $ServiceHeading): ?>
    <section id='services' class="s-services">
        <?php if ($ServiceHeading || $ServiceTagLine): ?>
            <div class="row section-header has-bottom-sep" data-aos="fade-up">
                <div class="col-full">
                    <?php if ($ServiceTagLine): ?>
                        <h3 class="subhead">
                            <?php echo $ServiceTagLine; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($ServiceHeading): ?>
                        <h1 class="display-2">
                            <?php echo $ServiceHeading; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div> <!-- end section-header -->
        <?php endif; ?>
        <?php if ($ServiceCards): ?>
            <div class="row services-list block-1-2 block-tab-full">
                <?php foreach ($ServiceCards as $card): ?>
                    <?php
                    $IconClass = $card['service_card_icon_class'];
                    $CardHeading = $card['service_card_heading'];
                    $CardDescription = $card['service_card_description'];
                    ?>
                    <?php if ($IconClass || $CardHeading || $CardDescription): ?>
                        <div class="col-block service-item" data-aos="fade-up">
                            <?php if ($IconClass): ?>
                                <div class="service-icon">
                                    <i class="<?php echo $IconClass; ?>"></i>
                                </div>
                            <?php endif; ?>
                            <?php if ($CardHeading || $CardDescription): ?>
                                <div class="service-text">
                                    <?php if ($CardHeading): ?>
                                        <h3 class="h2">
                                            <?php echo $CardHeading; ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if ($CardDescription): ?>

                                        <?php echo $CardDescription; ?>

                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div> <!-- end services-list -->
        <?php endif; ?>
    </section>
<?php endif; ?>