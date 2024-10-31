<?php
/**
 * Rt Testimonial Module
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class RT_Widget_Post_Carousel extends Widget_Base {


	public function get_name() {
		return 'rt-widget-post-carousel';
	}

	public function get_title() {
		return esc_html__( 'Carousel', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_categories() {
		return array( 'rt-elements' );
	}
	public function get_script_depends() {
		return [ 'rt-elementor-widgets-carousel'];
	}	

	protected function _register_controls() {

		$this->start_controls_section(
			'section_carousel',
			[
				'label' => esc_html__( 'Carousel', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'carousel_image',
			[
				'label' => esc_html__( 'Choose Image', 'rt-elementor-widget' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'carousel_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `carousel_image_size` and `carousel_image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$repeater->add_control(
			'carousel_title',
			[
				'label' => esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows' => '10',
				'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
			]
		);

		$repeater->add_control(
			'carousel_subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
			]
		);
		
		$repeater->add_control(
			'readmore_text',
			[
				'label' 		=> esc_html__( 'View Details Text', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'View Details', 'rt-elementor-widget' ),
				'label_block' 	=> true,
			]
		);		

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'rt-elementor-widget' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'rt-elementor-widget' ),
			]
		);

		$repeater->add_control(
			'carousel_alignment',
			[
				'label' => esc_html__( 'Alignment', 'rt-elementor-widget' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'rt-elementor-widget' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rt-elementor-widget' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rt-elementor-widget' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'label_block' => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'carousel_list',
			[
				'label' => esc_html__( 'Carousel', 'rt-elementor-widget' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .slider-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slider-content .slider-title',
			]
		);	

		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__( 'Sub Title Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .slider-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slider-content .slider-subtitle',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> esc_html__( 'Button', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_button',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .slider-content .box-button',
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .box-button' => 'background: {{VALUE}};',
					'{{WRAPPER}} .slider-content .box-button:hover span' => 'background: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'button_bg_color_hover',
			[
				'label' 		=> esc_html__( 'Background Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .box-button:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .slider-content .box-button span' => 'background: {{VALUE}};',
				],
			]
		);							
		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .box-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slider-content .box-button:hover span' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'button_color_hover',
			[
				'label' 		=> esc_html__( 'Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .box-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slider-content .box-button span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' 		=> esc_html__( 'Border Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content .box-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .slider-content .box-button:hover span' => 'border-color: {{VALUE}};',
				],
			]
		);				

		$this->end_controls_section();				

	}

	/**
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'testimonial-wrap owl-carousel owl-theme' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}	
		?>						
		<div id="owl-slider-demo" class="owl-carousel owl-theme owl-slider-demo">
			<?php if ( $settings['carousel_list'] ) {
				foreach (  $settings['carousel_list'] as $item ) { 
					$title 		= $item['carousel_title'];
					$image 		= $item['carousel_image']['url'];
					$subtitle 	= $item['carousel_subtitle'];
					$button 	= $item['readmore_text'];
					$alignment  = $item['carousel_alignment']; 
					if ( ! empty( $item['link']['url'] ) ) {
						$this->add_render_attribute( 'link', 'href', $item['link']['url'] );

						if ( $item['link']['is_external'] ) {
							$this->add_render_attribute( 'link', 'target', '_blank' );
						}

						if ( ! empty( $item['link']['nofollow'] ) ) {
							$this->add_render_attribute( 'link', 'rel', 'nofollow' );
						}
					}					
					?>
                    <div class="slider-content slider-<?php echo esc_attr( $alignment ); ?>">
	                    	<?php if ( ! empty( $image ) ): ?>
		                        <figure class="slider-image">
		                           <?php $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'carousel_image' );
		                           echo $image_html; ?>
		                        </figure>
	                        <?php endif; ?>
                        <div class="slider-text">
                            <div class="container">
                                <div class="slider-contain">
                                    <h3 class="slider-subtitle"><span><?php echo esc_html( $subtitle);?></span></h3>                                   
									<?php if ( ! empty( $item['link']['url'] ) ) :
										$carousel_name_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '><h2 class="slider-title">' . esc_html($title) . ' </h2></a>';
									else:
										$carousel_name_html = '<h2 class="slider-title">' . esc_html($title) . ' </h2>';
									endif;	
									echo wp_kses_post( $carousel_name_html );
									?> 
                                    <?php if ( ! empty( $item['link']['url'] ) ) :
										$button_html = '<a class="box-button" ' . $this->get_render_attribute_string( 'link' ) . '><span></span>' . esc_html($button) . '</a>';			
										echo wp_kses_post( $button_html );						
									endif;	
									
									?>                                     
                                </div>
                            </div>
                        </div>
                    </div>					
				<?php } 
			} ?>
		</div>
	<?php }
	protected function _content_template() {
		
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Post_Carousel() );