<?php
namespace LifelineDonation\Elementor;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

/**
 * Elementor button widget.
 *
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class stat_counter extends \Elementor\Widget_Base {

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
        return 'wi_donation_stat_counter';
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
        return esc_html__( 'Stat Counter', 'lifeline-donation-pro' );
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
            'query',
            [
                'label' => esc_html__( 'Stats Setting', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'stat_couter_style',
            [
                'label' => __( 'Counter Style', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                    '1'  => __( 'Style 1', 'lifeline-donation-pro' ),
                    '2'  => __( 'Style 2', 'lifeline-donation-pro' ),
                ],
                'default' => [ '1', 'description' ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label' => __( 'Stats Number', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'step' => 5,
                'default' => 10,
            ]
        );

        $repeater->add_control(
            'symbol',
            [
                'label' => __( 'Stats Symbol', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '$', 'lifeline-donation-pro' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Stats Title', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Campaigns', 'lifeline-donation-pro' ),
                'placeholder' => __( 'Enter the sty', 'lifeline-donation-pro' ),
            ]
        );

        $this->add_control(
            'stat_count_list',
            [
                'label' => __( 'Repeater List', 'lifeline-donation-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => __( 'fas fa-star', 'lifeline-donation-pro' ),
                        'number' => __( '24542', 'lifeline-donation-pro' ),
                        'symbol' => __( '$', 'lifeline-donation-pro' ),
                        'title' => __( 'Raised', 'lifeline-donation-pro' ),
                    ],
                    [
                        'icon' => __( 'fas fa-star', 'lifeline-donation-pro' ),
                        'number' => __( '24542', 'lifeline-donation-pro' ),
                        'symbol' => __( '$', 'lifeline-donation-pro' ),
                        'title' => __( 'Community Members', 'lifeline-donation-pro' ),
                    ],
                    [
                        'icon' => __( 'fas fa-star', 'lifeline-donation-pro' ),
                        'number' => __( '24542', 'lifeline-donation-pro' ),
                        'symbol' => __( '$', 'lifeline-donation-pro' ),
                        'title' => __( 'Donation Needed', 'lifeline-donation-pro' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

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

        wp_enqueue_style(array('webinane-shortcodes'));
        $file = get_theme_file_path( 'templates/elementor/stat_counter.php' );

        if( file_exists($file)) {
            include $file;
        } else {
            include LIFELINE_DONATION_PATH . 'elementor/output/stat_counter.php';
        }
        wp_reset_postdata();
    }

}
