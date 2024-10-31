<?php
/**
 * Rt Counter Module
 */

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RT_Widget_Counter extends Widget_Base {

	public function get_name() {
		return 'rt-widget-counter';
	}

	public function get_title() {
		return __( 'RT:Counter', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'rt-elements' ];
	}
	public function get_script_depends() {
		return [ 'rt-elementor-widgets-counter'];
	}
	protected function _register_controls() {

		$this->start_controls_section(
			'section_counter',
			[
				'label' => esc_html__( 'Counter', 'rt-elementor-widget' ),
			]
		);

		$this->add_control(
			'starting_number',
			[
				'label' => esc_html__( 'Starting Number', 'rt-elementor-widget' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'ending_number',
			[
				'label' => esc_html__( 'Ending Number', 'rt-elementor-widget' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);

		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Number Prefix', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 1,
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Number Suffix', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Plus', 'rt-elementor-widget' ),
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => esc_html__( 'Animation Duration', 'rt-elementor-widget' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'step' => 100,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Cool Number', 'rt-elementor-widget' ),
				'placeholder' => esc_html__( 'Cool Number', 'rt-elementor-widget' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'rt-elementor-widget' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',				
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Number', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Text Color', 'rt-elementor-widget' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .counters-item' => 'color: {{VALUE}};',
					'{{WRAPPER}} .number-prefix' => 'color: {{VALUE}};',	
					'{{WRAPPER}} .title-prefix' => 'color: {{VALUE}};',	
					
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_number',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .counters-item, .number-prefix, .title-prefix',
			]
		);

		$this->end_controls_section();	

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'rt-elementor-widget' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .counter-title',
			]
		);

		$this->end_controls_section();	

		$this->start_controls_section(
			'section_font',
			[
				'label' => __( 'Font Icon', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'font_color',
			[
				'label' => __( 'Text Color', 'rt-elementor-widget' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_section();								
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title 				= $settings['title'];
		$icon  				= $settings[ 'icon' ];
		$duration  			= $settings[ 'duration' ];
		$suffix  			= $settings[ 'suffix' ];
		$prefix  			= $settings[ 'prefix' ];
		$starting_number  	= $settings[ 'starting_number' ];
		$ending_number  	= $settings[ 'ending_number' ];	

		$counter_settings = [
            'duration' 	=> $settings['duration'],
            'starting_number' 	=> $settings['starting_number'],
        ];		
		?>

        <div class="counter-info">
            <div class="experience-years">
            	<span class="counter-icon"><i class="<?php echo esc_attr( $icon);?>" aria-hidden="true"></i></span>
                <div class="about-bottom-inner">                         	
                    <span class="number-prefix"><?php echo esc_html( $prefix )?></span>

                    <span class="counters-item" data-duration="<?php echo absint( $duration )?>" data-from="<?php echo absint( $starting_number )?>" data-to="<?php echo absint( $ending_number );?>"></span>

                    <span class="title-prefix"><?php echo esc_html( $suffix );?></span>
                   	<span class="counter-title"><?php echo esc_html( $title );?></span>
                </div>
            </div>
        </div>
		<?php
	}

	protected function _content_template() {
		?>
        <div class="counter-info">
            <div class="experience-years">
            	<span class="counter-icon"><i class="{{{ settings.icon }}}" aria-hidden="true"></i></span>
                <div class="about-bottom-inner">                         	
                    <span class="number-prefix">{{{ settings.prefix }}} </span>

                    <span class="counters-item" data-duration="{{{ settings.duration }}}" data-from="{{{ settings.starting_number }}}" data-to="{{{ settings.ending_number }}}"></span>

                    <span class="title-prefix">{{{ settings.suffix }}} </span>
                    <span class="counter-title">{{{ settings.title }}}</span>
                </div>
            </div>
        </div>
            

        <?php
		}

}

Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Counter() );