<?php
$footer_background_image = get_field('footer_background_image', 'option');
$footer_background_image = is_array($footer_background_image) ? $footer_background_image : [];
$footer_background_imageUrl = $footer_background_image['url'];

$footer_title = get_field('footer_title', 'option');
$footer_description = get_field('footer_description', 'option');

$request_appointment_url = get_field('request_appointment_url', 'option');
$request_appointment_Url = $request_appointment_url['url'];
$request_appointment_Title = $request_appointment_url['title'];

$footer_email_logo = get_field('footer_email_logo', 'option');
$footer_email_logo = is_array($footer_email_logo) ? $footer_email_logo : [];
$footer_email_logoUrl = $footer_email_logo['url'];
$footer_email_logoTitle = $footer_email_logo['title'];

$footer_email_description = get_field('footer_email_description', 'option');

$locations_section_label = get_field('locations_section_label', 'option');
$location_section_content = get_field('location_section_content', 'option');
$location_section_content = is_array($location_section_content) ? $location_section_content : [];

$service_label = get_field('service_label', 'option');

$service_menu = get_field('service_menu', 'option');
$service_menu = is_array($service_menu) ? $service_menu : [];

$copyright_text = get_field('copyright_text', 'option');

$social_share_section = get_field('social_share_section', 'option');
$social_share_section = is_array($social_share_section) ? $social_share_section : [];
?>
<?php if ($footer_background_imageUrl || $footer_title || $footer_description || $request_appointment_Url || $footer_email_logoUrl || $footer_email_description || $location_section_content || $social_share_section): ?>
    <section class="main-footer footer-1"
         style="background-image: url('https://webtech-evolution.com/fac/wp-content/uploads/2025/02/Group-147.png');">   
        <div class="container">
          <div class="container-footer-1">    
            <div class="footer">
                <div class="feel-batter-heading">
                    <h2><?php echo $footer_title; ?></h2>
                    <p><?php echo $footer_description; ?></p>
                    <div class="footer-request-btn">
                        <button><a
                                href="<?php echo $request_appointment_Url; ?>"><?php echo $request_appointment_Title; ?></a></button>
                    </div>
                </div>
            </div>
            <div class="footer-logo-email">
                <div class="footer-logo">
                    <img src="<?php echo $footer_email_logoUrl; ?>" alt="<?php echo $footer_email_logoTitle; ?>">
                    <p><?php echo $footer_email_description; ?>
                    </p>
                </div>
                <div class="footer-email">
                    <div class="email-text">
                        <h3>Newsletter</h3>
                        <p>Sign up to our email list for updates</p>
                        <form action="">
                            <input type="email" name="" id="email" placeholder="Email address">
                            <button class="email">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
          </div>
            </section>
          <section class="main-footer footer-2"
        style="background-image: url('<?php echo esc_url($footer_background_imageUrl2); ?>'); background-color: #403D33;">
         <div class="container">
        <div class="container-footer-2"> 
            <?php if ($location_section_content): ?>
                <div class="location-service">
                    <div class="locations">
                        <h3><?php echo $locations_section_label; ?></h3>
                        <?php $srno = 1; ?>
                        <?php foreach ($location_section_content as $location): ?>
                            <?php
                            $location_title = $location['location_title'];
                            $location_description = $location['location_description'];
                            $fax_number = $location['fax_number'];
                            ?>
                            <div class="location-<?php echo $srno++; ?>">
                                <div class="location-heading">
                                    <h4><?php echo $location_title; ?></h4>
                                    <p><?php echo $location_description; ?></p>
                                    <span><?php echo $fax_number; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($service_menu): ?>
                        <div class="services">
                            <div class="service">
                                <div class="service-heading">
                                    <h4><?php echo $service_label; ?></h4>
                                    <div class="menu-links">
                                        <?php $sr = 1; ?>
                                        <?php foreach ($service_menu as $servicemenu): ?>
                                            <?php
                                            $service_inner_menu = $servicemenu['service_inner_menu'];
                                            ?>
                                            <div class="menu-<?php echo $sr++; ?>">
                                                <ul>
                                                    <?php foreach ($service_inner_menu as $innermenu): ?>
                                                        <?php
                                                        $servicelink = $innermenu['servicelink']['url'];
                                                        $servicename = $innermenu['servicename'];
                                                        ?>
                                                        <li><a href="<?php echo $servicelink; ?>"><?php echo $servicename; ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
             </div>
             </div>
               </section>
             <section class="main-footer footer-3"
        style="background-image: url('<?php echo esc_url($footer_background_imageUrl2); ?>'); background-color: #403D33;">
              <div class="container">
            <div class="all-rights-social-logo">
                <hr>
                <div class="bottom-footer">
                    <div class="all-rights">
                        <p><?php echo $copyright_text; ?></p>
                    </div>
                    <?php if ($social_share_section): ?>
                        <div class="social-logo">
                            <?php foreach ($social_share_section as $social_share): ?>
                                <?php
                                $social_share_url = $social_share['social_share_url'];
                                $social_share_image_ = $social_share['social_share_image_'];
                                $social_share_image_ = is_array($social_share_image_) ? $social_share_image_ : [];
                                $social_share_image_Url = $social_share_image_['url'];
                                $social_share_image_Title = $social_share_image_['title'];
                                ?>
                                <a href="<?php echo $social_share_url; ?>"><img src="<?php echo $social_share_image_Url; ?>"
                                        alt="<?php echo $social_share_image_Title; ?>"></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </section>
<?php endif; ?>
<script>
    // Services Box 

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".service-box").forEach(function (box) {
            box.addEventListener("mouseenter", function () {
                this.classList.add("active-card");
            });

            box.addEventListener("mouseleave", function () {
                this.classList.remove("active-card");
            });
        });
    });



    // Testimonial

    let index = 0;
    const testimonials = document.querySelectorAll('.testimonial');
    const dots = document.querySelectorAll('.dot');
    const wrapper = document.querySelector('.testimonial-wrapper');

    function showTestimonial(n) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.remove('active');
            dots[i].classList.remove('active');
            if (i === n) {
                testimonial.classList.add('active');
                dots[i].classList.add('active');
            }
        });
        wrapper.style.transform = `translateX(-${n * 100}%)`;
    }

    function nextTestimonial() {
        index = (index + 1) % testimonials.length;
        showTestimonial(index);
    }

    function setTestimonial(n) {
        index = n;
        showTestimonial(index);
    }

    setInterval(nextTestimonial, 3000);



    // Mobile-Menu

    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        const menuToggle = document.querySelector('.menu-toggle');
        navLinks.classList.toggle('active');
        menuToggle.classList.toggle('hide');
    }
</script>
</body>

</html>