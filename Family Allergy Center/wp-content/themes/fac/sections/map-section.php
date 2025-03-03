<?php
$visit_us_section_title = get_field('visit_us_section_title', 'option');
$visit_addresses = get_field('visit_addresses', 'option');
$visit_addresses = is_array($visit_addresses) ? $visit_addresses : [];
$MaPImage = get_field('map_image', 'option');
$MaPImage = is_array($MaPImage) ? $MaPImage : [];
$MapUrl = $MaPImage['url'];
?>
<?php if ($visit_us_section_title || $visit_addresses): ?>
    <div class="map-sec">
        <div class="container maping">
            <div class="map">
                <div class="visit-us">
                    <?php if ($visit_us_section_title): ?>
                        <h2><?php echo $visit_us_section_title; ?></h2><?php endif; ?>
                    <?php if ($visit_addresses): ?>
                        <div class="address">
                            <?php $srno = 1; ?>
                            <?php foreach ($visit_addresses as $address): ?>
                                <?php
                                $location_title = $address['location_title'];
                                $location_description = $address['location_description'];
                                $get_direction_url = $address['get_direction_url'];
                                $get_direction_url = is_array($get_direction_url) ? $get_direction_url : [];
                                $get_direction_Url = $get_direction_url['url'];
                                $get_direction_Title = $get_direction_url['title'];
                                $get_direction_Target = $get_direction_url['target'];
                                $fax_heading = $address['fax_heading'];
                                $fax_number = $address['fax_number'];
                                $visit_time = $address['visit_time'];
                                ?>
                                <div class="address-<?php echo $srno++; ?>">
                                    <h3><?php echo $location_title; ?></h3>
                                    <p><?php echo $location_description; ?></p>
                                    <a href="<?php echo $get_direction_Url; ?>"><?php echo $get_direction_Title; ?></a><i
                                        class="fa-solid fa-arrow-right"></i>
                                    <div class="fax">
                                        <h3><?php echo $fax_heading; ?></h3>
                                        <h4><?php echo $fax_number; ?></h4>
                                    </div>
                                    <div class="time">
                                        <p><?php echo $visit_time; ?>
                                        </p>
                                    </div>
                                </div><?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($MapUrl): ?>
                    <div class="maping_map">
                        <img src="<?php echo $MapUrl; ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>