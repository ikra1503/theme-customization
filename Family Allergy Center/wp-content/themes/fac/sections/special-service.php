<?php
$service_section_heading = get_field('service_section_heading', 'option');

$service_box_content = get_field('service_box_content', 'option');
$service_box_content = is_array($service_box_content) ? $service_box_content : [];

$redirection_image = get_field('redirection_image', 'option');
$redirection_imageUrl = $redirection_image['url'];
$redirection_imageTitle = $redirection_image['title'];
$redirection_endpoint = get_field('redirection_endpoint', 'option');
$redirection_endpointUrl = $redirection_endpoint['url'];
?>
<?php if ($service_section_heading && $service_box_content)
: ?>
    <div class="spe-service">
        <div class="container">
            <?php if ($service_section_heading): ?>
                <div class="spe-heading">
                    <h2>Our Special Services For You</h2>
                </div>
            <?php endif; ?>
            <?php if ($service_box_content): ?>
                <div class="box-ser-grid">
                    <?php foreach ($service_box_content as $service_box): ?>
                        <?php
                        $service_image = $service_box['service_image']['url'];
                        $hoverImgUrl=$service_box['hover_image']['url'];
                        $hoverImgTitle=$service_box['hover_image']['title'];
                        $service_imageTitle = $service_box['service_image']['title'];
                        $service_name = $service_box['service_name'];
                        ?>
                        <div class="service-box">
                            <img src="<?php echo $service_image; ?>" alt="<?php echo $service_imageTitle; ?>"
                                class="before-hover-img">
                            <img src="<?php echo $hoverImgUrl; ?>" alt="<?php echo $hoverImgTitle; ?>"
                                class="hover-icon">
                            <h5><?php echo $service_name; ?></h5>
                            <span>
                                <a href="<?php echo $redirection_endpointUrl; ?>" title="<?php echo $redirection_imageTitle; ?>">
                                    <img src="<?php echo $redirection_imageUrl; ?>" alt="<?php echo $redirection_imageTitle; ?>">
                                </a>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>