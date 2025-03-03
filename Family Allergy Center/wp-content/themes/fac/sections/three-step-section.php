<?php
$three_step_background_image = get_field('three_step_background_image', 'option');
$three_step_background_image = is_array($three_step_background_image) ? $three_step_background_image : [];
$three_step_background_imageUrl = $three_step_background_image['url'];


$our_box_image = get_field('our_box_image', 'option');
$our_box_image = is_array($our_box_image) ? $our_box_image : [];
$our_box_imageUrl = $our_box_image['url'];

$three_step_title = get_field('three_step_title', 'option');

$plan_cards = get_field('plan_cards', 'option');
$plan_cards = is_array($plan_cards) ? $plan_cards : [];

?>
<?php if ($three_step_background_image || $our_box_imageUrl || $three_step_title || $plan_cards): ?>
    <div class="step-sec desktop-sec-box"
        style="background-image: url('<?php echo esc_url($three_step_background_imageUrl); ?>');">
        <div class="container">
            <div class="our-box" style="background-image: url('<?php echo esc_url($our_box_imageUrl); ?>'); width: 1195px;">
                <?php if ($three_step_title): ?>
                    <h2><?php echo $three_step_title; ?></h2><?php endif; ?>
                <?php
                // $plan_cards = get_field('plan_cards', 'option');
            
                if ($plan_cards && is_array($plan_cards)):
                    ?>
                    <div class="step-box">
                        <?php
                        // First item goes inside sep-box
                        if (!empty($plan_cards[0])):
                            $card = $plan_cards[0];
                            $card_title = $card['card_title'] ?? '';
                            $card_image = $card['card_image']['url'] ?? '';
                            $card_button = $card['card_button']['url'] ?? '#';
                            $card_button_title = $card['card_button']['title'] ?? 'Learn More';
                            ?>
                            <div class="sep-box">
                                <div class="step-box-1">
                                    <?php if ($card_image): ?>
                                        <div class="number-text">
                                            <img src="<?= esc_url($card_image); ?>" alt="<?= esc_attr($card_title); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($card_title && $card_button): ?>
                                        <div class="our-step-box">
                                            <div class="box-text">
                                                <h3><?= esc_html($card_title); ?></h3>
                                            </div>
                                            <div class="box-button">
                                                <button><a
                                                        href="<?= esc_url($card_button); ?>"><?= esc_html($card_button_title); ?></a></button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (count($plan_cards) > 1): ?>
                            <div class="sep-box-2">
                                <?php
                                // Second and Third items go inside sep-box-2
                                for ($i = 1; $i < min(3, count($plan_cards)); $i++):
                                    $card = $plan_cards[$i];
                                    $card_title = $card['card_title'] ?? '';
                                    $card_image = $card['card_image']['url'] ?? '';
                                    $card_button = $card['card_button']['url'] ?? '#';
                                    $card_button_title = $card['card_button']['title'] ?? 'Learn More';

                                    // Assign class based on index
                                    $box_class = ($i === 1) ? 'step-box-2' : 'step-box-3';
                                    ?>
                                    <div class="<?= esc_attr($box_class); ?>">
                                        <?php if ($card_image): ?>
                                            <div class="number-text">
                                                <img src="<?= esc_url($card_image); ?>" alt="<?= esc_attr($card_title); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($card_title && $card_button): ?>
                                            <div class="our-step-box">
                                                <div class="box-text">
                                                    <h3><?= esc_html($card_title); ?></h3>
                                                </div>
                                                <div class="box-button">
                                                    <button><a
                                                            href="<?= esc_url($card_button); ?>"><?= esc_html($card_button_title); ?></a></button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($plan_cards): ?>
    <div class="step-sec mobile-box-step"
        style="background-image: url('<?php echo esc_url($three_step_background_imageUrl); ?>');">
        <div class="container">
            <div class="our-box" style="background-image: url('<?php echo esc_url($our_box_imageUrl); ?>');">
                <?php if ($three_step_title): ?>
                    <h2><?php echo esc_html($three_step_title); ?></h2>
                <?php endif; ?>
                <div class="step-box">
                    <div class="sep-box">
                        <?php
                        $reordered_cards = [];

                        // Check if at least two items exist
                        if (isset($plan_cards[1])) {
                            $reordered_cards[] = $plan_cards[1]; // Second item first
                        }
                        if (isset($plan_cards[0])) {
                            $reordered_cards[] = $plan_cards[0]; // First item second
                        }
                        if (isset($plan_cards[2])) {
                            $reordered_cards[] = $plan_cards[2]; // Third item remains third
                        }

                        // Step class ordering: [2nd item -> "step-box-2"], [1st item -> "step-box-1"], [3rd item -> "step-box-3"]
                        $step_classes = ['step-box-2', 'step-box-1', 'step-box-3'];

                        foreach ($reordered_cards as $index => $card):
                            $card_title = $card['card_title'] ?? '';
                            $card_image = $card['card_image']['url'] ?? '';
                            $card_button = $card['card_button']['url'] ?? '#';
                            $card_button_title = $card['card_button']['title'] ?? 'Learn More';

                            // Assign predefined step-box class
                            $step_class = $step_classes[$index] ?? 'step-box-default';
                            ?>
                            <div class="<?php echo esc_attr($step_class); ?>">
                                <?php if ($card_image): ?>
                                    <div class="number-text">
                                        <img src="<?php echo esc_url($card_image); ?>" alt="<?php echo esc_attr($card_title); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="our-step-box">
                                    <div class="box-text">
                                        <h3><?php echo esc_html($card_title); ?></h3>
                                    </div>
                                    <div class="box-button">
                                        <button><a
                                                href="<?php echo esc_url($card_button); ?>"><?php echo esc_html($card_button_title); ?></a></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>