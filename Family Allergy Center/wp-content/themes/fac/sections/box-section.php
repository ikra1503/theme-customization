<?php
$specialist__section_background_image = get_field('specialist__section_background_image', 'option');
$specialist__section_background_image = is_array($specialist__section_background_image) ? $specialist__section_background_image : [];
$specialist__section_background_imageUrl = $specialist__section_background_image['url'];
// $specialist__section_background_imageTitle=$specialist__section_background_image['title'];
$text_background_image = get_field('text_background_image', 'option');
$text_background_image = is_array($text_background_image) ? $text_background_image : [];
$text_background_imagerl = $text_background_image['url'];

$specialist_text = get_field('specialist_text', 'option');
$specialist_description = get_field('specialist_description', 'option');
$video_url = get_field('video_url', 'option');

$left_side_boxes = get_field('left_side_boxes', 'option');
$left_side_boxes = is_array($left_side_boxes) ? $left_side_boxes : [];

$right_side_boxes = get_field('right_side_boxes', 'option');
$right_side_boxes = is_array($right_side_boxes) ? $right_side_boxes : [];

$bottom_image = get_field('bottom_image', 'option');
$bottom_image = is_array($bottom_image) ? $bottom_image : [];
$bottom_imageUrl = $bottom_image['url'];
$bottom_imageTitle = $bottom_image['title'];

?>
<?php if ($specialist__section_background_imageUrl || $text_background_imagerl || $specialist_description || $special_tag_text || $left_side_boxes || $right_side_boxes): ?>
    <div class="box-sec" style="background-image: url('<?php echo esc_url($specialist__section_background_imageUrl); ?>');">

        <div class="container boxes-sec">
            <div class="all_box">
                <div class="allergy-text"
                    style="background-image: url('<?php echo esc_url($text_background_imagerl); ?>');">
                    <?php if ($specialist_text || $specialist_description): ?>
                        <div class="text-alle">
                            <?php if ($specialist_text): ?>
                                <h2><?php echo $specialist_text; ?></h2>
                            <?php endif; ?>
                            <?php if ($specialist_description): ?>
                                <p><?php echo $specialist_description; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($video_url): ?>
                        <div class="video-sec">
                            <div class="video-img">
                                <div class="video-wrapper">
                                    <!-- Overlay Image -->
                                    <div class="video-overlay" onclick="playVideo()">
                                        <img src="https://webtech-evolution.com/fac/wp-content/uploads/2025/02/Group-55.png"
                                            alt="Play Video">
                                    </div>

                                   
                                    <iframe id="videoFrame" width="416" height="276" src="<?php echo esc_url($video_url); ?>"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript to handle the overlay click -->
                        <script>
                            function playVideo() {
                                var overlay = document.querySelector('.video-overlay');
                                var videoFrame = document.getElementById('videoFrame');

                                if (overlay) {
                                    overlay.style.display = 'none'; // Hide the overlay
                                }

                                // Ensure the src update works correctly
                                var src = videoFrame.src;
                                if (!src.includes("autoplay=1")) {
                                    videoFrame.src = src + (src.includes("?") ? "&" : "?") + "autoplay=1&mute=1";
                                }
                            }

                        </script>

                        <!-- CSS for Styling -->
                        <style>
                            .video-wrapper {
                                position: relative;
                                display: inline-block;
                            }

                            .video-overlay {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background: rgba(0, 0, 0, 0.5);
                                /* Optional: Adds a dark overlay */
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                cursor: pointer;
                            }

                            .video-overlay img {
                                width: 100%;
                                /* Adjust size as needed */
                                height: auto;
                            }
                        </style>

                    <?php endif; ?>
                </div>
                <?php if ($left_side_boxes || $right_side_boxes): ?>
                    <div class="boxes">
                        <?php if ($left_side_boxes): ?>
                            <div class="first-box">
                                <?php
                                $srno = 1; ?>
                                <?php foreach ($left_side_boxes as $left_box): ?>
                                    <?php
                                    $left_side_box_image = $left_box['left_side_box_image']['url'];
                                    $left_side_box_imagetitle = $left_box['left_side_box_image']['title'];
                                    $left_side_box_text = $left_box['left_side_box_text'];
                                    ?>
                                    <div class="box-<?php echo $srno++; ?>">
                                        <?php if ($left_side_box_image): ?> <img src="<?php echo $left_side_box_image; ?>"
                                                alt="<?php echo $left_side_box_imagetitle; ?>"><?php endif; ?>
                                        <?php if ($left_side_box_text): ?>
                                            <h4><?php echo $left_side_box_text; ?></h4><?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($right_side_boxes): ?>
                            <div class="second-box">
                                <?php
                                $sr = 4; ?>
                                <?php foreach ($right_side_boxes as $right_box): ?>
                                    <?php
                                    $right_side_boxes_imgUrl = $right_box['right_side_box_image']['url'];
                                    $right_side_boxes_imgTitle = $right_box['right_side_box_image']['title'];
                                    $right_side_box_text = $right_box['right_side_box_text'];
                                    ?>
                                    <div class="box-<?php echo $sr++; ?>">
                                        <?php if ($right_side_boxes_imgUrl): ?> <img src="<?php echo $right_side_boxes_imgUrl; ?>"
                                                alt="<?php echo $right_side_boxes_imgTitle; ?>"><?php endif; ?>
                                        <?php if ($right_side_box_text): ?>
                                            <h4><?php echo $right_side_box_text; ?></h4><?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($bottom_imageUrl): ?>
            <img src="<?php echo $bottom_imageUrl; ?>" alt="<?php echo $bottom_imageTitle; ?>"
                class="bottom-img"><?php endif; ?>
    </div>
<?php endif; ?>