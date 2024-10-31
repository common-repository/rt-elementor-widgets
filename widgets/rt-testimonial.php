<?php
/**
 * Rt Testimonial Module
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class RT_Widget_Testimonial extends Widget_Base {


	public function get_name() {
		return 'rt-widget-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return array( 'rt-elements' );
	}
	public function get_script_depends() {
		return [ 'rt-elementor-widgets-testimonial'];
	}	

	protected function _register_controls() {

		$this->start_controls_section(
			'rt_testimonail_section',
			[
				'label' => esc_html__( 'Testimonial', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__( 'Content', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows' => '10',
				'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
			]
		);

		$repeater->add_control(
			'testimonial_image',
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
				'name' => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);


		$repeater->add_control(
			'testimonial_name',
			[
				'label' => esc_html__( 'Name', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'John Doe',
			]
		);

		$repeater->add_control(
			'testimonial_job',
			[
				'label' => esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Designer',
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
			'testimonial_alignment',
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
			'testimonial_list',
			[
				'label' => esc_html__( 'Repeater List', 'rt-elementor-widget' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-wrap .inner-detail h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' 		=> esc_html__( 'Name', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-wrap .inner-detail .entry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> esc_html__( 'Content', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-wrap .inner-detail .entry-content' => 'color: {{VALUE}};',
				],
			]
		);								

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
		<div class="testimonial-wrap owl-carousel owl-theme">
			<?php if ( $settings['testimonial_list'] ) {
				foreach (  $settings['testimonial_list'] as $item ) { 
					$content 	= $item['testimonial_content'];
					$image 		= $item['testimonial_image']['url'];
					$name 		= $item['testimonial_name'];
					$job 		= $item['testimonial_job'];



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
	                <div class="item">
	                    <div class="item-wrap">
	                    	<?php if ( ! empty( $image ) ): ?>
		                        <figure>
		                           <?php $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_image' );
		                           echo $image_html; ?>
		                        </figure>
	                        <?php endif; ?>
	                        <div class="inner-detail">
	                            <span class="icon-wrap">
	                                <i class="fa fa-quote-left" aria-hidden="true"></i>
	                            </span>
	                            <header class="entry-header">
	                            	<h6 class="entry-subtitle">
	                                   <?php echo esc_html( $job );?>
	                                </h6>
									<?php if ( ! empty( $item['link']['url'] ) ) :
										$testimonial_name_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '><h3 class="entry-title">' . esc_html($name) . ' </h3></a>';
									else:
										$testimonial_name_html = '<h3 class="entry-title">' . esc_html($name) . ' </h3>';
									endif;	
									echo wp_kses_post( $testimonial_name_html );
									?> 
	                            </header>
	                            <?php if ( !empty( $content ) ): ?>
		                            <div class="entry-content">
		                                <?php echo esc_html( $content); ?>
		                            </div>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	                </div>
				<?php } 
			} ?>
		</div>
	<?php }
}


Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Testimonial() );