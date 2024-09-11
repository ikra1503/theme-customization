<?php
$RecentTagline = get_field('recent_tagline');
$RecentHeading = get_field('recent_heading');
$RecentCards = get_field('recent_works_card');
$RecentCards = is_array($RecentCards) ? $RecentCards : [];
?>
<?php if ($RecentTagline || $RecentHeading || $RecentCards): ?>
    <section id='works' class="s-works">
        <?php if ($RecentTagline || $RecentHeading): ?>
            <div class="intro-wrap">
                <div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
                    <div class="col-full">
                        <?php if ($RecentTagline): ?>
                            <h3 class="subhead">
                                <?php echo $RecentTagline; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ($RecentHeading): ?>
                            <h1 class="display-2 display-2--light">
                                <?php echo $RecentHeading; ?>
                            </h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div> 
        <?php endif; ?>
        <?php if ($RecentCards): ?>
            <div class="row works-content">
                <div class="col-full masonry-wrap">
                    <div class="masonry">
                        <?php foreach ($RecentCards as $card): ?>
                            <?php
                            $CardlinkUrl = $card['recent_project_link']['url'];
                            $CardlinkTarget = $card['recent_project_link']['target'];
                            $CardlinkTitle = $card['recent_project_link']['title'];

                            $CardImageUrl = $card['recent_card_image']['url'];
                            $CardImageTitle = $card['recent_card_image']['title'];

                            $CardTitle = $card['recent_project_title'];
                            $CardCategory = $card['recent_project_branding'];
                            $CardDescription = $card['recent_project_description'];
                            ?>
                            <div class="masonry__brick" data-aos="fade-up">
                                <div class="item-folio">
                                    <div class="item-folio__thumb">
                                        <a href="<?php echo esc_url($CardlinkUrl); ?>" class="thumb-link"
                                            title="<?php echo esc_attr($CardlinkTitle); ?>" data-size="1050x700">
                                            <img src="<?php echo esc_url($CardImageUrl); ?>"
                                                srcset="<?php echo esc_url($CardImageUrl); ?> 1x, <?php echo esc_url($CardImageUrl); ?> 2x"
                                                alt="<?php echo esc_attr($CardImageTitle); ?>">
                                        </a>
                                    </div>

                                    <div class="item-folio__text">
                                        <?php if ($CardTitle): ?>
                                            <h3 class="item-folio__title">
                                                <?php echo esc_html($CardTitle); ?>
                                            </h3>
                                        <?php endif; ?>
                                        <?php if ($CardCategory): ?>
                                            <p class="item-folio__cat">
                                                <?php echo esc_html($CardCategory); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($CardlinkUrl || $CardlinkTitle): ?>
                                        <a href="<?php echo esc_url($CardlinkUrl); ?>" class="item-folio__project-link"
                                            title="<?php echo esc_attr($CardlinkTitle); ?>"
                                            target="<?php echo esc_attr($CardlinkTarget); ?>">
                                            <i class="icon-link"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($CardDescription): ?>
                                        <div class="item-folio__caption">
                                            <p>
                                                <?php echo esc_html($CardDescription); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div> <!-- end masonry__brick -->
                        <?php endforeach; ?>
                    </div> <!-- end masonry -->
                </div> <!-- end col-full -->
            </div> <!-- end works-content -->
        <?php endif; ?>
    </section>
<?php endif; ?>