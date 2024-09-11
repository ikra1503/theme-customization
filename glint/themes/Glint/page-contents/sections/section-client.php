<?php
$Tagline = get_field('tagline');
$Heading = get_field('heading');
$PartnerLogos = get_field('partner_logos');
$PartnerLogos = is_array($PartnerLogos) ? $PartnerLogos : [];
$Testimonials = get_field('testimonials');
$Testimonials = is_array($Testimonials) ? $Testimonials : [];
?>
<?php if ($Tagline || $Heading || $PartnerLogos || $Testimonials): ?>
    <section id="clients" class="s-clients">
        <?php if ($Heading || $Tagline): ?>
            <div class="row section-header" data-aos="fade-up">
                <div class="col-full">
                    <?php if ($Tagline): ?>
                        <h3 class="subhead">
                            <?php echo $Tagline; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($Heading): ?>
                        <h1 class="display-2">
                            <?php echo $Heading; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div> <!-- end section-header -->
        <?php endif; ?>
        <?php if ($PartnerLogos): ?>
            <div class="row clients-outer" data-aos="fade-up">
                <div class="col-full">
                    <div class="clients">
                        <?php foreach ($PartnerLogos as $logos): ?>
                            <?php
                            $LogoUrl = $logos['logo']['url'];
                            $logoAlt = $logos['logo']['title']
                                ?>
                            <img src="<?php echo $LogoUrl; ?>" alt="<?php echo $logoAlt; ?>" />
                        <?php endforeach; ?>

                    </div> <!-- end clients -->
                </div> <!-- end col-full -->
            </div> <!-- end clients-outer -->
        <?php endif; ?>
        <?php if ($Testimonials): ?>
            <div class="row clients-testimonials" data-aos="fade-up">
                <div class="col-full">
                    <div class="testimonials">
                        <?php foreach ($Testimonials as $testimonial): ?>
                            <?php
                            $ReviewerName = $testimonial['reviewer_name'];
                            $ReviewerPhoto = $testimonial['reviewer_photo'];
                            $ReviewerPhoto = is_array($ReviewerPhoto) ? $ReviewerPhoto : [];
                            $ReviewerPhotoUrl = $ReviewerPhoto['url'];
                            $ReviewerPhotoAlt = $ReviewerPhoto['title'];
                            $Designation = $testimonial['reviewer_designation'];
                            $Review = $testimonial['review'];
                            ?>
                            <?php if ($ReviewerName || $ReviewerPhoto || $Review || $Designation): ?>
                                <div class="testimonials__slide">
                                    <?php if ($Review): ?>
                                        <p>
                                            <?php echo $Review; ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($ReviewerPhoto): ?>
                                        <img src="<?php echo $ReviewerPhotoUrl; ?>" alt="<?php echo $ReviewerPhotoAlt; ?>"
                                            class="testimonials__avatar">
                                    <?php endif; ?>
                                    <?php if($ReviewerName||$Designation):?>
                                    <div class="testimonials__info">
                                    <?php if($ReviewerName):?> <span class="testimonials__name"><?php echo $ReviewerName;?></span><?php endif;?>
                                     <?php if($Designation):?>   <span class="testimonials__pos"><?php echo $Designation;?></span><?php endif;?>
                                    </div>
                            <?php endif;?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div><!-- end testimonials -->

                </div> <!-- end col-full -->
            </div> <!-- end client-testimonials -->
        <?php endif; ?>
    </section>
<?php endif; ?>