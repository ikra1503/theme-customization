<?php
namespace LifelineDonation\Elementor;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

/**
 * Elementor button widget.
 *
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class parallax extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve button widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'wi_donation_parallax';
    }

    /**
     * Get widget title.
     *
     * Retrieve button widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Parallax Style', 'lifeline-donation-pro' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve button widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-hand';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the button widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'donations' ];
    }


    /**
     * Register button widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General Setting', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'background_type',
            [
                'label' => __( 'Background Type', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'color'  => __( 'Color', 'lifeline-donation-pro' ),
                    'image' => __( 'Image', 'lifeline-donation-pro' ),
                    'video' => __( 'Video', 'lifeline-donation-pro' ),
                    'carousel' => __( 'Carousel', 'lifeline-donation-pro' ),
                ],
                'default' => 'image',
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Color', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcm-campaign-parallax::before' => 'background-color: {{VALUE}}',
                ],
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'background_type',
                            'operator' => '==',
                            'value'    => 'color',
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Choose Image', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'background_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => __( 'External Url', 'lifeline-donation-pro' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'https://your-link.com', 'lifeline-donation-pro' ),
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'background_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ),
                    ),
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'images',
            [
                'label' => __( 'Choose Image', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Image Carouel', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'background_type',
                            'operator' => '==',
                            'value'    => 'carousel',
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default title', 'lifeline-donation-pro' ),
                'placeholder' => __( 'Type your title here', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __( 'Text', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Default description', 'lifeline-donation-pro' ),
                'placeholder' => __( 'Type your description here', 'lifeline-donation-pro' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'donation_button',
            [
                'label' => esc_html__( 'button 1', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'button',
            [
                'label' => __( 'Enable Button', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'lifeline-donation-pro' ),
                'label_off' => __( 'Hide', 'lifeline-donation-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'btn_label',
            [
                'label' => __( 'Button Label', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default title', 'lifeline-donation-pro' ),
                'placeholder' => __( 'Type your title here', 'lifeline-donation-pro' ),
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'button',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'action',
            [
                'label' => __( 'Action', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'donate'  => __( 'Show Donation Popup', 'lifeline-donation-pro' ),
                    'link_add' => __( 'Redirect To a link', 'lifeline-donation-pro' ),
                ],
                'default' => 'donate',
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'button',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'post_id',
            [
                'label' => __( 'Post to collect Donation', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'solid',
                'options' => apply_filters('wi_posts_title',array()),
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'action',
                            'operator' => '==',
                            'value'    => 'donate',
                        ),
                        array(
                            'name'     => 'button',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'URL', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'action',
                            'operator' => '==',
                            'value'    => 'link_add' ,
                        ),
                    ),
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'donation_button2',
            [
                'label' => esc_html__( 'button 2', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'button2',
            [
                'label' => __( 'Enable Button', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'lifeline-donation-pro' ),
                'label_off' => __( 'Hide', 'lifeline-donation-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'btn_label2',
            [
                'label' => __( 'Button Label', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Default title', 'lifeline-donation-pro' ),
                'placeholder' => __( 'Type your title here', 'lifeline-donation-pro' ),
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'button2',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'action2',
            [
                'label' => __( 'Action', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'donate'  => __( 'Show Donation Popup', 'lifeline-donation-pro' ),
                    'link_add' => __( 'Redirect To a link', 'lifeline-donation-pro' ),
                ],
                'default' => 'donate',
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'button2',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'post_id2',
            [
                'label' => __( 'Post to collect Donation', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'solid',
                'options' => apply_filters('wi_posts_title',array()),
                'conditions' => array(
                    'relation' => 'AND',
                    'terms'    => array(
                        array(
                            'name'     => 'action2',
                            'operator' => '==',
                            'value'    => 'donate',
                        ),
                        array(
                            'name'     => 'button2',
                            'operator' => '==',
                            'value'    => 'yes' ,
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'link2',
            [
                'label' => __( 'URL', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
                'conditions' => array(
                    'relation' => 'OR',
                    'terms'    => array(
                        array(
                            'name'     => 'action2',
                            'operator' => '==',
                            'value'    => 'link_add',
                        ),
                    ),
                ),
            ]
        );

        $this->end_controls_section();

        /* Style Section */

        $this->start_controls_section(
			'title_style',
			[
				'label'      => __( 'Title', 'lifeline-donation-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'lifeline-donation-pro' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h2.heading',
			]
		);
		
		$this->start_controls_tabs(
            'title_color_tabs'
        );
		// Control Tabs for Title
		$this->start_controls_tab(
            'title_color_normal',
            [
                'label' => __('Normal', 'lifeline-donation-pro'),
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} h2.heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
            'title_color_hover',
            [
                'label' => __('Hover', 'lifeline-donation-pro'),
            ]
        );
        
        $this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} h2.heading:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Padding', 'lifeline-donation-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} h2.heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        
		
		$this->end_controls_section();


		$this->start_controls_section(
			'description_style',
			[
				'label'      => __( 'Description', 'lifeline-donation-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' => __( 'Typography', 'lifeline-donation-pro' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.description',
			]
		);
		
		$this->start_controls_tabs(
            'description_color_tabs'
        );

		// Control Tabs for Title
		$this->start_controls_tab(
            'description_color_normal',
            [
                'label' => __('Normal', 'lifeline-donation-pro'),
            ]
        );
		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} p.description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
            'description_color_hover',
            [
                'label' => __('Hover', 'lifeline-donation-pro'),
            ]
        );
        
        $this->add_control(
			'description_hover_color',
			[
				'label' => __( 'Description Hover Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} p.description:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
			'description_padding',
			[
				'label'      => __( 'Padding', 'lifeline-donation-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} p.description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        
		
		$this->end_controls_section();

		$this->start_controls_section(
			'button1_style',
			[
				'label'      => __( 'Button 1', 'lifeline-donation-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button1_typography',
				'label' => __( 'Typography', 'lifeline-donation-pro' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wpcm-wrapper .wpcm-btn-yellow.btn1',
			]
		);
		
		$this->start_controls_tabs(
            'button1_color_tabs'
        );
		// Control Tabs for Title
		$this->start_controls_tab(
            'button1_color_normal',
            [
                'label' => __('Normal', 'lifeline-donation-pro'),
            ]
        );
		$this->add_control(
			'button1_color',
			[
				'label' => __( 'Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .btn1' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'button1_color_hover',
            [
                'label' => __('Hover', 'lifeline-donation-pro'),
            ]
        );
        
        $this->add_control(
			'button1_hover_color',
			[
				'label' => __( 'Hover Color', 'lifeline-donation-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .btn1:hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

        $this->start_controls_section(
            'button2_style',
            [
                'label' => esc_html__( 'Button 2', 'lifeline-donation-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .btn2, {{WRAPPER}} .elementor-button',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button2_normal',
            [
                'label' => esc_html__( 'Normal', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'button2_text_color',
            [
                'label' => esc_html__( 'Color', 'lifeline-donation-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button2_hover',
            [
                'label' => esc_html__( 'Hover', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'button2_hover_color',
            [
                'label' => esc_html__( 'Color', 'lifeline-donation-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn2:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();
    }

    /**
     * Render button widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $settings = webinane_array($settings);

        $this->add_render_attribute( 'wrapper', 'class', 'wpcm-wrapper lifeline-donation-app' );

        wp_enqueue_style(array('webinane-shortcodes'));
        $file = get_theme_file_path( 'templates/elementor/parallax.php' );

        if( file_exists($file)) {
            include $file;
        } else {
            include LIFELINE_DONATION_PATH . 'elementor/output/parallax.php';
        }

    }

}
