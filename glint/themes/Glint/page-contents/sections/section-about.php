<?php
$AboutHeading = get_field('about_heading');
$AboutTagline = get_field('about_tagline');
$AboutDescription = get_field('about_description');
$Facts = get_field('facts');
?>
<?php if ($AboutDescription || $AboutHeading || $AboutTagline || $Facts): ?>

    <?php if ($AboutHeading || $AboutTagline): ?>
        <section id='about' class="s-about">
            <div class="row section-header has-bottom-sep" data-aos="fade-up">
                <div class="col-full">
                    <?php if ($AboutHeading): ?>
                        <h3 class="subhead subhead--dark">Hello There</h3>
                    <?php endif; ?>
                    <?php if ($AboutTagline): ?>
                        <h1 class="display-1 display-1--light">We Are Glint</h1>
                    <?php endif; ?>
                </div>
            </div> <!-- end section-header -->
        <?php endif; ?>
        <?php if ($AboutDescription): ?>
            <div class="row about-desc" data-aos="fade-up">
                <div class="col-full">
                    <p>
                        <?php echo $AboutDescription; ?>
                    </p>
                </div>
            </div> <!-- end about-desc -->
        <?php endif; ?>
        <?php if ($Facts): ?>
            <div class="row about-stats stats block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">
                <?php foreach ($Facts as $fact): ?>
                    <?php $FactHeading = $fact['fact_heading']; ?>
                    <?php $FactNumber = $fact['number']; ?>
                    <?php if ($FactHeading || $FactNumber): ?>
                        <div class="col-block stats__col ">
                            <?php if ($FactNumber): ?>
                                <div class="stats__count">
                                    <?php echo $FactNumber; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($FactHeading): ?>
                                <h5>
                                    <?php echo $FactHeading; ?>
                                </h5>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="about__line"></div>
        <?php endif; ?>
    </section>
<?php endif; ?>