<?php
/**
 * Rt Team Module
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class RT_Widget_Team extends Widget_Base {


	public function get_name() {
		return 'rt-widget-team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
		return array( 'rt-elements' );
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'Query', 'rt-elementor-widget' )
            ]
        );

		$this->add_control(
			'count',
			[
				'label' 		=> esc_html__( 'Post Count', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '6',
				'label_block' 	=> true,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> esc_html__( 'Default', 'rt-elementor-widget' ),
					'DESC' 		=> esc_html__( 'DESC', 'rt-elementor-widget' ),
					'ASC' 		=> esc_html__( 'ASC', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> esc_html__( 'Order By', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 				=> esc_html__( 'Default', 'rt-elementor-widget' ),
					'date' 			=> esc_html__( 'Date', 'rt-elementor-widget' ),
					'title' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
					'name' 			=> esc_html__( 'Name', 'rt-elementor-widget' ),
					'modified' 		=> esc_html__( 'Modified', 'rt-elementor-widget' ),
					'author' 		=> esc_html__( 'Author', 'rt-elementor-widget' ),
					'rand' 			=> esc_html__( 'Random', 'rt-elementor-widget' ),
					'ID' 			=> esc_html__( 'ID', 'rt-elementor-widget' ),
					'comment_count' => esc_html__( 'Comment Count', 'rt-elementor-widget' ),
					'menu_order' 	=> esc_html__( 'Menu Order', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'include_categories',
			[
				'label' 		=> esc_html__( 'Include Categories', 'rt-elementor-widget' ),
				'description' 	=> esc_html__( 'Enter the categories slugs seperated by a "comma"', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'exclude_categories',
			[
				'label' 		=> esc_html__( 'Exclude Categories', 'rt-elementor-widget' ),
				'description' 	=> esc_html__( 'Enter the categories slugs seperated by a "comma"', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();		

        $this->start_controls_section(
            'section_elements',
            [
                'label' => esc_html__( 'Elements', 'rt-elementor-widget' )
            ]
        );
		$this->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Image', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);        

		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' 		=> esc_html__( 'Excerpt', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' 		=> esc_html__( 'Excerpt Length', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '15',
				'label_block' 	=> true,
				'condition' => array(
					'excerpt' => 'true',
				),
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' 		=> esc_html__( 'View Details Text', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'View Details', 'rt-elementor-widget' ),
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content_wrapper',
			[
				'label' 		=> esc_html__( 'Wrapper', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		// Wrapper Padding
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'rt-elementor-widget' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .team-item-wrap .custom-col-6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

		// Columns Padding.
		$this->add_responsive_control(
			'grid_style_columns_margin',
			[
				'label'     => esc_html__( 'Columns Padding', 'rt-elementor-widget' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-detail'   => 'padding-left: {{SIZE}}{{UNIT}};',					
				],
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
					'{{WRAPPER}} .team-item-wrap .entry-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-item-wrap .entry-title',
			]
		);		

		// Title margin.
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'rt-elementor-widget' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .team-item-wrap .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' 		=> esc_html__( 'Content', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .inner-detail .entry-content' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .team-item-wrap .inner-detail .entry-content',
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
				'selector' => '{{WRAPPER}} .team-item-wrap .box-button',
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .box-button' => 'background: {{VALUE}};',
					'{{WRAPPER}} .team-item-wrap .box-button:hover span' => 'background: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'button_bg_color_hover',
			[
				'label' 		=> esc_html__( 'Background Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .box-button:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .team-item-wrap .box-button span' => 'background: {{VALUE}};',
				],
			]
		);							
		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .box-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-item-wrap .box-button:hover span' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'button_color_hover',
			[
				'label' 		=> esc_html__( 'Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .box-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-item-wrap .box-button span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' 		=> esc_html__( 'Border Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-item-wrap .box-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .team-item-wrap .box-button:hover span' => 'border-color: {{VALUE}};',
				],
			]
		);				

		$this->end_controls_section();
	}

	/**
	 * Return the values of all the categories of the posts
	 * present in the site
	 *
	 * 
	 */
	protected function rt_elementor_widget_categories() {
		$output     = array();
		$categories = get_categories();

		foreach ( $categories as $category ) {
			$output[ $category->term_id ] = $category->name;
		}

		return $output;
	}
	/**
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$args = array(
	        'post_type'         => 'post',
	        'posts_per_page'    => $settings['count'],
	        'order'             => $settings['order'],
	        'orderby'           => $settings['orderby'],
			'no_found_rows' 	=> true,
			'tax_query' 		=> array(
				'relation' 		=> 'AND',
			),
	    );

	    // Include/Exclude categories
	    $include = $settings['include_categories'];
	    $exclude = $settings['exclude_categories'];

	    // Include category
		if (  ! empty( $include ) ) {

			// Sanitize category and convert to array
			$include = str_replace( ', ', ',', $include );
			$include = explode( ',', $include );

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $include,
				'operator' => 'IN',
			);

		}

		// Exclude category
		if ( ! empty( $exclude ) ) {

			// Sanitize category and convert to array
			$exclude = str_replace( ', ', ',', $exclude );
			$exclude = explode( ',', $exclude );

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $exclude,
				'operator' => 'NOT IN',
			);

		}

		// Start the WP_Query Object/Class
		$the_query = new \WP_Query( $args );
		if ($the_query->have_posts()) : ?>

	        <div class="team-item-wrap rt-clearfix">
	            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
	            	$title 		= $settings['title'];
	            	$image 		= $settings['image'];
	            	$excerpt 	= $settings['excerpt'];
	            ?>
	                
                <div class="team-item">
                	<?php if ( has_post_thumbnail() && 'true' === $image ): ?>
                        <div class="team-social">
                            <figure>
                                <?php the_post_thumbnail( 'rt_elementor_team' ); ?>
                            </figure>
                        </div>
                    <?php endif; ?>
                    <div class="team-detail">
                        <div class="inner-detail">
                        	<?php if ( 'true' === $title ): ?>
                                <header class="entry-header">
                                    <h3 class="entry-title">
                                       <?php the_title(); ?>
                                    </h3>
                                </header>
                            <?php endif; ?>	                                
                            <?php if ( 'true' === $excerpt ): ?>
                                <div class="entry-content">
                                    <?php rt_elementor_widget_excerpt( absint( $settings['excerpt_length'] ) );	?>
                                </div>
                            <?php endif; ?>
                            <?php if ( !empty($settings['readmore_text'] ) ): ?>
                            	<a href="<?php the_permalink(); ?>" class="box-button"><span></span><?php echo esc_html( $settings['readmore_text']);?></a>
                        	<?php endif;?>
                        </div>
                    </div>
                </div>
	                
	           	<?php endwhile;
	           	wp_reset_postdata(); ?>	           
	        </div>
		<?php
		endif;
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Team() );